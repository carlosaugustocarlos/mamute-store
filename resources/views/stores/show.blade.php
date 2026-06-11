<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="page-title">{{ $store->name }}</h2>
                <p class="page-subtitle">Detalhes da loja registada.</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('stores.index') }}" class="btn-secondary">
                    Voltar
                </a>
                <a href="{{ route('stores.edit', $store) }}" class="btn-primary">
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
                <dl class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Nome</dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-950">{{ $store->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Email</dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-950">{{ $store->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Telefone</dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-950">{{ $store->phone }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-slate-500">Endereço</dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-950">{{ $store->address }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
