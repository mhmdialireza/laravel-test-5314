<?php

namespace App\Http\Controllers;

use App\Enums\Urgency;
use App\Http\Requests\StoreRequestRequest;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function create()
    {
        // return Urgency::values();
        return view('create-request');
    }

    public function store(StoreRequestRequest $request)
    {
        ModelsRequest::create([...$request->all(), 'user_id' => auth()->id()]);

        return redirect()->to(route('dashboard'));
    }
}
