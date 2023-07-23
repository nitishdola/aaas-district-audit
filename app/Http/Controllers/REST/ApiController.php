<?php

namespace App\Http\Controllers\REST;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Hospital;
class ApiController extends Controller
{
    public function getDistrict(Request $request) {
        $hospital_id = $request->hospital_id;
        return Hospital::whereId($hospital_id)->with('district')->first();
    }
}
