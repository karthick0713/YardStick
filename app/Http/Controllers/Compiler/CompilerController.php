<?php

namespace App\Http\Controllers\Compiler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompilerController extends Controller
{

    public function run_code(Request $request)
    {

        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'onecompiler-apis.p.rapidapi.com',
            'X-RapidAPI-Key' => 'fb09126baamsha957b25bb000b36p12ea47jsn9cd2d63ba6f2',
            'Content-Type' => 'application/json',
        ])
            ->post('https://onecompiler-apis.p.rapidapi.com/api/v1/run', [
                'language' => $request->input('language'),
                'stdin' => $request->input('stdin'),
                'files' => [
                    [
                        'name' => $request->input('filename'),
                        'content' => $request->input('content'),
                    ],
                ],
            ]);

        $result = $response->json();

        return $result;
    }
}