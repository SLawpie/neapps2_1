<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

class UserService {

    static function getIps($request) {

        // $publicIp = file_get_contents('https://api.ipify.org');
        // $ip64 = file_get_contents('https://api64.ipify.org');

        $publicIp = $request->session()->get('ip', 'n/a');
        if ($request->ipaddress) {
            $publicIp = $request->ipaddress;
        }
        $clientIp = $request->ip();
    
        return [
            "publicIp" => $publicIp,
            "clientIp" => $clientIp,
        ];
    }

    static function getUserAgent($request) {
        $userAgent = $request->userAgent();

        return $userAgent;
    }

}
