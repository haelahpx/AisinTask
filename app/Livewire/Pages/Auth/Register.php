<?php

namespace App\Livewire\Pages\Auth;
use App\Models\User;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.authlayout')]
#[Title('Register')]
class Register extends Component
{
    public $name;
    public $email;
    public $password;

    // form rules to preevent invalid data
    public $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ];

    public function register()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->reset(['name', 'email', 'password']);
        // redirect to login page after successful registration
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.pages.auth.register');
    }
}
