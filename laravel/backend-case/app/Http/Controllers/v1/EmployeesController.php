<?php
namespace App\Http\Controllers\V1;
use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\User;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class EmployeesController extends Controller
{
    protected $user;
    public function __construct(Request $request)
    {
        //Protecting the routes only some roles are permitted
        $this->middleware('can:view.employees.list')->only('show');
        $this->middleware('can:view.employees.information')->only('showDetailedInfo');
        $this->middleware('can:create.employees')->only('store');
        $this->middleware('can:update.employees')->only('update');
        $this->middleware('can:delete.employees')->only('destroy');
        

        $token = $request->header('Authorization');
        if($token != '')
           $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Listamos todos los productos
        return Product::get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validating data
        $data = $request->only('first_name', 'last_name', 'email','password','emp_id','name_prefix','middle_initial','gender','father_name','mother_name','date_of_birth','date_of_joining','salary','ssn','phone','city','state','zip','mother_maiden_name');
        $validator = Validator::make($data, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',

            'password' => 'required|string|min:6|max:50',
            'emp_id' => 'required|string',
            'name_prefix' => 'required|string',

            'middle_initial' => 'required|string',
            'gender' => 'required|string',
            'father_name' => 'required|string',

            'mother_name' => 'required|string',
            'date_of_birth' => 'required|string',
            'date_of_joining' => 'required|string',
            'mother_maiden_name'=>'required|string',

            'salary' => 'required|numeric',
            'ssn' => 'required|string',
            'phone' => 'required|string',

            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
        ]);
        //If validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }
        //Create the user in the DB
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
            ])->assignRole('employee');

            //Create the detailed information of the employee
            $user->employee()->create([
                'emp_id'=>$request->emp_id,
                'name_prefix'=>$request->name_prefix,
                'middle_initial'=>$request->middle_initial,
                'gender'=>$request->gender,
                'father_name'=>$request->father_name,
                'mother_name'=>$request->mother_name,
                'mother_maiden_name'=>$request->mother_maiden_name,
                'date_of_birth'=>$request->date_of_birth,
                'date_of_joining'=>$request->date_of_joining,
                'salary'=>$request->salary,
                'ssn'=>$request->ssn,
                'phone'=>$request->phone,
                'city'=>$request->city,
                'state'=>$request->state,
                'zip'=>$request->zip,
                ]);


        //Response in case everything is good.
        return response()->json([
            'message' => 'Employee Created',
            'data' => 'Ok'
        ], Response::HTTP_OK);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

      //retrieve all employees
      $employees = User::role('employee')->orderBy('last_name', 'ASC')->get();
      if (!$employees) {
            return response()->json([
                'message' => 'Empployees not found.'
            ], 404);
        }
        //Si hay producto lo devolvemos
        return $employees;
    }

    public function showDetailedInfo($id)
    {

      //retrieve all employees
      $employee = User::role('employee')->with('employee')->where('id','=',$id)->first();
      if (!$employee) {
            return response()->json([
                'message' => 'Empployees not found.'
            ], 404);
        }
        //Si hay producto lo devolvemos
        return $employee;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
              //Validating data
        $data = $request->only('first_name', 'last_name', 'email','password','emp_id','name_prefix','middle_initial','gender','father_name','mother_name','date_of_birth','date_of_joining','salary','ssn','phone','city','state','zip','mother_maiden_name');
        $validator = Validator::make($data, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|',Rule::unique('users')->ignore($id),

            
            'emp_id' => 'required|string',
            'name_prefix' => 'required|string',

            'middle_initial' => 'required|string',
            'gender' => 'required|string',
            'father_name' => 'required|string',

            'mother_name' => 'required|string',
            'date_of_birth' => 'required|string',
            'date_of_joining' => 'required|string',
            'mother_maiden_name'=>'required|string',

            'salary' => 'required|numeric',
            'ssn' => 'required|string',
            'phone' => 'required|string',

            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
        ]);
        //If validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }
        //Update the user in the DB
            //Search the user
        $user = User::findOrfail($id);
        //Update the user
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //Update the detailed information of the employee in the data base
         $user->employee()->update([
                'emp_id'=>$request->emp_id,
                'name_prefix'=>$request->name_prefix,
                'middle_initial'=>$request->middle_initial,
                'gender'=>$request->gender,
                'father_name'=>$request->father_name,
                'mother_name'=>$request->mother_name,
                'mother_maiden_name'=>$request->mother_maiden_name,
                'date_of_birth'=>$request->date_of_birth,
                'date_of_joining'=>$request->date_of_joining,
                'salary'=>$request->salary,
                'ssn'=>$request->ssn,
                'phone'=>$request->phone,
                'city'=>$request->city,
                'state'=>$request->state,
                'zip'=>$request->zip,
                ]);


        //Response in case everything is good.
        return response()->json([
            'message' => 'Employee Updated',
            'data' => 'Ok'
        ], Response::HTTP_OK);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Search The user
        $user = User::findOrfail($id);
        //Delete The user's role
        $user->removeRole('employee');
        //Delete the relationship
        $user->employee()->delete();
        //Delete the model
        $user->delete();
        //Return the response
        return response()->json([
            'message' => 'User deleted successfully.'
        ], Response::HTTP_OK);
    }
}