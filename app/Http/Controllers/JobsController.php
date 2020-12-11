<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobs;
use App\Models\User;
class JobsController extends Controller
{
	public function getJobs()
	{
		$jobs = Jobs::with('employees')->get();
		return response()->json(['jobs'=>$jobs]);
	}
	public function getcounters()
	{
		$jobs = Jobs::count();
		$employee = User::where('user_type', 'employee')->count();
		$sub = User::where('user_type', 'subadmins')->count();
		return response()->json(['jobs'=>$jobs, 'employee'=>$employee, 'sub'=>$sub]);
	}
	public function delJob(Request $request)
	{
		$jobs = Jobs::find($request->id);
		$jobs->delete();
		return response()->json(['status'=>true]);
	}
	public function createJobs(Request $request)
	{
		$jobs = new Jobs;
		$jobs->title = $request->title;
		$jobs->description = $request->description;
		$jobs->date = $request->date;
		$jobs->time = $request->time;
		$jobs->client_name = $request->clientName;
		$jobs->client_address = $request->clientAddress;
		$jobs->client_phone = $request->clientPhone;
		$jobs->form_type = $request->formType;
		$jobs->notes = $request->notes;
		$jobs->employee_id = $request->employee;
		$jobs->user_id = $request->user;

		if($request->hasFile('file')) {
	        $getfileName = time().'.'.$request->file->getClientOriginalExtension();
	        $filepath = $request->file->move(storage_path('files'), $getfileName); 
	        $file = 'storage/files/'.$getfileName;
	        $jobs->form_link = $file;
	    }

	    $jobs->save();
	    return response()->json(['Error'=>false,'msg'=>'Job is Created Successfully..']); 
	}
	public function getJobsById($id)
	{
		$jobs = Jobs::with('employees')->find($id);
	    return response()->json(['Error'=>false, 'jobs' => $jobs]); 
	}
	public function updateJob(Request $request, $id)
	{
		$jobs = Jobs::find($id);

		$jobs->title = $request->title;
		$jobs->description = $request->description;
		$jobs->date = $request->date;
		$jobs->time = $request->time;
		$jobs->client_name = $request->clientName;
		$jobs->client_address = $request->clientAddress;
		$jobs->client_phone = $request->clientPhone;
		$jobs->form_type = $request->formType;
		$jobs->notes = $request->notes;
		$jobs->employee_id = $request->employee;
		$jobs->user_id = $request->user;

		if($request->hasFile('file')) {
	        $getfileName = time().'.'.$request->file->getClientOriginalExtension();
	        $filepath = $request->file->move(storage_path('files'), $getfileName); 
	        $file = 'storage/files/'.$getfileName;
	        $jobs->form_link = $file;
	    }

	    $jobs->save();
	    return response()->json(['Error'=>false,'msg'=>'Update is Successfully..']); 
	}
}
