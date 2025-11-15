<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SOAController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view client soa', only: ['client']),
            new Middleware('permission:view supplier soa', only: ['supplier']),
        ];
    }

    /**
     * Display client SOA.
     */
    public function client()
    {
        return view('accounting.client');
    }

    /**
     * Display client SOA.
     */
    public function supplier()
    {
        return view('accounting.supplier');
    }
}
