<?php

 namespace App\Services;

 use App\Contracts\SMSVerificationService;
 use App\Services\FirebaseService;

 class SMSVerifierFactory {
    public static function getVerifier(): SMSVerificationService {
        $provider = env('SMS_VERIFIER', 'firebase');

        switch($provider) {
            case 'firebase':
                return new FirebaseService();
                break;
            default:
                return NULL;
                break;
        }
    }
 }

?>