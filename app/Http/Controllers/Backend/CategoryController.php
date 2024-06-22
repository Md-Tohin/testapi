<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    //  index
    public function index(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer 3|n6j9vfaw5bC2gx37JAUFAqhOzbyTm0zuO3uWV9UW',
        ])->get('http://testapi.test/api/categories');
        return $response;
    }
}
