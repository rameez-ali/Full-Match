<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Videoclub;
use App\Model\Club;
use App\Model\Fullmatchcontact;
use Illuminate\Support\Facades\Validator;

class ContactUSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        $this->middleware('can:view-contactus', ['only' => ['index', 'show']]);
        $this->middleware('can:edit-contactus', ['only' => ['edit', 'update']]);
    }

    public function index()
    {
        $fullmatchcontact = Fullmatchcontact::all();
        return view('admin.contactus.index', compact('fullmatchcontact'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fullmatchcontact=Fullmatchcontact::find($id);
        return view('admin.contactus.edit',compact('fullmatchcontact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
                'call_us'    =>  'required',
                'email_us'    =>  'required',
                'address_en'    =>  'required',
                'address_ar'    =>  'required'
            ];


        $form_data = array(
            'call_us'       =>   $request->call_us,
            'email_us'       =>   $request->email_us,
            'address_en'       =>   $request->address_en,
            'address_ar'       =>   $request->address_ar
        );

        Fullmatchcontact::whereId($id)->update($form_data);

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return $this->FailResponse("Validation error", $validator->getMessageBag(), 200);
        }


        return redirect('Contactus-form')->with('contactuseditsuccess','Contact Information Updated Successfully');

        //  return redirect('club-form')->with('clubeditsuccess','Club Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {



    }
}
