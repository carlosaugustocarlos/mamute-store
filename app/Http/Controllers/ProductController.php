<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $stores = $request->user()
            ->stores()
            ->orderBy('name')
            ->get();

        $products = Product::query()
            ->with('store')
            ->whereHas('store', fn ($query) => $query->where('user_id', $request->user()->id))
            ->when($request->filled('search'), fn ($query) => $query->where('name', 'like', '%'.$request->string('search')->toString().'%'))
            ->when($request->filled('store_id'), fn ($query) => $query->where('store_id', $request->integer('store_id')))
            ->when($request->filled('min_price'), fn ($query) => $query->where('price', '>=', $request->input('min_price')))
            ->when($request->filled('max_price'), fn ($query) => $query->where('price', '<=', $request->input('max_price')))
            ->when($request->boolean('in_stock'), fn ($query) => $query->where('stock_quantity', '>', 0))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('products.index', compact('products', 'stores'));
    }

    public function create(Request $request): View
    {
        $stores = $request->user()
            ->stores()
            ->orderBy('name')
            ->get();

        return view('products.create', compact('stores'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['photo_path'] = $request->file('photo')?->store('products', 'public');
        unset($data['photo']);

        $product = Product::create($data);

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Produto criado com sucesso.');
    }

    public function show(Product $product): View
    {
        $product->load('store');

        Gate::authorize('view', $product);

        return view('products.show', compact('product'));
    }

    public function edit(Request $request, Product $product): View
    {
        $product->load('store');

        Gate::authorize('update', $product);

        $stores = $request->user()
            ->stores()
            ->orderBy('name')
            ->get();

        return view('products.edit', compact('product', 'stores'));
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->load('store');

        Gate::authorize('update', $product);

        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($product->photo_path) {
                Storage::disk('public')->delete($product->photo_path);
            }

            $data['photo_path'] = $request->file('photo')->store('products', 'public');
        }

        unset($data['photo']);

        $product->update($data);

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Produto actualizado com sucesso.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->load('store');

        Gate::authorize('delete', $product);

        if ($product->photo_path) {
            Storage::disk('public')->delete($product->photo_path);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto eliminado com sucesso.');
    }
}
