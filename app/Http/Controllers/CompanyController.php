<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Company;

class CompanyController extends Controller
{
    public static function index(){
        $paginate_companies = Company::paginate(10);

        return $paginate_companies;
    }
}
