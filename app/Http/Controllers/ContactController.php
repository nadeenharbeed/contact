<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts =Contact::orderBy('id' ,'desc')->paginate(10);
        return response()->view('dashboard.Contact.index' ,compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('dashboard.Contact.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator= validator($request->all(),[
            'name'=>'required ',
            'mobile'=>'required ',
            'email'=>'required ',
            'message'=>'required ',
        ]
    );
        if ($validator->fails()){
            return response()->json([
                'icon'=>'error',
                'title'=>$validator->getMessageBag()->first()],
                400);}
        else{
            $contacts = new Contact();
              $contacts->name =$request->get('name');
              $contacts->name =$request->post('mobile');
              $contacts->name =$request->input('email');
              $contacts->code =$request->post('message');

              $isSaved =$contacts->save();
              return response()->json([
                'icon'=>'success',
                'title'=>'Created is Successfully'],
                200);

        }

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
