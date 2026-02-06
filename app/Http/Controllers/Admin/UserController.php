<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Lista todos os utilizadores do sistema para gestão administrativa.
     */
    public function index()
    {
        // Segurança adicional: apenas administradores (user_type 1) podem aceder
        if (Auth::user()->user_type != 1) {
            return redirect()->route('dashboard')->with('error', 'Acesso negado.');
        }

        $users = User::with('player.team')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Alterna o estatuto de administrador (Admin <-> User) de um utilizador.
     */
    public function toggleAdmin(User $user)
    {
        if (Auth::user()->user_type != 1) {
            return redirect()->route('dashboard')->with('error', 'Acesso negado.');
        }

        // Medida de segurança: impede o admin de se remover a si próprio
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Não podes alterar o teu próprio status de administrador.');
        }

        $user->user_type = $user->user_type == 1 ? 0 : 1;
        $user->save();

        $status = $user->user_type == 1 ? 'promovido a Administrador' : 'removido de Administrador';

        return back()->with('success', "O utilizador {$user->name} foi {$status} com sucesso!");
    }

    /**
     * Remove um utilizador e o seu perfil de jogador do sistema.
     */
    public function destroy(User $user)
    {
        if (Auth::user()->user_type != 1) {
            return redirect()->route('dashboard')->with('error', 'Acesso negado.');
        }

        // Medida de segurança: impede o admin de apagar a sua própria conta
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Não podes apagar a tua própria conta.');
        }

        $name = $user->name;

        // Limpeza em cascata: remove o jogador associado se existir
        if ($user->player) {
            $user->player->delete();
        }

        $user->delete();

        return back()->with('success', "O utilizador {$name} foi removido do sistema com sucesso!");
    }
}
