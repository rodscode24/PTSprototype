<?php

namespace App\Http\Controllers;

use App\Mail\GeneralContactInquiryMail;
use App\Models\ContactInquiry;
use App\Models\ContactPageSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:80'],
            'last_name' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email:rfc', 'max:254'],
            'phone' => ['nullable', 'string', 'max:60'],
            'subject' => ['required', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:2000'],
            'website' => ['nullable', 'max:0'], // Honeypot: should remain blank.
        ]);

        unset($validated['website']);

        $toEmail = ContactPageSetting::current()->form_to_email;
        $toName = config('contact.to_name');

        $inquiry = ContactInquiry::create([
            ...$validated,
            'sent_to' => $toEmail,
        ]);

        $inquiry->forceFill([
            'identifier' => 'GCI'.$inquiry->id,
        ])->save();

        Mail::to($toEmail, $toName)->send(new GeneralContactInquiryMail($inquiry));

        Log::channel(config('logging.default'))->info('PTS general contact inquiry', [
            'reference' => $inquiry->identifier,
            'sent_to' => $toEmail,
            'name' => $inquiry->full_name,
            'email' => $inquiry->email,
            'phone' => $inquiry->phone ?: null,
            'subject' => $inquiry->subject,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you. Your message has been received by the PTS team.',
            'reference' => $inquiry->identifier,
        ]);
    }
}
