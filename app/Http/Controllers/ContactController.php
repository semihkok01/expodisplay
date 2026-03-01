<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $redirectParameters = ['lang' => app()->getLocale()];

        if ($request->filled('website')) {
            return redirect()
                ->route('home', $redirectParameters)
                ->with('status', __('common.contact.status_success'));
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'company' => ['nullable', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'message' => ['required', 'string', 'min:12', 'max:2000'],
            'captcha_answer' => ['required'],
        ], [
            'required' => __('common.contact.validation.required'),
            'email' => __('common.contact.validation.email'),
            'min' => __('common.contact.validation.min'),
            'max' => __('common.contact.validation.max'),
            'string' => __('common.contact.validation.string'),
        ], [
            'name' => __('common.contact.attributes.name'),
            'company' => __('common.contact.attributes.company'),
            'email' => __('common.contact.attributes.email'),
            'phone' => __('common.contact.attributes.phone'),
            'message' => __('common.contact.attributes.message'),
            'captcha_answer' => __('common.contact.attributes.captcha_answer'),
        ]);

        $expectedAnswer = (int) $request->session()->get('contact_challenge.answer', -1);
        $submittedAnswer = (int) preg_replace('/\D+/', '', (string) $validated['captcha_answer']);

        if ($submittedAnswer !== $expectedAnswer) {
            return redirect()
                ->route('home', $redirectParameters)
                ->withErrors([
                    'captcha_answer' => __('common.contact.validation.captcha_invalid'),
                ])
                ->withInput($request->except('captcha_answer'));
        }

        unset($validated['captcha_answer']);

        $lead = Lead::create($validated);

        Log::info('Neue Kontaktanfrage eingegangen.', $lead->only([
            'name',
            'company',
            'email',
            'phone',
            'message',
            'created_at',
        ]));

        try {
            Mail::raw(
                "Neue Kontaktanfrage über expo-display.de\n\n"
                ."Name: {$lead->name}\n"
                .'Unternehmen: '.($lead->company ?: '-')."\n"
                ."E-Mail: {$lead->email}\n"
                .'Telefon: '.($lead->phone ?: '-')."\n\n"
                ."Nachricht:\n{$lead->message}\n",
                function ($message): void {
                    $message
                        ->to('info@expo-display.de')
                        ->replyTo(request('email'), request('name'))
                        ->subject('Neue Kontaktanfrage | EXPO DISPLAY');
                }
            );
        } catch (Throwable $exception) {
            Log::error('Kontaktformular E-Mail konnte nicht gesendet werden.', [
                'message' => $exception->getMessage(),
            ]);
        }

        $first = random_int(2, 9);
        $second = random_int(1, 6);
        $request->session()->put('contact_challenge', [
            'first' => $first,
            'second' => $second,
            'answer' => $first + $second,
        ]);

        return redirect()
            ->route('home', $redirectParameters)
            ->with('status', __('common.contact.status_success'));
    }
}
