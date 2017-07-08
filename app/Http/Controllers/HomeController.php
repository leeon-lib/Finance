<?php

namespace App\Http\Controllers;

use Redirect;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {/*{{{*/
        parent::__construct();
    }/*}}}*/

    public function home()
    {/*{{{*/
        return Redirect::to('/dashboard');
    }/*}}}*/

    public function dashboard()
    {/*{{{*/
        return view('dashboard', $this->assign);
    }/*}}}*/
}
