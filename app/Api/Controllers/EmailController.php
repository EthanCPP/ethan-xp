<?php

namespace App\Api\Controllers;

use App\Mail\ContactEmail;
use App\Models\File;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send()
    {
        $data = request()->all();

        if ($data['token'] != csrf_token()) {
            return response()->json(['message' => 'An error occurred trying to send the email.']);
        }

        if (! $data['subject'] || ! $data['message'] || ! $data['from'] || ! $data['name']) {
            return response()->json(['message' => 'Please enter all the fields']);
        }

        if (! filter_var($data['from'], FILTER_VALIDATE_EMAIL)) {
            return response()->json(['message' => 'Please enter a valid email address']);
        }

        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactEmail($data['subject'], $data['message'], $data['from'], $data['name']));

        return response()->json(['success' => true]);
    }
}