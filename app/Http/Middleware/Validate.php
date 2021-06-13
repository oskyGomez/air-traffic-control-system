<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Validator;
use Closure;

class Validate
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|in:emergency,vip,passenger,cargo',
            'size' => 'required|string|in:small,large'
        ]);

        if($validator->fails()) {
            return $validator->errors();
        }
    }
}
