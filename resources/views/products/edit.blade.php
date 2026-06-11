<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="page-title">Editar produto</h2>
            <p class="page-subtitle">Actualize os dados, stock e imagem do produto.</p>
        </div>
    </x-slot>

    <div class="page-shell">
        <div class="mx-auto max-w-4xl">
            <div class="panel p-6">
                <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @include('products._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
