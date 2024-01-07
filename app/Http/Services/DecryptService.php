<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class DecryptService {

    public static function decryptRequest($request) {
        try {
            $decrypted = Crypt::decryptString($request);
        } catch (DecryptException $e) {
            return false;
        }
    
        return explode(";", $decrypted);
    }

    public static function decryptID($id) {
        try {
            $decrypted = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return back()->with([
                'messagetype' => 'alert',
                'message' => 'Coś poszło nie tak!.'
            ]);
        }

        return $decrypted;
    }
}

