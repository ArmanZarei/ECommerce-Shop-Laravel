<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivationCode;
use App\Notifications\ActivationCode as ActivationCodeNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ActivationController extends Controller
{
    public function activationPage()
    {
        $activationCode = auth()->user()->activationCode;
        if (!$activationCode || $isExpired = Carbon::now()->diff($activationCode->expires_at)->invert) {
            if (isset($isExpired) && $isExpired)
                $activationCode->delete();

            $activationCode = auth()->user()->activationCode()->create([
                'code' => strval(random_int(100000, 999999)),
                'token' => Hash::make(\Str::random(32)),
                'expires_at' => Carbon::now()->addMinutes(2),
            ]);
        }

        auth()->user()->notify(new ActivationCodeNotification($activationCode->code));

        return view('front.authentication.activate', [
            'token' => $activationCode->token,
            'expiresIn' => Carbon::now()->diffInSeconds($activationCode->expires_at),
        ]);
    }

    public function handleActivation(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
            'token' => 'required'
        ]);

        $err = null;
        $activationCode = ActivationCode::where('token', $request->get('token'))->first();
        if ($activationCode->code != $request->get('code'))
            $err = 'Wrong code';
        else if (Carbon::now()->diff($activationCode->expires_at)->invert) {
            $err = 'Code expired. New code has sent.';
        }
        if ($err)
            return redirect()->back()->withErrors(['code' => $err]);

        $activationCode->user()->update(['activated_at' => Carbon::now()]);
        $activationCode->delete();

        return redirect()->route('home');
    }
}
