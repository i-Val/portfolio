<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::query()
            ->orderBy('is_read')
            ->orderByDesc('created_at')
            ->paginate(30);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        if (! $contactMessage->is_read) {
            $contactMessage->forceFill([
                'is_read' => true,
                'read_at' => now(),
            ])->save();
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')->with('status', 'Message deleted.');
    }

    public function mark(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'is_read' => ['required', 'boolean'],
        ]);

        $isRead = (bool) $validated['is_read'];

        $contactMessage->forceFill([
            'is_read' => $isRead,
            'read_at' => $isRead ? now() : null,
        ])->save();

        return back()->with('status', $isRead ? 'Marked as read.' : 'Marked as unread.');
    }
}
