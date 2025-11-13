<?php

namespace App\Livewire\Pages\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.authlayout')]
#[Title('Login')]
class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email'    => 'required|email|exists:users,email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        // validate user credentials
        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            throw ValidationException::withMessages([
                'email' => 'Incorrect email or password.',
            ]);
        }

        session()->regenerate();

        // Get logged-in user
        $user = Auth::user();

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
