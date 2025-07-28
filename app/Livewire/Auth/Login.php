<?php

namespace App\Livewire\Auth;
use Livewire\Component;
use Livewire\Attributes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Login extends Component
{

    public $username;
    public $password;

    public $showPassword = false;

    public function login()
    {

        $this->validate([
            'username' => 'required|string',
            'password' => 'required|min:8',
        ]);

        $credentials = [
            'username' => $this->username,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            // $user = User::with('role')->find(Auth::id());
            $user = User::with('role.permissions')->find(Auth::id());
    
           return redirect()->route($this->redirectTo($user));
        }

        session()->flash('error', 'Username atau password salah.');
    }

    private function redirectTo($user)
    {
        $role = $user->role->name;
        
        switch ($role) {
            case 'admin':
                return 'dashboard';
                case 'dlh':
                    return 'dashboard';
                    case 'uptd':
                        return 'dashboard';
                        case 'operator_tpa':
                return 'dashboard';
            default:
                return 'login';
            }
        }
        
        #[Attributes\Layout('layouts.geust.main')]
        public function render()
        {
            return view('livewire.auth.login');
        }
    }
    // $role = Auth::user()->role->name;