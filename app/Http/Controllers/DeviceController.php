<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Device;
use Source;

class DeviceController extends BaseController
{

    public function goPage($address)
    {
        $config = config('Controller.Device.' . $address, null);

        if (empty($config)) {
            abort(404);
        }
//        $permissions = explode('.',$config['permission']);
//        $this->authPermission($permissions);

        $request = $this->getRequestValue();
        if (!empty($config['method']) && !$request->isMethod($config['method'])) {
            abort(403);
        }

        $view =  $config['view'];
        $page = 'page' . $config['page'];
        $this->setTemplates($view);

        $request = $this->getRequestValue();
        $this->$page($request);
    }

    public function pageIndexView(){

        Log::notice('@@'.PHP_EOL.PHP_EOL.'indexview');
        $array_response = array(
        );
        $this->setResponseValue($array_response);
    }

    public function pageIndex(Request $request)
    {
        Log::notice('@@'.PHP_EOL.PHP_EOL.'index'.$request->input('mobile'));
//        $devices = Device::where('mobile',$request->input('mobile'))->get();
//        $devices = DataSourceRepository::get('device')->index([
        $devices = Source::get('device')->index([
            'mobile' => $request->input('mobile'),
            'dev_id' => $request->input('dev_id'),
        ],100);
        $array_response = array(
            'list' => $devices
        );
        $this->setResponseValue($array_response);
    }

}