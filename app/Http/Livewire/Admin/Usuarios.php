<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;


//Copiamos userComponent
class Usuarios extends Component
{
    use WithPagination;

    public $search;

    public function updatingSearch() {
        $this->resetPage();
    }

    public function restaurar(User $user) {
        $user->restore();
        $user->perfil()->restore();
        session()->flash('success', 'Usuario restaurado correctamente');
        return redirect()->route('admin.usuarios.index');
    }


    public function assignRole(User $user, $value) {
        if ($value == '1') {
            $user->assignRole('admin');
        } else {
            $user->removeRole('admin');
        }
    }
    public function deleteUser($userId)
    {
        User::find($userId)->delete();
        $this->render();
    }

    public function render() {
        $users = User::where('email', '<>', auth()->user()->email)
            ->where(function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%');
            })

            ->orderBy('id')
            ->paginate(10); // modifica el número de usuarios por página aquí
        return view('livewire.admin.usuarios', compact('users'))->layout('layouts.admin');
    }

}
