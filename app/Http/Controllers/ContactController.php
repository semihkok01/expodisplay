<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        if ($request->filled('website')) {
            return redirect()
                ->route('home')
                ->with('status', 'Ihre Anfrage wurde übermittelt. Wir melden uns in Kürze bei Ihnen.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'company' => ['nullable', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'message' => ['required', 'string', 'min:12', 'max:2000'],
        ], [
            'required' => 'Bitte füllen Sie das Feld :attribute aus.',
            'email' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
            'min' => 'Das Feld :attribute muss mindestens :min Zeichen enthalten.',
            'max' => 'Das Feld :attribute darf höchstens :max Zeichen enthalten.',
            'string' => 'Das Feld :attribute muss ein Textwert sein.',
        ], [
            'name' => 'name',
            'company' => 'unternehmen',
            'email' => 'e-mail',
            'phone' => 'telefon',
            'message' => 'nachricht',
        ]);

        $lead = Lead::create($validated);

        Log::info('Neue Kontaktanfrage eingegangen.', $lead->only([
            'name',
            'company',
            'email',
            'phone',
            'message',
            'created_at',
        ]));

        return redirect()
            ->route('home')
            ->with('status', 'Ihre Anfrage wurde übermittelt. Wir melden uns in Kürze bei Ihnen.');
    }
}
