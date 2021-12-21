<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Manager;
use App\Models\Assignments;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AssignmentsController extends Controller
{
   public function __construct(Request $request)
    {
        //Protecting the routes only some roles are permitted
        $this->middleware('can:submit.hours')->only('store');
        $this->middleware('can:view.hours.submitted')->only('getHoursSubmitted');
    }
  
  public function store(Request $request){
 	$data = $request->only('worked_hours','detail');
  	$validator = Validator::make($data, [
            'worked_hours' => 'required|integer',
            'detail' => 'required|string'
          ]);

  	 //if validator fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

      //Get the current logged user
      $user = Auth::user();
      //Create assignments for the user
      $user->assignments()->create([
          'worked_hours'=>$request->worked_hours,
          'detail'=>$request->detail 
      ]);

      return response()->json([
        'message' => 'Tasks Sucessfullysubmitted.',
        'data' => 'ok'
       ], Response::HTTP_OK);
   }
   //List worked hours
   public function getHoursSubmitted($id){
      //Get the current logged user
      $userAssignments = Assignments::with(['user'])->where('user_id',$id)->get();
      return response()->json([
        'message' => 'List of worked hours.',
        'data' => $userAssignments
       ], Response::HTTP_OK); 
  }   
}

