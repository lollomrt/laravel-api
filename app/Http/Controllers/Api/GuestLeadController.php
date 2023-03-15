<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


use App\Models\GuestLead;
use App\Mail\GuestContact;

class GuestLeadController extends Controller
{
    public function store(Request $request){
        // recuperiamo i dati della form
        $form_data = $request->all();
        //andiamo a validare
        $validator = Validator::make($form_data, [
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        //se la validazione fallisce
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        //altrimenti va a vanti e salva le info nel database
        $newContact = new GuestLead();
        $newContact->fill($form_data);
        $newContact->save();

        //inviamo la mail
        Mail::to('info@boolpress.com')->send(new GuestContact($newContact));

        return response()->json([
            'success' => true
        ]);
    }
}
