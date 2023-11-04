<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SDWHController extends Controller
{
    public function pullData() {
        $users = User::pluck('name', 'id');
        return view('layouts.admin.sdwh.pull_data', compact('users'));
    }
    public function getData(Request $request) {
        $endpoint = "https://shainsights.in/api/audit/get-all-tms-data";
        $client = new \GuzzleHttp\Client(['verify' => false]);
        

        $response = $client->request('GET', $endpoint, ['query' => [
            'date_from'     => $request->date_from,
            'date_to'       => $request->date_to,
            'district_name' => $request->district,
            'hosp_type'     => $request->hosp_type,
        ]]);

        $statusCode = $response->getStatusCode();
        $content    = json_decode($response->getBody(), true);
        dd($content);
    }
}
