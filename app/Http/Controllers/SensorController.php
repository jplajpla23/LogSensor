<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Sensor;
use App\Alert;
use Auth;
use App\User;
use Mail;
use App\History;
class SensorController extends Controller
{
    //
    public function list()
    {
    	$sensors=Sensor::all()->where('user_id',Auth::user()->id);
     foreach ($sensors as $sensor) {
        $last=History::all()->where('sensors_id',$sensor->id)->last();
        if($last !=null){
            $sensor->lastValue=$last->value;
            $sensor->At=$last->created_at;
        }else{
           $sensor->lastValue="-";
           $sensor->At="-";
       }

        $dt[$sensor->id]=History::select('value','created_at')->where('sensors_id', $sensor->id)->get();
    }
    return view('listSensors',compact('sensors','dt'));
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

public function getTreshold($mac)
{
    $s=Sensor::all()->where("mac",$mac)->first()->threshold;
    return $s;
}
public function newReading(Request $request)
{
    $validator = Validator::make($request->all(), [
        'str' => 'required|json',
    ]);
    if ($validator->fails()) {
       // return response();
    }
            //{"str":""+packet+""}
    
    $parts=explode("_/", $request->str);
    $sensor=Sensor::where('mac', '=',$parts[0])->firstOrFail();
    $h= new History;
    $h->sensors_id=$sensor->id;
    $h->value= floatval($parts[1]);
    $h->save();
    $alerts=Alert::all()->where('sensors_id',$sensor->id);

    foreach ($alerts as $alert) {
        if($h->value<=$alert->max && $h->value>=$alert->min)
        {

        }
        else{
            $user=User::findOrFail($sensor->user_id);
            $data=['title' => "Alert for Sensor", 'data' => $h,'sensor'=>$sensor,'alert'=>$alert];
            
            Mail::send('emails.email', $data, function($message) use($user){
                $message->to($user->email, $user->name)->subject('Log Sensor Alerts!!');
            });
        }
    }
    return response()->json(['success' => 'success', 200]);}

}
