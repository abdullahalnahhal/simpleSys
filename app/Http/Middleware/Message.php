<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\RequestGate\Validator;
use App\RequestGate\Encryption;
use App\RequestGate\RequestTemplate;

use \App;
class Message
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $content = $request->getContent();

        $rquest_template = new RequestTemplate;
        $rquest_template->code = $content;
        $enc = new Encryption;
        $validator = new Validator($rquest_template,$enc);
        dd($validator);
        if ($validator->is_json && $validator->is_true_request) {
            $original = $enc->decrypt($rquest_template);
            $real_request = json_decode($original, true);
            $request->merge($real_request);
            return $next($request);
        }
    }
}
