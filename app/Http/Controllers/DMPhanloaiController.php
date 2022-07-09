<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DMPhanloaiController extends Controller
{

    public function list()
    {
        return app('db')->connection('mysql')->select("SELECT * FROM dmphanloai");
    }
    public function list_phanloai(Request $request)
    {
        $phanloai = $request->input('phanloai');
        return app('db')->connection('mysql')->select("SELECT * FROM dmphanloai where phanloai = '$phanloai'");
    }
    public function store(Request $request)
    {

        // image upload
        if ($request->hasFile('photo')) {

            $allowedfileExtension = ['pdf', 'jpg', 'png'];
            $file = $request->file('photo');
            $extenstion = $file->getClientOriginalExtension();
            $check = in_array($extenstion, $allowedfileExtension);

            if ($check) {
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
            }
        }
    }
}
