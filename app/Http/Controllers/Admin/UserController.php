<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Apenas utilizadores com user_type 1 podem aceder a esta página
        if (Auth::user()->user_type != 1) {
            return redirect()->route('dashboard')->with('error', 'Acesso negado.');
        }

        $users = User::with('player.team')->get();
        return view('admin.users.index', compact('users'));
    }

    public function toggleAdmin(User $user)
    {
        if (Auth::user()->user_type != 1) {
            return redirect()->route('dashboard')->with('error', 'Acesso negado.');
        }

        // Impedir que o admin logado remova o seu próprio acesso
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Não podes alterar o teu próprio status de administrador.');
        }

        $user->user_type = $user->user_type == 1 ? 0 : 1;
        $user->save();

        $status = $user->user_type == 1 ? 'promovido a Administrador' : 'removido de Administrador';

        return back()->with('success', "O utilizador {$user->name} foi {$status} com sucesso!");
    }

    public function destroy(User $user)
    {
        if (Auth::user()->user_type != 1) {
            return redirect()->route('dashboard')->with('error', 'Acesso negado.');
        }

        // Impedir que o admin logado se apague a si próprio
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Não podes apagar a tua própria conta.');
        }

        $name = $user->name;

        // Se o utilizador tiver um jogador associado, apagamos primeiro o jogador (ou lidamos com a FK)
        if ($user->player) {
            $user->player->delete();
        }

        $user->delete();

        return back()->with('success', "O utilizador {$name} foi removido do sistema com sucesso!");
    }
}
