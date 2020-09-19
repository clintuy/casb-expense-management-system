<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('id',  auth()->user()->id)->firstOrFail();

        return view('pages.profile.profile', compact('user'));
    }

    public function change_password(Request $request)
    {
        $old_password = Hash::check($request['oldPassword'], auth()->user()->password);

        $validator = Validator::make($request->all(), [
            'oldPassword' => ['required', 'string', 'max:255',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('The old password didn\'t match');
                    }
                },
            ],
            'newPassword' => ['required', 'string', 'min:6', 'same:confirmPassword'],
            'confirmPassword' => ['required', 'string', 'min:6', 'same:newPassword']
        ]);

        if ($validator->passes()) {

            $user = User::where('id', auth()->user()->id)
                ->update([
                    'password' => Hash::make($request['newPassword'])
                ]);

            Auth::logout();
            return redirect('/login');
        }
    	return response()->json(['error'=>$validator->errors()->all()]);
    }
}
