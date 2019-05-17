<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\SnowFlake;
use App\Exceptions\ApiHandler as UsException;
use App\Models\Logic\GroupModel;

class TestController extends Controller
{
    /**
     * 测试控制器方法
     */
    public function index(Request $request)
    {
        echo '我是一个Test方法！';
        // 使用命名路由功能，展示当前路由
        // echo route('index1_route');
    }

    /**
     * 通用的测试方法
     * @throws UsException
     */
    public function general(Request $request)
    {
//        throw new UsException('hahhahhhaha66666666666',200);
        $model = new GroupModel();
//        $model->setTable('sys_groups_201906');
        echo $model->getTable();die;
        $model->getGroupList();
//        $model->searchGroupById(1);
    }

    /**
     * @throws \Exception
     */
    public function snowflake()
    {
        $snow = new SnowFlake('1000');
        for ($i=0; $i<500; $i++){
            $snow_id = $snow->createId();
            echo $snow_id .  '<br>';
        }
    }
}
