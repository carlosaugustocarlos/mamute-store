<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-slate-950">
            Eliminar conta
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Ao eliminar a conta, os dados associados serão removidos de forma permanente.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Eliminar conta</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-slate-950">
                Tem certeza que deseja eliminar a conta?
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Informe a palavra-passe para confirmar a eliminação permanente da conta.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Palavra-passe" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Palavra-passe"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Eliminar conta
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
