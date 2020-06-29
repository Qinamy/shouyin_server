<?php


namespace App\Http\Controllers\Services;


class SpService
{
    public static $all_param_names = ['barcode','cashier_id','goods','shop_id','user_id'];

    const property_translate = [
        'shop_id' => '店铺ID',
        'user_id' => '用户ID',
        'price' => '售价',
        'barcode' => '条码'
    ];

    public static function getParams($request,$necessary_param_names,$all_param_names = null)
    {
        return UtilService::getParams($request,$necessary_param_names,$all_param_names ?? self::$all_param_names,self::property_translate);
    }

    public static function getSps($filter)
    {
        $query = Sp;
    }
}