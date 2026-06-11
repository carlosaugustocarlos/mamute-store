@csrf

<div class="grid gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="name" value="Nome" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $store->name ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="email" value="Email" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $store->email ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    <div>
        <x-input-label for="phone" value="Telefone" />
        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $store->phone ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
    </div>

    <div>
        <x-input-label for="address" value="Endereço" />
        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $store->address ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('address')" />
    </div>
</div>

<div class="mt-8 flex items-center justify-end gap-3">
    <a href="{{ route('stores.index') }}" class="btn-secondary">
        Cancelar
    </a>

    <x-primary-button>
        Guardar
    </x-primary-button>
</div>
