<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="page-title">Lojas</h2>
                <p class="page-subtitle">Gestão das lojas registadas pelo utilizador.</p>
            </div>

            <a href="{{ route('stores.create') }}" class="btn-primary">
                Nova loja
            </a>
        </div>
    </x-slot>

    <div class="page-shell">
            @if (session('success'))
                <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="panel">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="table-head">
                            <tr>
                                <th class="px-6 py-3 text-left">Nome</th>
                                <th class="px-6 py-3 text-left">Email</th>
                                <th class="px-6 py-3 text-left">Telefone</th>
                                <th class="px-6 py-3 text-right">Acções</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($stores as $store)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="table-cell-strong">
                                        {{ $store->name }}
                                    </td>
                                    <td class="table-cell">
                                        {{ $store->email }}
                                    </td>
                                    <td class="table-cell">
                                        {{ $store->phone }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-end gap-4">
                                            <a href="{{ route('stores.show', $store) }}" class="text-slate-600 hover:text-slate-950">Ver</a>
                                            <a href="{{ route('stores.edit', $store) }}" class="text-blue-600 hover:text-blue-800">Editar</a>
                                            <form method="POST" action="{{ route('stores.destroy', $store) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Eliminar esta loja?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-sm text-slate-500">
                                        Nenhuma loja registada.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($stores->hasPages())
                    <div class="border-t border-slate-200 px-6 py-4">
                        {{ $stores->links() }}
                    </div>
                @endif
            </div>
    </div>
</x-app-layout>
