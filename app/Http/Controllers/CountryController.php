<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries =Country ::withCount('cities')->orderBy('id','desc')->paginate(10);

        return response()-> view('dashboard.country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()-> view('dashboard.country.create');

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
            'name'=>'required | min:3 |max:15',
            'code'=>'required | numeric | digits :3',
        ] /** ,[
            *'name.required'=>'حقل  الدولة  مطلوب ',
           * 'code.required'=>'حقل الكود مطلوب',
           * 'name.min'=>'لا يمكن كتابة اسم الدولة ب 3 حروف'
        *]    when you want message in Arabic*/
    );
        if ($validator->fails()){
            return response()->json([
                'icon'=>'error',
                'title'=>$validator->getMessageBag()->first()],
                400);}
        else{
            $countries = new Country();
            //  $countries->name =$request->name;
            //  $countries->name =$request->get('name');
            //  $countries->name =$request->post('name');
              $countries->name =$request->input('name');
              $countries->code =$request->post('code');
              //all this is right
              $isSaved =$countries->save();
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
        $countries =Country :: findorfail($id);
        return response()->view('dashboard.country.edit',compact('countries'));
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
        $validator = validator($request->all(),[
            'name'=>'required | min:3 |max:15',
            'code'=>'required | numeric | digits :3',] ,[
                'name.required'=>'حقل  الدولة  مطلوب ',
           'code.required'=>'حقل الكود مطلوب',
           'name.min'=>'لا يمكن كتابة اسم الدولة ب 3 حروف' ,

            ]);

            if (!$validator->fails()){
                $countries =Country ::findOrfail($id);
                $countries->name =$request->input('name');
                $countries->code =$request->post('code');

                $isUpdate =$countries->save();

                return ['redirect'=>route('countries.index')];

            }
            else{
                return response()->json([
                    'icon'=>'error',
                    'title'=>$validator->getMessageBag()->first()],
                    400);}
            }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $countries = Country :: destroy($id);
    }
}
