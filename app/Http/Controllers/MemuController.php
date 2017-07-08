<?php

namespace App\Http\Controllers;

use Redirect;
use App\Http\Controllers\Controller;

class MemuController extends Controller
{
    public function __construct()
    {/*{{{*/
         parent::__construct();
    }/*}}}*/

    public function index()
    {/*{{{*/
        return view('welcome', $this->assign);
    }/*}}}*/
}
