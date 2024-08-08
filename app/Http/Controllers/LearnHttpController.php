<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://jsonplaceholder.typicode.com/posts', [
            'title' => 'foo',
            'body' => 'bar',
            'userId' => 1,
        ]);
        $response->created(); //true
    }
}
