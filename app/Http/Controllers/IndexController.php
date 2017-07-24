<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __construct()
    {/*{{{*/
    }/*}}}*/

    public function index()
    {/*{{{*/
        return view('welcome');
    }/*}}}*/
}

