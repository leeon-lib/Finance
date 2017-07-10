<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Memu;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {/*{{{*/
        $this->middleware('auth');

        $this->assign = [
            'memuList' => Memu::getFormatMemuList(),
            'currentAdmin' => '超级管理员',
        ];
    }/*}}}*/

    protected function getRequestParams(array $inputKeys): array
    {/*{{{*/
        $arr = [];
        foreach ($inputKeys as $key => $value) {
            if (is_numeric($key)) {
                $key = $value;
                $default = null;
            } else {
                $key = $key;
                $default = $value;
            }

            $arr[$key] = Request::get($key, $default);
        }

        return $arr;
    }/*}}}*/

    public function getFormatMemuList()
    {/*{{{*/
        $arr = [];
        $baseMemuList = Memu::where('parent_id', 0)->get()->all();
        foreach ($baseMemuList as $memu) {
            $subMemuList = Memu::where('parent_id', $memu->id)->get()->toArray();
            $arr[] = ['base' => $memu->toArray(), 'items' => $subMemuList];
        }
        return $arr;
    }/*}}}*/
}
