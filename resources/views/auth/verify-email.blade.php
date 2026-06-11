<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-semibold text-slate-950">Verificar email</h1>
        <p class="mt-1 text-sm text-slate-500">Confirme o email através do link enviado para a sua caixa de entrada.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
            Enviámos um novo link de verificação para o email indicado no registo.
        </div>
    @endif

    <div class="flex items-center justify-between gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button>
                Reenviar email
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                Sair
            </button>
        </form>
    </div>
</x-guest-layout>
