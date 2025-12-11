<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class WaiterDashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard.waiter', [
            'user' => auth()->user(),
        ]);
    }
}

