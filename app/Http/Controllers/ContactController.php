<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        Contact::create($data);
        // dd($data);

        return back()->with('status-message', 'your message sent sussfully');
    }
}
