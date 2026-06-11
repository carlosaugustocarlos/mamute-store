<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="page-title">{{ $product->name }}</h2>
                <p class="page-subtitle">Detalhes, stock e loja associada ao produto.</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('products.index') }}" class="btn-secondary">
                    Voltar
                </a>
                <a href="{{ route('products.edit', $product) }}" class="btn-primary">
                    Editar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="page-shell">
        <div class="mx-auto max-w-4xl">
            @if (session('success'))
                <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="panel p-6">
                <div class="grid gap-8 md:grid-cols-[160px_1fr]">
                    <div>
                        @if ($product->photo_path)
                            <img src="{{ asset('storage/'.$product->photo_path) }}" alt="{{ $product->name }}" class="h-40 w-40 rounded-md border border-slate-200 object-cover">
                        @else
                            <div class="flex h-40 w-40 items-center justify-center rounded-md bg-slate-100 text-sm text-slate-500">
                                Sem foto
                            </div>
                        @endif
                    </div>

                    <dl class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Nome</dt>
                            <dd class="mt-1 text-sm font-semibold text-slate-950">{{ $product->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Loja</dt>
                            <dd class="mt-1 text-sm font-semibold text-slate-950">{{ $product->store->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Preço</dt>
                            <dd class="mt-1 text-sm font-semibold text-slate-950">{{ number_format($product->price, 2, ',', '.') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Quantidade em stock</dt>
                            <dd class="mt-1 text-sm font-semibold text-slate-950">{{ $product->stock_quantity }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-slate-500">Descrição</dt>
                            <dd class="mt-1 whitespace-pre-line text-sm text-slate-900">{{ $product->description ?: 'Sem descrição' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
