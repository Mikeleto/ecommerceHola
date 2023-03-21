<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

//Copiamos userComponent y en el render añadimos el onlytrashed
class Papelera extends Component
{
    use WithPagination;

    public $search;

    public function updatingSearch() {
        $this->resetPage();
    }


    public function assignRole(User $user, $value) {
        if ($value == '1') {
            $user->assignRole('admin');
        } else {
            $user->removeRole('admin');
        }
    }
    public function restoreUser($userId)
    {
        $user = User::withTrashed()->findOrFail($userId);
        $user->restore();
        session()->flash('message', 'User restored successfully!');
    }


    public function render() {
        $users = User::where('email', '<>', auth()->user()->email)
            ->where(function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%');
            })
            ->onlyTrashed() // agrega esta línea para obtener solo los usuarios eliminados
            ->orderBy('id')
            ->paginate(10); // modifica el número de usuarios por página aquí
        return view('livewire.admin.papelera', compact('users'))->layout('layouts.admin');
    }
}
