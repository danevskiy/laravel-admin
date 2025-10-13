<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
     public static function index(){
        $paginate_employee = Employee::paginate(10);
        return $paginate_employee;
    }
}
