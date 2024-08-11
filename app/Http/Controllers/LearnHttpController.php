<?php

namespace App\Http\Controllers;


use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LearnHttpController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        //Sending a get respons
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/1');

        //response: body, json, status, collect, headers, redirect, successful, faild, clientError
        $response->body(); // return string
        $response->json();
        $response->status(); // 200
        $response->collect()['id']; //1
        $response->successful(); //true
        $response->collect()->where('userId', '=', 1)->first();
        $response->failed(); //false
        $response->clientError(); //false


        //response is ArrayAccess
        $response->headers()['Content-Type'];


        //define status method

        //query pramentrs-- data filter
        $response = Http::get('https://jsonplaceholder.typicode.com/posts', [
            'userId' => 1, // This is a query parameter
        ]);


        //post request: form data, json data

        $response = Http::asForm()->post('https://jsonplaceholder.typicode.com/posts', [
            'title' => 'foo',
            'body' => 'bar',
            'userId' => 1,
        ]);
        $response->created(); //true

        //generat: Basic Authenticaton, Bearar Token, retries, timeout, error handling, dumping, throwingException, headers

        $response = Http::withBasicAuth('admin@gmail.com', 'pass123456word')->withToken('hhsnshc')->post('https://jsonplaceholder.typicode.com/posts', [
            'title' => 'foo',
            'body' => 'bar',
            'userId' => 1,
        ]);
        $response->created(); //true

        //headers
        $response = Http::dd()->withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://jsonplaceholder.typicode.com/posts', [
            'title' => 'foo',
            'body' => 'bar',
            'userId' => 1,
        ]);
        $response->created(); //true


        /**
         *  timeout
         *  The timeout method sets the maximum number of seconds to wait for a response.
         */

        $response = Http::timeout(5) // Timeout after 5 seconds
            ->get('https://jsonplaceholder.typicode.com/posts/1');

        if ($response->successful()) {
            dd($response->json());
        } else {
            abort(404);
        }

        /**
         *  retries
         *  The retry method retries the request a specified number of times if it fails, with a delay between each attempt.
         */

        $response = Http::retry(3, 100) // retry 3 times ,with a 100ms delay between attempts
            ->get('https://jsonplaceholder.typicode.com/posts/1');

        if ($response->successful()) {
            dd($response->json());
        } else {
            abort(404);
        }


        /**
         *  error handling
         *  Basic error heandling with throw() method
         */

        try {
            $response = Http::get('https://jsonplaceholder.typicode.c0m/posts/1')->throw();
            dd($response->json());
        } catch (RequestException $th) {
            return response()->json(['error' => 'Failed to fetch data.'], 500);
        }
    }
}
