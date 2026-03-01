<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\SharedAccommodation;
use Illuminate\Http\Request;
use App\Models\Membership;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $colocation = SharedAccommodation::findOrFail($id);
        return view('member.colocations.invitation', compact('colocation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $colocation = SharedAccommodation::findOrFail($id);

        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = strtolower(trim($validated['email']));

        $exists = Invitation::where('shared_accommodation_id', $id)
            ->where('status', 'pending')
            ->whereRaw('LOWER(email) = ?', [$email])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Invitation already sent to this email.');
        }

        $invitation = Invitation::create([
            'email' => $email,
            'token' => Str::random(64),
            'status' => 'pending',
            'shared_accommodation_id' => $colocation->id,
        ]);

        $inviteLink = route('invitations.show', $invitation->token);

        try {
            Mail::raw("Hello \nClick this link:\n\n{$inviteLink}", function ($message) use ($email) {
                $message->to($email)->subject('Invitation to join EasyColoc');
            });
        } catch (\Throwable $e) {
            $invitation->delete();
            $errorMessage = 'Invitation created but email failed. Check your mail SMTP configuration.';

            return back()->with('error', $errorMessage);
        }

        return redirect()
            ->route('member.colocations.invitation.index', $id)
            ->with('success', 'Invitation sent successfully.')
            ->with('token', 'token : ' . $invitation->token);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $token)
    {
        $invitation = Invitation::with('sharedAccommodation')
            ->where('token', $token)
            ->firstOrFail();

        $userExists = User::where('email', $invitation->email)->exists();

        if (!$userExists) {
            $email = $invitation->email;
            $invitation_token = $invitation->token;

            return redirect()->route('register', compact('email', 'invitation_token'));
        }

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->email !== $invitation->email) {
            return redirect()->route('dashboard')
                ->with('error', 'This invitation is not for your email.');
        }

        return view('invited', compact('invitation'));
    }

    public function accept(string $token)
    {
        $invitation = Invitation::with('sharedAccommodation')
            ->where('token', $token)
            ->firstOrFail();

        $user = auth()->user();


        $hasActiveMembership = Membership::where('user_id', $user->id)
            ->where('is_active', true)
            ->exists();

        if ($hasActiveMembership) {
            return redirect()
                ->route('invitations.show', $invitation->token)
                ->with('error', 'You already have an active membership in colocation.');
        }

        Membership::create([
            'user_id' => $user->id,
            'shared_accommodation_id' => $invitation->shared_accommodation_id,
            'role' => 'member',
            'joined_at' => now(),
            'left_at' => null,
            'is_active' => true,
            'has_debt' => false,
        ]);

        $invitation->update(['status' => 'accepted']);

        return redirect()
            ->route('member.colocations.show', $invitation->shared_accommodation_id)
            ->with('success', 'Invitation accepted successfully. You are now a member of this colocation.');
    }

    public function decline(string $token)
    {
        $invitation = Invitation::with('sharedAccommodation')
            ->where('token', $token)
            ->firstOrFail();

        $invitation->update(['status' => 'declined']);

        return redirect()
            ->route('invitations.show', $invitation->token)
            ->with('success', 'Invitation declined.');
    }

}
