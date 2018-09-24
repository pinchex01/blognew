<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __constract(){

        $this->middleware('auth');
    }


    public function index() {

        return view('posts.post');
    }
}
