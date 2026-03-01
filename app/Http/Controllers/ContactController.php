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
            ->route('home', $redirectParameters)
            ->with('status', __('common.contact.status_success'));
    }
}
