<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wallet = $user->wallet;

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $incomeThisMonth = $user->transactions()
            ->income()
            ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $expenseThisMonth = $user->transactions()
            ->expense()
            ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $recentTransactions = $user->transactions()
            ->with('category')
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        $categories = Category::availableFor($user->id)->get();

        return view('dashboard', compact('user', 'wallet', 'incomeThisMonth', 'expenseThisMonth', 'recentTransactions', 'categories'));
    }
}
