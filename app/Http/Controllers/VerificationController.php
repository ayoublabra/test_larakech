<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerificationController extends Controller
{
    public function verification(Request $request){
        $organisationExist=false;
        $contactExist=false;
        $msgOrganisation="";
        $msgContact="";
        $nom_organisationMin=strtolower($request->nom_org);
        // $nom_organisationF=ucwords($request->nom_org);
        $organisations=Organisation::all();
        foreach ($organisations as $organisation) {
            if (strtolower($organisation->nom_org)==$nom_organisationMin) {
                $organisationExist=true;
                $msgOrganisation = "Il existe déjà le nom de cette organitation"; 

            }
        }

        $contacts = Contact::all();
        foreach ($contacts as $contact) {
            if (strtolower($contact->nom) == strtolower($request->nom) && strtolower($contact->prenom) == strtolower($request->prenom)) {
                    $contactExist=true;
                    $msgContact = "Il existe déjà avec ce nom et le prenom dans l organisation"; 
            }
        }
        $result = [
            'organisationExist' => $organisationExist,
            'msgOrganisation' => $msgOrganisation,
            'contactExist' => $contactExist,
            'msgContact' => $msgContact
        ];
        

        return response()->json($result);
    }
    // public function verificationContact(Request $request){
    //     $contactExist=false;
    //     $msgContact="";
    //     $contacts = Contact::all();
    //     foreach ($contacts as $contact) {
    //         if (strtolower($contact->nom) == strtolower($request->nom) && strtolower($contact->prenom) == strtolower($request->prenom)) {
    //                 $contactExist=true;
    //                 $msgContact = "Il éxiste déjà avec ce nom et le prenom dans une organisation"; 
    //         }
    //     }
    //     $result = [
    //         'contactExist' => $contactExist,
    //         'msgContact' => $msgContact
    //     ];
        

    //     return response()->json($result);
    // }
}
