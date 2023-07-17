<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities =City::with('country')->OrderBy('id' ,'desc')->paginate(10);
        return response()->view('dashboard.city.index' ,compact('cities'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
      return response()->view('dashboard.city.create' , compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =Validator($request->all(),[
            'name'=>'required',
            'street'=>'required',
            'country_id'=>'required',
        ]);
        if ( !$validator->fails()){
            $cities=new City();
            $cities->name=$request->post('name');
            $cities->street=$request->post('street');
            $cities->country_id=$request->post('country_id');

            $isSaved=$cities->save();
            if($isSaved){ // is not important but if i want more nice
            return response()->json([
                'icon'=>'success',
                'title'=>'Created is Successfuly'],200);}
            else{

            }
            return response()->json([
                'icon'=>'error',
                'title'=>'Created is Failed'],400);}
        else{
            return response()->json([
                'icon'=>'error',
                'title'=> $validator->getMessageBag()->first()],

          400  );}

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
        $cities=City::findOrfail($id); /** findor fail use to how i know the element i want */
        $countries=Country::all();
        return response()->view('dashboard.city.edit' , compact('cities','countries'));
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
        $validator =validator($request->all(),[
            'name'=>'required',
            'street'=>'required',
            'country_id'=>'required',
        ]);
        if ( ! $validator->fails()){
            $cities=City::findOrfail($id);

            $cities->name=$request->post('name');
            $cities->street=$request->post('street');
            $cities->country_id=$request->post('country_id');

            $isUpdate=$cities->save();
            return ['redirect'=>route('cities.index')];}
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
        $cities =City::destroy($id);
    }
}
