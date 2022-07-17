<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * list brands
     */
    public function list() {
        $array = ['error' => ''];

        if (!empty(Brands::all())) {
            $array['list'] = Brands::all();
        } else {
            $array['error'] = "Nenhuma marca cadastrada!";
        }

        return $array;
    }
}
