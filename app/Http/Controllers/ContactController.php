<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Exception;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Please correct the errors below.'
            ], 422);
        }

        try {
            // 1. Save to Database
            $contactMessage = ContactMessage::create($validator->validated());

            // 2. Send Email
            // Use the MAIL_FROM_ADDRESS or a configure support email as the recipient
            $recipient = config('mail.from.address');

            if ($recipient) {
                Mail::to($recipient)->send(new ContactFormMail($contactMessage));
            }

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been sent successfully.'
            ]);

        } catch (Exception $e) {
            // Log the error
            \Log::error('Contact form error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was a problem sending your message. Please try again later.'
            ], 500);
        }
    }
}
