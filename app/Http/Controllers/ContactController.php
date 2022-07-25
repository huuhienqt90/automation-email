<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $contacts = Contact::paginate(12);
        return Inertia::render('Contact/Index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Company::all();
        return Inertia::render('Contact/Create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContactRequest $request
     * @return RedirectResponse
     */
    public function store(StoreContactRequest $request)
    {
        $contact = Contact::create($request->validated());
        $this->uploadImage($request, $contact);
        return redirect()->route('contacts.index')->with('success', 'Create contact success.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contact $contact
     * @return Response
     */
    public function edit(Contact $contact)
    {
        $companies = Company::all();
        return Inertia::render('Contact/Edit', compact('contact', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateContactRequest $request
     * @param Contact $contact
     * @return RedirectResponse
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());
        $this->uploadImage($request, $contact);
        return redirect()->route('contacts.index')->with('success', 'Update contact success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contact $contact
     * @return RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Delete contact success.');
    }

    /**
     * @param UpdateContactRequest|StoreContactRequest $request
     * @param Contact $contact
     * @return void
     */
    protected function uploadImage(UpdateContactRequest|StoreContactRequest $request, Contact $contact): void
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('avatars');
            $contact->avatar = $path;
            $contact->save();
        }
    }
}
