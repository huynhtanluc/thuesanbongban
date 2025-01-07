<?php

namespace App\Http\Controllers;

use App\Models\ChuSan;
use App\Models\SanBong;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $list = ChuSan::all();
        foreach ($list as $key => $value) {
            SanBong::where("id", $value->id_san)->update(["id_chu_san" => $value->id]);
        }
        dd($list->toArray());
    }
}
