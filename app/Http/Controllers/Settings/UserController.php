<?php

namespace App\Http\Controllers\Settings;

use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {/*{{{*/
        parent::__construct();
    }/*}}}*/

    public function index()
    {/*{{{*/
        $this->assign['userList'] = User::get();
        return view('settings.users.list', $this->assign);
    }/*}}}*/
}
