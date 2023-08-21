<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestAccessEmail;
use App\Models\EmailRequest;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        try {
            // Validate input
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
            ]);

            // Save to database
            $requestAccess = new EmailRequest();
            $requestAccess->name = $validatedData['name'];
            $requestAccess->email = $validatedData['email'];
            $requestAccess->save();

            // Return a success response
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error saving data:', ['error' => $e->getMessage()]);
            // Return an error response
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function show()
    {
        $savedData = EmailRequest::all();
        return view('emails.show', compact('savedData'));
    }


}