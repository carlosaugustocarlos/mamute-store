<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-semibold text-slate-950">Recuperar palavra-passe</h1>
        <p class="mt-1 text-sm text-slate-500">Informe o email para receber o link de redefinição.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-3">
            <a class="text-sm font-medium text-blue-600 hover:text-blue-800" href="{{ route('login') }}">
                Voltar ao login
            </a>

            <x-primary-button>
                Enviar link
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
