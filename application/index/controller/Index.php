<?php

namespace app\index\controller;

use fast\Http;
use app\common\controller\Frontend;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {
        if($carNumber = $this->request->request('carNumber')){
            $url = 'https://ife.etcp.cn/api/v2/parking/get-park-fee?';
            $params = [
                'version'=>'5.5.0',
                'paySource'=>'34',
                'payWay'=>'2',
                'payFrom'=>'58',
                'privacyStatus'=>'1',
            ];
            $url .= http_build_query($params) . '&carNumber=' . $carNumber;
            $result = Http::get($url, $params, 'GET');
            $res = json_decode($result,true);

            if($res['code'] == 2){
                $this->success(__($res['message']), '',$res['data']);
            }else{
                $this->error(__('查询失败'));
            }
        }

        return $this->view->fetch();
    }

}
