<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => $this->validateData->nameRules(),
            'email' => $this->validateData->emailRules(),
            'password' => $this->validateData->passwordRules(),
            'document' => $this->validateData->documentRules(),
			'phone'		=> $this->validateData->phoneRules(),
            'type' => $this->validateData->typeRules(),
            'terms' => $this->validateData->termsRules(),
        ]);
		
		//$request->validate([
		//]);

        $user = User::create([
            'name' => $this->validateData->nameClear($request->name),
            'email' => $request->email,
            'phone' => $request->phone,
            'document' => $request->document,
            'type' => (int)$request->type,
            'newsletter' => (bool)$request->newsletter,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
