<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {/*{{{*/
         
    }/*}}}*/

    public function home()
    {/*{{{*/
        return $this->showDashboard();
    }/*}}}*/

    public function dashboard()
    {/*{{{*/
        return view('dashboard');
    }/*}}}*/
}
