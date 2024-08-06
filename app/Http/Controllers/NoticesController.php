<?php

namespace App\Http\Controllers;

use App\Events\UserNotice;
use App\Models\notices;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NoticesController extends Controller
{
    public $Model;

    public function __construct()
    {
        $this->Model = new notices();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notices');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'notice' => 'required|string', // Ensure 'notice' is required and a string
        ]);

        $this->Model->notice = $validated['notice'];
        $this->Model->save();

        $data = ['notice' => $request->notice, 'date' => Carbon::now()->format('d-m-Y H:i:s')];
        //call event
        event(new UserNotice($data));

        return redirect()->route('notices.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(notices $notices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(notices $notices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, notices $notices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(notices $notices)
    {
        //
    }
}
