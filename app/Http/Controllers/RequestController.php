<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestRequest;
use App\Models\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class RequestController extends Controller
{
    public function create()
    {
        return view('create-request');
    }

    public function store(StoreRequestRequest $request)
    {
        $newRequest = Request::create([...$request->all(), 'user_id' => auth()->id()]);

        // check for files
        if ($request->hasFile('attachments')) {
            $attachments = $request->file('attachments');
            foreach ($attachments as $attachment) {
                $originalName = $attachment->getClientOriginalName();
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                $path = Storage::disk('public')->put('attachments', $attachment);

                // create record for new files and relate to request
                File::create([
                    'path' => $path,
                    'type' => $extension,
                    'request_id' => $newRequest->id
                ]);
            }
        }

        return redirect()->to(route('home'));
    }

    public function show(Request $request)
    {
        return view('request', compact('request'));
    }

    public function supervisorApprove(Request $request)
    {
        $request->has_supervisor_approved = 1;
        $request->save();

        return redirect()->to(route('home'));
    }

    public function managerApprove(Request $request)
    {
        // check for approving by supervisor
        if ($request->has_supervisor_approved == 0) {
            return redirect()->to(route('home'))->with('message', 'نیاز به تایید سرپرست');
        }

        $request->has_manager_approved = 1;
        $request->save();

        return redirect()->to(route('home'));
    }
}
