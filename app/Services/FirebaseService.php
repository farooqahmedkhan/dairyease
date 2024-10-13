<?php 

namespace App\Services;

use App\Contracts\SMSVerificationService;

class FirebaseService implements SMSVerificationService {
    protected $auth;
    function __construct(){
        $firebase = (new Factory)->withServiceAccount(config('firebase.credentials.file'));
        $this->auth = $firebase->createAuth();
    }

    public function sendCode($phone_number, $additional_data = []): String {
        $sessionToken = NULL;

        $validator = \Illuminate\Support\Facades\Validator::make([
            'phone_number' => 'required|exists:users,phone'
        ], []);

        $validatedData = $validator->validated();
        $sessionInfo = $this->auth->signInWithPhoneNumber($validatedData['phone_number']);
        
        return $sessionToken;
    }

    public function verifyCode($phone_number, $verification_code, $additional_data = []) {
        $validator = \Illuminate\Support\Facades\Validator::make([
            'phone_number'  => $phone_number,
            'code'          => $verification_code,
            'session_token' => $data['token'] ?? NULL
        ], [
            'phone_number'  => 'required|exists:users,phone',
            'session_token' => [
                'required',
                \Illuminate\Validation\Rule::exists('users')->where(function($q) use ($phone_number) {
                    $q->where('phone', $phone_number);
                    $q->whereNull('phone_verified_at');
                    return $q;
                })
            ]
        ]);
        
        $validatedData = $validator->validated();
        $verifiedUser = $this->auth->verifyPhoneNumber($validated['verification_code'], $validated['sessionInfo']);

        return $verifiedUser;
    }
 }

?>