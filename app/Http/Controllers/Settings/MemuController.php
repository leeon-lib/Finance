<?php

namespace App\Http\Controllers\Settings;

use Validator;
use App\Models\Memu;
use Request, Response, Redirect;
use App\Http\Controllers\Controller;

class MemuController extends Controller
{
    public function __construct()
    {/*{{{*/
         parent::__construct();
    }/*}}}*/

    public function index()
    {/*{{{*/
        $this->assign['baseMemuList'] = Memu::getBaseMemuList();

        return view('settings.memus.list', $this->assign);
    }/*}}}*/

    public function showAdd()
    {/*{{{*/
        $this->assign['baseMemuList'] = Memu::getBaseMemuList();

        return view('settings.memus.add', $this->assign);
    }/*}}}*/

    public function add()
    {/*{{{*/
        $columns = ['name' => 'aa', 'parent_id', 'flag', 'url', 'icon'];
        $params = $this->getRequestParams($columns);
        if (($validator = $this->validator($params))->fails()) {
            dd($validator->errors()->all());
        }

        $memu = (new Memu)->create($params);
        return Redirect::to('/settings/memus');
    }/*}}}*/

    private function validator(array $params)
    {/*{{{*/
        return Validator::make($params, [
            'name' => 'required|max:5|min:2',
            'parent_id' => 'required',
            'flag' => 'required|max:32|min:5',
            // 'url' => 'required|max:255|min:5',
        ]);
    }/*}}}*/
}
