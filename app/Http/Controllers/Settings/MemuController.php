<?php

namespace App\Http\Controllers\Settings;

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
        return view('settings.memus.list', $this->assign);
    }/*}}}*/

    public function showAdd()
    {/*{{{*/
        $this->assign['memuLevelMap'] = ['second' => '设置'];
        return view('settings.memus.add', $this->assign);
    }/*}}}*/
}
