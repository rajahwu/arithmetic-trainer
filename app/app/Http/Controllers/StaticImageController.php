<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class StaticImageController extends Controller
{
    public function site_logo() {
        return Response::file('../resources/assets/images/site-logo.png');
    }
    public function site_title() {
        // return Response::file('../resources/assets/images/site-title.png');
        return Response::file('../resources/assets/images/title-logo-transparent/title.png');
    }
    
    public function home_background() {
        return Response::file('../resources/assets/images/title-logo-transparent/title.png');
    }
}
