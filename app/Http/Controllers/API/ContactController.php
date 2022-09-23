<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = Contact::all();
        return response()->json([
            'status' => 200,
            'message' => $contacts
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contactName' => 'required|max:191',
            'contactNumber' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'validation_error' => $validator->messages(),
            ]);
        }
        $contact = new Contact();
        $contact->contactName = $request->contactName;
        $contact->contactNumber = $request->contactNumber;
        $contact->save();
        return response()->json([
            'status' => 200,
            'message' => 'Contact Added Successfully!'
        ]);
    }

    public function edit($id)
    {
        $contact = Contact::find($id);
        return response()->json([
            'status' => 200,
            'contact' => $contact,
        ]);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'contactName' => 'required|max:191',
            'contactNumber' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'validation_error' => $validator->messages(),
            ]);
        }


        $contact = Contact::find($id);
        $contact->contactName = $request->contactName;
        $contact->contactNumber = $request->contactNumber;
        $contact->update();
        return response()->json([
            'status' => 200,
            'message' => 'Contact Updated Successfully!'
        ]);
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Contact Deleted Successfully!'
        ]);
    }
}
    