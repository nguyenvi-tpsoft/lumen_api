<?php

namespace App\Http\Controllers;

class hosonhanvienController extends Controller
{
    public function list()
    {
        return app('db')->connection()->select("SELECT * FROM hosonhanvien limit 10");
    }
    public function detail($msdn)
    {
        return app('db')->connection('mysql2')->select("SELECT * FROM hosonhanvien where dienthoai = '$msdn'");
    }
}
