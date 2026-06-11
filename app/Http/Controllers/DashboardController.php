<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $storesCount = $user->stores()->count();

        $productsCount = Product::query()
            ->whereHas('store', fn ($query) => $query->where('user_id', $user->id))
            ->count();

        $stockValue = Product::query()
            ->whereHas('store', fn ($query) => $query->where('user_id', $user->id))
            ->selectRaw('COALESCE(SUM(price * stock_quantity), 0) as total')
            ->value('total');

        return view('dashboard', compact('storesCount', 'productsCount', 'stockValue'));
    }
}
