<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function index(Request $request): View
    {
        $stores = $request->user()
            ->stores()
            ->latest()
            ->paginate(10);

        return view('stores.index', compact('stores'));
    }

    public function create(): View
    {
        return view('stores.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $store = $request->user()->stores()->create($request->validated());

        return redirect()
            ->route('stores.show', $store)
            ->with('success', 'Loja criada com sucesso.');
    }

    public function show(Store $store): View
    {
        Gate::authorize('view', $store);

        return view('stores.show', compact('store'));
    }

    public function edit(Store $store): View
    {
        Gate::authorize('update', $store);

        return view('stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, Store $store): RedirectResponse
    {
        Gate::authorize('update', $store);

        $store->update($request->validated());

        return redirect()
            ->route('stores.show', $store)
            ->with('success', 'Loja actualizada com sucesso.');
    }

    public function destroy(Store $store): RedirectResponse
    {
        Gate::authorize('delete', $store);

        $store->delete();

        return redirect()
            ->route('stores.index')
            ->with('success', 'Loja eliminada com sucesso.');
    }
}
