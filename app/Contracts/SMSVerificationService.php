<?php

namespace App\Contracts;

interface SMSVerificationService {
    public function sendCode($phone_number, $additional_data = []): String;
    public function verifyCode($phone_number, $code, $additional_data = []): Boolean;
}

?>