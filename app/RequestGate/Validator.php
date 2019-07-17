<?php
namespace App\RequestGate;

use Illuminate\Http\Request;
use App\RequestGate\RequestTemplate;

class Validator
{
    public $is_json = false ;
    public $is_true_request = false;

    public function __construct (RequestTemplate $request, Encryption $enc)
    {
        $decrypted = $enc->decrypt($request);

        $this->isJson($decrypted);
        $this->IsTrueRequest($decrypted);
    }

    private function isJson(String $content):void
    {

        $json_decode = json_decode($content);
        if (json_last_error() === 0) {
            $this->is_json = true;
        }else{
            $this->is_json = false;
        }
    }

    private function IsTrueRequest(String $content):void
    {
        $json_decode = json_decode($content, true);
        if ($this->is_json && isset($json_decode['code'])) {
            $this->is_true_request = true;
        }else{
            $this->is_true_request = false;
        }

    }
}



 ?>
