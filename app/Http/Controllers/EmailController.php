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
        $unreadCount = $savedData->where('status', 'unread')->count();
        $readCount = $savedData->where('status', 'read')->count();

        return view('emails.show', compact('savedData', 'unreadCount', 'readCount'));
    }


    public function updateStatus(Request $request, $id)
    {
        try {
            $emailRequest = EmailRequest::findOrFail($id);

            // Update the status field
            $newStatus = $request->input('status');
            $emailRequest->status = $newStatus;
            $emailRequest->save();

            return redirect()->back()->with('success', 'Status updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Error updating status:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error updating status.');
        }
    }

    public function destroy($id)
    {
        try {
            $emailRequest = EmailRequest::findOrFail($id);
            $emailRequest->delete();

            return redirect()->back()->with('success', 'Request deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Error deleting request:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error deleting request.');
        }
    }






}