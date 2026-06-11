<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="page-title">Produtos</h2>
                <p class="page-subtitle">Consulta e gestão de stock com filtros combinados.</p>
            </div>

            <a href="{{ route('products.create') }}" class="btn-primary">
                Novo produto
            </a>
        </div>
    </x-slot>

    <div class="page-shell">
            @if (session('success'))
                <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <form method="GET" action="{{ route('products.index') }}" class="panel mb-6 p-6">
                <div class="grid gap-4 md:grid-cols-5">
                    <div>
                        <x-input-label for="search" value="Produto" />
                        <x-text-input id="search" name="search" type="text" class="mt-1 block w-full" :value="request('search')" />
                    </div>

                    <div>
                        <x-input-label for="store_id" value="Loja" />
                        <select id="store_id" name="store_id" class="form-control mt-1 block w-full">
                            <option value="">Todas</option>
                            @foreach ($stores as $store)
                                <option value="{{ $store->id }}" @selected((string) request('store_id') === (string) $store->id)>
                                    {{ $store->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="min_price" value="Preço mínimo" />
                        <x-text-input id="min_price" name="min_price" type="number" min="0" step="0.01" class="mt-1 block w-full" :value="request('min_price')" />
                    </div>

                    <div>
                        <x-input-label for="max_price" value="Preço máximo" />
                        <x-text-input id="max_price" name="max_price" type="number" min="0" step="0.01" class="mt-1 block w-full" :value="request('max_price')" />
                    </div>

                    <div class="flex items-end">
                        <label class="flex min-h-10 items-center gap-2 text-sm text-slate-700">
                            <input type="checkbox" name="in_stock" value="1" @checked(request()->boolean('in_stock')) class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                            Em stock
                        </label>
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap justify-end gap-3">
                    <a href="{{ route('products.index') }}" class="btn-secondary">
                        Limpar
                    </a>
                    <x-primary-button>
                        Filtrar
                    </x-primary-button>
                </div>
            </form>

            <div class="panel">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="table-head">
                            <tr>
                                <th class="px-6 py-3 text-left">Foto</th>
                                <th class="px-6 py-3 text-left">Produto</th>
                                <th class="px-6 py-3 text-left">Loja</th>
                                <th class="px-6 py-3 text-right">Preço</th>
                                <th class="px-6 py-3 text-right">Stock</th>
                                <th class="px-6 py-3 text-right">Acções</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($products as $product)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if ($product->photo_path)
                                            <img src="{{ asset('storage/'.$product->photo_path) }}" alt="{{ $product->name }}" class="h-12 w-12 rounded-md object-cover">
                                        @else
                                            <div class="flex h-12 w-12 items-center justify-center rounded-md bg-slate-100 text-xs text-slate-500">
                                                Sem foto
                                            </div>
                                        @endif
                                    </td>
                                    <td class="table-cell-strong">
                                        {{ $product->name }}
                                    </td>
                                    <td class="table-cell">
                                        {{ $product->store->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-slate-600">
                                        {{ number_format($product->price, 2, ',', '.') }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                        <span class="rounded-md px-2.5 py-1 text-xs font-semibold {{ $product->stock_quantity > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                            {{ $product->stock_quantity }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-end gap-4">
                                            <a href="{{ route('products.show', $product) }}" class="text-slate-600 hover:text-slate-950">Ver</a>
                                            <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-800">Editar</a>
                                            <form method="POST" action="{{ route('products.destroy', $product) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Eliminar este produto?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-500">
                                        Nenhum produto encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($products->hasPages())
                    <div class="border-t border-slate-200 px-6 py-4">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
    </div>
</x-app-layout>
