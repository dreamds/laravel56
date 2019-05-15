<?php
/**
 * Created by PhpStorm.
 * User: Dreamma
 * Date: 2019/5/14
 * Time: 17:53
 */

namespace App\Models\Logic;

use App\Models\Dao\Group;

class GroupModel extends BasicModel
{
    public function getGroupList()
    {
        $data = Group::query()->get()->toArray();
        dd($data);
    }

    public function searchGroupById($id)
    {
        $data = Group::query()->where('id','=',$id)->first();
        $this->firstToArray($data);
        dd($data);
    }
}