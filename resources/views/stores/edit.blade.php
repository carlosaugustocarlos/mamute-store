<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="page-title">Editar loja</h2>
            <p class="page-subtitle">Actualize os dados comerciais da loja.</p>
        </div>
    </x-slot>

    <div class="page-shell">
        <div class="mx-auto max-w-4xl">
            <div class="panel p-6">
                <form method="POST" action="{{ route('stores.update', $store) }}">
                    @method('PUT')
                    @include('stores._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
