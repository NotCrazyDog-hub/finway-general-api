<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeedbackController extends Controller
{
    
    public function index(Request $request)
    {
        $feedbacks = Feedback::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json($feedbacks, Response::HTTP_OK);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'type'    => 'required|integer|in:0,1,2',
        ]);

        $feedback = Feedback::create([
            'user_id' => $request->user()->id,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'type'    => $validated['type'],
            'status'  => Feedback::STATUS_ABERTO,
        ]);

        return response()->json($feedback, Response::HTTP_CREATED);
    }

    public function show(Feedback $feedback)
    {
        $this->authorizeUser($feedback);

        return response()->json($feedback, Response::HTTP_OK);
    }

    public function reply(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'admin_reply' => 'required|string',
        ]);

        $feedback->update([
            'admin_reply' => $validated['admin_reply'],
            'status'      => Feedback::STATUS_RESPONDIDO,
        ]);

        return response()->json($feedback, Response::HTTP_OK);
    }

    private function authorizeUser(Feedback $feedback)
    {
        if ($feedback->user_id !== auth()->id()) {
            abort(Response::HTTP_FORBIDDEN, 'Acesso não autorizado.');
        }
    }
}
