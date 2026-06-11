<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="page-title">Perfil</h2>
            <p class="page-subtitle">Gerencie os dados da conta e a palavra-passe.</p>
        </div>
    </x-slot>

    <div class="page-shell">
        <div class="space-y-6">
            <div class="panel p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="panel p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="panel p-6">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
