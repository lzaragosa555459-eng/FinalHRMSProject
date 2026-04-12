<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
   public function dashboard(){
    $user = Auth::user();

    return view('employee.dashboard', compact('user'));
   }
}
