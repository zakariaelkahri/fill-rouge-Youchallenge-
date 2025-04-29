<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganisatorController extends Controller
{
    public function home()
    {
        return view('organisator.home');
    }


}
