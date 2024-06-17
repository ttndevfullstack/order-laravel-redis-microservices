<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{

    public function store(Request $request)
    {
        $id = uuid_create();
        $request['id'] = $id;
        
        $redis = Redis::connection();
        $redis->set('product_'.$id, json_encode($request->all()));

        return response($request->all(), 201);
    }

    public function show(string $id)
    {   
        $redis = Redis::connection();
        $product = $redis->get('product_'.$id);

        return $product;
    }
}
