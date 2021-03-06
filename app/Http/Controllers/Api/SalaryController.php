<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{
    public function Paid(Request $request, $id){
        $validateData = $request->validate([
            'salary_month' => 'required',
            ]);
        $month = $request->salary_month;
        $check = DB::table('salaries')->where('employee_id',$id)->where('salary_month', $month)->first();

        if($check){
            return response()->json('Salary Already Paid');
        } else {
            $data = array();
            $data['employee_id'] = $id;
            $data['amount'] = $request->salary;
            $data['salary_date'] = date('d/m/Y');
            $data['salary_month'] = $month;
            $data['salary_year'] = date('Y');
            DB::table('salaries')->insert($data);
        }
        
    }


    public function AllSalary(){
        $salary = DB::table('salaries')->select('salary_month')->groupby('salary_month')->get();
        return response()->json($salary);
        // $out = $this->buildHtmlList();
        return response()->json($salary);
    }

    public function ViewSalary($id){

        $month = $id;
        $salary_em = DB::table('salaries')
                    ->join('employees', 'employee_id', 'employees.id')
                    ->select('employees.name', 'salaries.*')
                    ->where('salaries.salary_month', $month)->get();
        return response()->json($salary_em);
    }

    
}
