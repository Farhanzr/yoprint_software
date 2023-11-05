<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Upload\UploadCSV;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function index()
    {
        $data = UploadCSV::paginate(20);

        return view('Dashboard.home', compact('data'));
    }
}
