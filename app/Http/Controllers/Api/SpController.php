<?php


namespace App\Http\Controllers\Api;

use App\Exceptions\JsonResultException;
use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Services\SpService;
use App\Models\Sp;
use App\Http\Controllers\BaseController;

class SpController extends BaseController
{
    public function sync(Request $request)
    {

        $params = SpService::getParams($request,['shop_id']);

        if(!empty($params['msg'])){
            JsonResultException::throwJsonResultException(300,$params['msg']);
        }

        Log::notice('@@'.PHP_EOL.PHP_EOL.json_encode($params));

        //todo user_id 是否有shop_id的权限

        $sps = Sp::where('shop_id',$request->input('shop_id'))->get();

        foreach ($sps as $item) {
            //传到前台的price以元为单位，保留两位有效数字，以适配数字键盘
            $item->rmb_sp /= 100;
        }

        return [
            'code' => 200,
            'result' => $sps
        ];
    }
}