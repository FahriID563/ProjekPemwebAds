<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        return match ($user->role) {
            'admin' => redirect()->route('dashboard.admin'),
            'pelayan' => redirect()->route('dashboard.waiter'),
            default => redirect()->route('dashboard.customer'),
        };
    }
}
