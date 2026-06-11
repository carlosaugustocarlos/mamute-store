<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="page-title">Novo produto</h2>
            <p class="page-subtitle">Registe um produto numa das suas lojas.</p>
        </div>
    </x-slot>

    <div class="page-shell">
        <div class="mx-auto max-w-4xl">
            <div class="panel p-6">
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @include('products._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
