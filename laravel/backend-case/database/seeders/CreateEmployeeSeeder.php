<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employees;
use Illuminate\Support\Facades\DB;

class CreateEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //disable foreign keys
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //truncating tables user and employees
        User::truncate();
        Employees::truncate();
        //enable foreing keys
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $filename = 'employee_data.csv';
        //opening the file in order to access the employees' info
        $fp = fopen($filename, "r");//open the buffer reader
        $line = utf8_decode(fgets($fp)); //accessing the header's file information
        while (!feof($fp)) {//abre fp
            $line = utf8_decode(fgets($fp));
            $vector=explode(",", $line);
            $first_name=$vector[2];
            $last_name=$vector[4];
            $email=$vector[6];

            $user = User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => bcrypt('123456')
        	])->assignRole('employee');

            $user->employee()->create([
                'emp_id'=>$vector[0],
		        'name_prefix'=>$vector[1],
		        'middle_initial'=>$vector[3],
		        'gender'=>$vector[5],
		        'father_name'=>$vector[7],
		        'mother_name'=>$vector[8],
		        'mother_maiden_name'=>$vector[9],
		        'date_of_birth'=>$vector[10],
		        'date_of_joining'=>$vector[11],
		        'salary'=>$vector[12],
		        'ssn'=>$vector[13],
		        'phone'=>$vector[14],
		        'city'=>$vector[15],
		        'state'=>$vector[16],
		        'zip'=>$vector[17],
		        ]);
        }
        fclose($fp);//close the buffer reader
    }
}
