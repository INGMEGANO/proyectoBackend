<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\User;
use App\Models\Manager;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
  
 

  public function associateToManager(Request $request){
  	$data = $request->only('employee_id','manager_id');
  	$validator = Validator::make($data, [
            'employee_id' => 'required|integer',
            'manager_id' => 'required|integer'
          ]);

  	 //if validator fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }
       $manager = Manager::where('user_id',$request->manager_id)->first();
       
        $employee= Employees::where("user_id",$request->employee_id)
             ->update([
                "manager_id" => $manager->id
             ]);
        return response()->json([
            'message' => 'Employee Associated',
            'data' => $employee
        ], Response::HTTP_OK);

  }

  public function getEmployees($id){
    $data = Manager::select('users.id','users.first_name','users.last_name','users.email','employees.emp_id',
'employees.name_prefix','employees.middle_initial','employees.gender','employees.father_name','employees.mother_name',
'employees.mother_maiden_name','employees.date_of_birth','employees.date_of_joining','employees.salary','employees.ssn','employees.phone',
'employees.city','employees.state','employees.zip')
                ->join('employees', 'managers.id', '=', 'employees.manager_id')
                ->join('users','employees.user_id','=','users.id')->where('managers.user_id','=',$id)->get();

         return response()->json([
            'message' => 'List of employees',
            'data' => $data
        ], Response::HTTP_OK);

  }

  public function getManagers()
    {

      //retrieve all employees
      $managers = User::role('manager')->orderBy('last_name', 'ASC')->get();
      if (!$managers) {
            return response()->json([
                'message' => 'Managers not found.'
            ], 404);
        }
        //Si hay producto lo devolvemos
        return $managers;
    }


}
