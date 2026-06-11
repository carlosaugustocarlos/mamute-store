<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ], [
            'current_password.required' => 'A palavra-passe actual é obrigatória.',
            'current_password.current_password' => 'A palavra-passe actual está incorrecta.',
            'password.required' => 'A nova palavra-passe é obrigatória.',
            'password.confirmed' => 'A confirmação da palavra-passe não corresponde.',
            'password.min' => 'A palavra-passe deve ter pelo menos :min caracteres.',
            'password.letters' => 'A palavra-passe deve conter pelo menos uma letra.',
            'password.mixed' => 'A palavra-passe deve conter letras maiúsculas e minúsculas.',
            'password.numbers' => 'A palavra-passe deve conter pelo menos um número.',
            'password.symbols' => 'A palavra-passe deve conter pelo menos um símbolo.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
