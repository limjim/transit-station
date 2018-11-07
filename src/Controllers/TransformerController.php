<?php
namespace Megaads\TransitStation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Megaads\TransitStation\Controllers\Controller;
use SimpleXMLElement;

class TransformerController extends Controller {

    public function transferringRequest(Request $request) {
        ini_set('memory_limit', '1024M');
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
            $header = json_decode($header, true);
        }
        if( $request->input('debug') ) {
            return \Response::json([
                $header,$url
            ]);
        }

        if ($url) {
            try {
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                $returnResult = curl_exec($ch);
                curl_close($ch);

                libxml_use_internal_errors(true);
                $doc = simplexml_load_string($returnResult);
                if (!$doc) {
                    throw new \Exception($returnResult);
                }
                $xml = new SimpleXMLElement($returnResult);
                $result = [];
                if (isset($xml->activitydetailsreportrecord)) {
                    foreach ($xml->activitydetailsreportrecord as $value) {
                        $result[] = (array) $value;

                    }
                }
                $response['result'] = $result;
            } catch(\Exception $ex) {
                $response['message'] .= $ex->getMessage();
            }
        } else {
            $response['message'] .= ' Url is required.';
        }
        return \Response::json($response);

    }
}
