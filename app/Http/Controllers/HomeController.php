<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {/*{{{*/
        parent::__construct();
    }/*}}}*/

    public function home()
    {/*{{{*/
        return redirect('dashboard');
    }/*}}}*/

    public function dashboard()
    {/*{{{*/
        return view('dashboard', $this->assign);
    }/*}}}*/
}
