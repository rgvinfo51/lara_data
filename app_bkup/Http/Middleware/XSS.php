<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class XSS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();
        array_walk_recursive($input, function(&$input) {
          
		    $input = str_replace('<?php', '', $input);
		    $input = str_replace('script', '', $input);
            $input = str_replace('alert', '', $input);
            $input = str_replace('prompt', '', $input);
            $input = str_replace('onmouseover', '', $input);
            $input = str_replace('<', '', $input);
            $input = str_replace('>', '', $input);
            $input = str_replace('&', '', $input);
            $input = str_replace('=', '', $input);
            $input = str_replace('onmouseovEr', '', $input);
            $input = str_replace('javascript', '', $input);
			$pattern = "/(<!--\[if gte mso 9\]>)(.*)(<!--StartFragment-->)/is";
            $input =preg_replace($pattern, " ", $input); 
			
        });
     //dd($input);
        $request->merge($input);
        return $next($request);
    }
}
