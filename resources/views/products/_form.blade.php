@csrf

<div class="grid gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="name" value="Nome" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $product->name ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="store_id" value="Loja" />
        <select id="store_id" name="store_id" class="form-control mt-1 block w-full" required>
            <option value="">Seleccione uma loja</option>
            @foreach ($stores as $store)
                <option value="{{ $store->id }}" @selected((string) old('store_id', $product->store_id ?? '') === (string) $store->id)>
                    {{ $store->name }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('store_id')" />
    </div>

    <div>
        <x-input-label for="price" value="Preço" />
        <x-text-input id="price" name="price" type="number" min="0.01" step="0.01" class="mt-1 block w-full" :value="old('price', $product->price ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('price')" />
    </div>

    <div>
        <x-input-label for="stock_quantity" value="Quantidade em stock" />
        <x-text-input id="stock_quantity" name="stock_quantity" type="number" min="0" step="1" class="mt-1 block w-full" :value="old('stock_quantity', $product->stock_quantity ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('stock_quantity')" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="description" value="Descrição" />
        <textarea id="description" name="description" rows="4" class="form-control mt-1 block w-full">{{ old('description', $product->description ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="photo" value="Foto" />
        <input id="photo" name="photo" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="mt-1 block w-full text-sm text-slate-700 file:mr-4 file:rounded-md file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700" />
        <x-input-error class="mt-2" :messages="$errors->get('photo')" />

        @isset($product)
            @if ($product->photo_path)
                <img src="{{ asset('storage/'.$product->photo_path) }}" alt="{{ $product->name }}" class="mt-4 h-24 w-24 rounded-md border border-slate-200 object-cover">
            @endif
        @endisset
    </div>
</div>

<div class="mt-8 flex items-center justify-end gap-3">
    <a href="{{ route('products.index') }}" class="btn-secondary">
        Cancelar
    </a>

    <x-primary-button>
        Guardar
    </x-primary-button>
</div>
