<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/logout",
        "/sso/login-2",
        "https://portal.vnpttravinh.vn/*",
        "http://portal.vnpttravinh.vn/*",
        "http://113.163.69.248/*",
        "http://10.90.199.229/*"

    ];
}
