<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Country;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->all('search');

        $contacts = Contact::with(['organization'])
            ->filter($filter)
            ->paginate(10);

        return Inertia::render('Contacts/Index', compact('contacts', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organizations = Organization::all();
        $countries = Country::all();

        return Inertia::render('Contacts/Create', compact('organizations', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'country_id' => 'required|exists:countries,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:contacts',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',

        ]);

        $contact = Contact::create($data);

        return redirect()->route('contacts.edit', $contact)->with('success', 'Contact created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $organizations = Organization::all();
        $countries = Country::all();

        return inertia::render('Contacts/Edit', compact('contact', 'organizations', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'country_id' => 'required|exists:countries,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:contacts,email,'. $contact->id,
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',

        ]);

        $contact->update($data);

        return redirect()->route('contacts.edit', $contact)->with('success', 'Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully');
    }
}
