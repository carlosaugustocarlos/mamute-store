<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="page-title">Dashboard</h2>
            <p class="page-subtitle">Resumo operacional das lojas e produtos registados.</p>
        </div>
    </x-slot>

    <div class="page-shell">
        <div class="grid gap-5 md:grid-cols-3">
            <div class="panel">
                <div class="panel-body">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Total de lojas</p>
                        <span class="rounded-md bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">Lojas</span>
                    </div>
                    <p class="mt-4 text-4xl font-semibold text-slate-950">{{ $storesCount }}</p>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Total de produtos</p>
                        <span class="rounded-md bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">Produtos</span>
                    </div>
                    <p class="mt-4 text-4xl font-semibold text-slate-950">{{ $productsCount }}</p>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Valor total do stock</p>
                        <span class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">AOA</span>
                    </div>
                    <p class="mt-4 text-3xl font-semibold text-slate-950">{{ number_format($stockValue, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="mt-6 grid gap-5 md:grid-cols-2">
            <a href="{{ route('stores.index') }}" class="panel block transition hover:border-blue-200 hover:shadow-md">
                <div class="panel-body">
                    <p class="text-base font-semibold text-slate-950">Gerir lojas</p>
                    <p class="mt-2 text-sm text-slate-500">Consultar, criar e actualizar lojas registadas.</p>
                </div>
            </a>

            <a href="{{ route('products.index') }}" class="panel block transition hover:border-blue-200 hover:shadow-md">
                <div class="panel-body">
                    <p class="text-base font-semibold text-slate-950">Gerir produtos</p>
                    <p class="mt-2 text-sm text-slate-500">Consultar produtos, aplicar filtros e gerir stock.</p>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
