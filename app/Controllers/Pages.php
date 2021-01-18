<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'home | WebProgrammingUNPAS',
            'tes' => ['satu', 'dua', 'tiga']
        ];
        echo view('layout/header', $data);
        echo view('Pages/home');
        echo view('layout/footer');
    }

    public function about()
    {
        $data = [
            'title' => 'About Me'
        ];
        echo view('layout/header', $data);
        echo view('Pages/about');
        echo view('layout/footer');
    }

    //--------------------------------------------------------------------

}
