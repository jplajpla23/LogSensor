<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Sensor;
use App\Alert;
use Auth;
class SensorController extends Controller
{
    //
    public function list()
    {
    	$sensors=Sensor::all()->where('user_id',Auth::user()->id);
    	return view('listSensors',compact('sensors'));
    }
    public function newSave(Request $request)
    {
    	
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'mac' => 'required|string|unique:sensors',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'Threshold' => 'required|numeric',
        ]);
    	if ($validator->fails()) {
            return redirect()->route('listSensores')
            ->withErrors($validator)
            ->withInput();
        }
        if($request->min>$request->max)
        {
          return redirect()->route('listSensores')
          ->withErrors("The maximum must be greater or equal than Minimum")
          ->withInput();
      }
      $s=new Sensor;
      $s->name=$request->name;
      $s->user_id=Auth::user()->id;
      $s->mac=$request->mac;
      $s->min=$request->min;
      $s->max=$request->max;
      $s->threshold=$request->Threshold;
      $s->save();
      return redirect()->route('listSensores')->withSuccess('Sensor created with Success');
  }
  public function delete(Request $request)
  {
     $validator = Validator::make($request->all(), [
        'id' => 'required|integer',
    ]);
     if ($validator->fails()) {
        return redirect()->route('listSensores');
    }
    Alert::where('sensors_id',$request->id)->delete();
    $s=Sensor::destroy($request->id);
    return redirect()->route('listSensores')->withSuccess('Sensor removed with Success');
}
public function edit($id)
{
    $sensor=Sensor::findOrFail($id);
    return view('editSensor',compact('sensor'));
}
public function editSave(Request $request)
{
    if($request->has('mac')){

        if(strcmp($request->mac, Sensor::findOrFail($request->id)->mac)==0){
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer',
                'name' => 'required|string',
                'mac' => 'required|string',
                'min' => 'required|numeric',
                'max' => 'required|numeric',
                'Threshold' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return redirect()->route('editSensor', $request->id)
                ->withErrors($validator)
                ->withInput();
            }
            $s=Sensor::findOrFail($request->id);
            $s->name=$request->name;
            $s->user_id=Auth::user()->id;
            //$s->mac=$request->mac;
            $s->min=$request->min;
            $s->max=$request->max;
            $s->threshold=$request->Threshold;
            $s->save();
            return redirect()->route('listSensores')->withSuccess('Sensor updated with Success');
        }else{
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer',
                'name' => 'required|string',
                'mac' => 'required|string|unique:sensors',
                'min' => 'required|numeric',
                'max' => 'required|numeric',
                'Threshold' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return redirect()->route('editSensor', $request->id)
                ->withErrors($validator)
                ->withInput();
            }
            $s=Sensor::findOrFail($request->id);
            $s->name=$request->name;
            $s->user_id=Auth::user()->id;
            $s->mac=$request->mac;
            $s->min=$request->min;
            $s->max=$request->max;
            $s->threshold=$request->Threshold;
            $s->save();
            return redirect()->route('listSensores')->withSuccess('Sensor updated with Success');
        }
    }else{
        return redirect()->route('editSensor', $request->id);
    }


}


}
