<?php

namespace App\Http\Controllers;
use App\Alert;
use App\Sensor;
use Auth;
use Illuminate\Http\Request;
use Validator;
class AlertsController extends Controller
{

	public function listAlerts()
	{
		$sensors=Sensor::all()->where('user_id',Auth::user()->id);
		
		foreach ($sensors as $s) {
			$alerts[$s->id]=Alert::all()->where('sensors_id',$s->id);
			foreach ($alerts[$s->id] as $alert) {
				$alert->nameSensor=$s->name;
			}
		}
		//return dd($alerts);
		return view('listAlerts',compact('alerts'));
	}
	public function newAlert($id)
	{
		if(Sensor::findOrFail($id)->user_id == Auth::user()->id)
		{
			$sensor=Sensor::find($id);
			return view('newAlert',compact('sensor')); 
		}
		return redirect()->route('listAlerts');
	}
	public function newSave(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required|integer',
			'desc' => 'required|string',
			'message' => 'required|string',
			'min' => 'required|numeric',
			'max' => 'required|numeric',
		]);
		if ($validator->fails()) {
			return redirect()->route('createAlert')
			->withErrors($validator)
			->withInput();
		}
		$a=new Alert;
		$a->sensors_id=$request->id;
		$a->Description=$request->desc;
		$a->Message=$request->message;
		$a->min=$request->min;
		$a->max=$request->max;
		$a->save();
		return redirect()->route('listAlerts')->withSuccess('Alert created with Success');

	}
	public function delete(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required|integer',
		]);
		if ($validator->fails()) {
			return redirect()->route('listAlerts');
		}
		Alert::findOrFail($request->id)->delete();
		return redirect()->route('listAlerts')->withSuccess('Alert removed with Success');
	}
	public function edit($id)
	{
		$a=Alert::findOrFail($id);
		return view('alertEdit',compact('a'));
	}
	public function editSave(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required|integer',
			'desc' => 'required|string',
			'message' => 'required|string',
			'min' => 'required|numeric',
			'max' => 'required|numeric',
		]);
		if ($validator->fails()) {
			return redirect()->route('editAlert',$request->id)
			->withErrors($validator)
			->withInput();
		}
		$a=Alert::findOrFail($request->id);

		$a->Description=$request->desc;
		$a->Message=$request->message;
		$a->min=$request->min;
		$a->max=$request->max;
		$a->save();
		return redirect()->route('listAlerts')->withSuccess('Alert updated with Success');
	}

}
