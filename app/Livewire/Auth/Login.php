<?php

namespace App\Livewire\Auth;
use Livewire\Component;
use Livewire\Attributes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Login extends Component
{

    public $name;
    public $password;

    public function login()
    {

        $this->validate([
            'name' => 'required|string',
            'password' => 'required|min:8',
        ]);

        $credentials = [
            'name' => $this->name,
            'password' => $this->password,
        ];

        // if (Auth::attempt($credentials)) {
        //     $user = Auth::user();
        //     return redirect()->route($this->redirectTo($user));
        // }

        if (Auth::attempt($credentials)) {
            $user = User::with('role')->find(Auth::id());
    
           return redirect()->route($this->redirectTo($user));
        }

        session()->flash('error', 'Username atau password salah.');
    }

    private function redirectTo($user)
    {
        // $role = Auth::user()->role->name;
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

// switch ($user->role->name) {
//     switch ($role) {
//         case 'admin':
//             return '/dashboard';
//         case 'dlh':
//             return '/dashboard';
//         case 'uptd':
//             return '/dashboard';
//         case 'operator_tpa':
//             return '/dashboard';
//         default:
//             return '/home';
//     }
// }
// $roleRoutes = [
//     'admin' => 'dashboard',
//     'dlh' => 'dashboard',
//     'uptd' => 'dashboard',
//     'operator_tpa' => 'dashboard',
// ];

// return $roleRoutes[$user->role->name] ?? 'login';
//     $user = User::where('email', $this->emailOrPhone)
//             ->orWhere('phone', $this->emailOrPhone)
//             ->first();

// if ($user && Hash::check($this->password, $user->password)) {
//     Auth::login($user);
//     // Redirect sesuai role
//     if ($user->role == 'admin_tpa') {
//         return redirect()->route('admin.dashboard');
//     } elseif ($user->role == 'dlh') {
//         return redirect()->route('dlh.dashboard');
//     } else {
//         return redirect()->route('uptd.dashboard');
//     }
// } else {
//     session()->flash('error', 'Login gagal!');
// }

