<?php

namespace App\Http\Controllers;

class HosonhanvienController extends Controller
{
    public function list()
    {
        return app('db')->connection('mysql')->select("SELECT * FROM hosonhanvien limit 10");
    }
    public function detail($msdn)
    {
        return app('db')->connection('mysql2')->select("SELECT * FROM hosonhanvien where dienthoai = '$msdn'");
    }
}
