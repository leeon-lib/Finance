<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Memu extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    private static $defaultMemus = [
        /*{{{*/
        'base' => array(
            'name' => '设置', 'icon' => 'fa fa-th-large',
        ),
        'items' => array(
            array('url' => '/settings/memus', 'name' => '功能菜单', 'icon' => 'fa fa-caret-right'),
        ),
    ];/*}}}*/

    /**
     * 获取基础模块菜单.
     *
     * @return  collection
     */
    public static function getBaseMemuList()
    {/*{{{*/
        return self::baseMemu()->get();
    }/*}}}*/

    /**
     * 获取某一模块下的所有子菜单项.
     *
     * @return  collection
     */
    public static function getSubMemuList(Memu $memu)
    {/*{{{*/
        if ($memu->parent_id) {
            return [];
        } else {
            return self::withPartnerId($memu->id)->get();
        }
    }/*}}}*/

    public static function getFormatMemuList()
    {/*{{{*/
        $arr = [];
        foreach (self::getBaseMemuList()->all() as $memu) {
            $subMemuList = self::getSubMemuList($memu)->toArray();
            if ($memu->name == self::$defaultMemus['base']['name']) {
                foreach ($subMemuList as $subMemu) {
                    array_push(self::$defaultMemus['items'], $subMemu);
                }
                continue;
            }
            $arr[] = ['base' => $memu->toArray(), 'items' => $subMemuList];
        }
        array_push($arr, self::$defaultMemus);

        return $arr;
    }/*}}}*/

    /** ============== scope ============== */

    public function scopeBaseMemu($query)
    {/*{{{*/
        return $query->where('parent_id', 0);
    }/*}}}*/

    public function scopeWithPartnerId($query, $memuId)
    {/*{{{*/
        return $query->where('parent_id', $memuId);
    }/*}}}*/
}
