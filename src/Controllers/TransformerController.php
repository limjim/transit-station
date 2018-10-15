<?php
namespace Megaads\TransitStation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Megaads\TransitStation\Controllers\Controller;

class TransformerController extends Controller {

    public function transferringRequest(Request $request) {
        $response = [
            'status' => 'fail',
            'message' => 'Request failed.'
        ];
        header('Content-Type: application/json');
        $url = $request->has('url') ? $request->input('url') : '';
        $header = $request->has('header') ? $request->input('header') : '';
        $method = $request->has('method') ? $request->input('method') : 'GET';
        $param = $request->has('param') ? $request->input('param'): '';
        if ($param && !is_array($param)) {
            $param = json_decode($param);
            $param = http_build_query($param);
        }
        if ($header && !is_array($header)) {
            $header = json_decode($header);
        }
        if ($url) {
            try {
                $ch = curl_init();
                $timeout = 30;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                if ($method == 'POST' || $method == 'post') {
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                }
                if($header){
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                }
                if ($param) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
                }
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $result = curl_exec($ch);
                curl_close($ch);
                return $result;
            } catch(\Exception $ex) {
                $response['message'] .= $ex->getMessage();
                return response()->json($response);
            }

        } else {
            $response['message'] .= ' Url is required.';
            return response()->json($response);
        }

    }
}
