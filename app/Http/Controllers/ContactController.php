<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Organisation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts=Contact::all();
        return view('contacts.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $orgData = $request->only(['nom_org', 'adresse', 'code_postal', 'ville', 'statut']);
        $orgData['nom_org'] = ucfirst($orgData['nom_org']);
        $orgData['ville'] = ucfirst($orgData['ville']);
        $orgData['cle'] = bin2hex(random_bytes(16));
        $orgData['active'] = 1;
        $org = Organisation::create($orgData);

        $contactData = $request->only(['nom', 'prenom', 'email', 'telephone_fixe', 'service', 'fonction']);

        $contactData['nom'] = ucfirst($contactData['nom']);
        $contactData['prenom'] = ucfirst($contactData['prenom']);
        $contactData['email'] = strtolower($contactData['email']);
        $contactData['organisation_id'] = $org->id;
        $contactData['cle'] = bin2hex(random_bytes(16));
        $contactData['active'] = 1;
        Contact::create($contactData);
        return Redirect::route('contacts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contact=Contact::find($id);
        dd($id);
        return view('contacts.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact = Contact::findOrFail($id);
        $org = Organisation::findOrFail($contact->organisation_id);

        // Mise à jour des données du contact
        $contactData = $request->only(['nom', 'prenom', 'email', 'telephone_fixe', 'service', 'fonction']);
        $contactData['nom'] = ucfirst($contactData['nom']);
        $contactData['prenom'] = ucfirst($contactData['prenom']);
        $contactData['email'] = strtolower($contactData['email']);

        // Utilisation de la méthode update() pour mettre à jour les données du contact
        $contact->update($contactData);

        // Mise à jour des données de l'organisation
        $orgData = $request->only(['nom_org', 'adresse', 'code_postal', 'ville', 'statut']);
        $orgData['nom_org'] = ucfirst($orgData['nom_org']);
        $orgData['ville'] = ucfirst($orgData['ville']);

        // Utilisation de la méthode update() pour mettre à jour les données de l'organisation
        $org->update($orgData);

        return Redirect::route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return Redirect::route('contacts.index');
    }
}
