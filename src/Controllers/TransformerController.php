<?php
namespace Megaads\TransitStation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Megaads\TransitStation\Controllers\Controller;

class TransformerController extends Controller {

    public function sendRequest(Request $request) {
        header('Content-Type: application/json');
        $url = $request->has('url') ? $request->input('url') : '';
        $header = $request->has('header') ? $request->input('header') : '';
        $result = [];
        if($url) {
            $ch = curl_init();
            $timeout = 30;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            if($header){
                curl_setopt($ch, CURLOPT_HTTPHEADER, [$header]);
            }
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $result = curl_exec($ch);
            curl_close($ch);

        }
        $data = [
            'status' => 'successful',
            'result' => $result,
        ];
        return response()->json($data);
    }
}
