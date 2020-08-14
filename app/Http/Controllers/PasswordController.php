<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'password' => ['required', 'password']
        ]);

        if ($request->wantsJson()) {
            return response([
                'data' => true
            ]);
        }
    }
}
