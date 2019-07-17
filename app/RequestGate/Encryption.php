<?php
namespace App\RequestGate;



class Encryption
{
    public function encrypt(RequestTemplate $request)
    {

    }

    public function decrypt(RequestTemplate $request)
    {
        return decrypt($request->code);
    }
}
?>
