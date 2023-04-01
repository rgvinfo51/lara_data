<?php


namespace App\Http\Middleware;


use Closure;


class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*  $response = $next($request);
        return $next($request); 
         $response = $next($request); */
       /*  $response = $next($request);
        return $next($request); */
         /* return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
             ->header('Pragma','no-cache')
             ->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT'); */
             
            /*  return $next($request)->withHeaders([
            "Pragma" => "no-cache",
            "Expires" => "Fri, 01 Jan 1990 00:00:00 GMT",
            "Cache-Control" => "no-cache, must-revalidate, no-store, max-age=0, private",
        ]); */
           /*  "Pragma" => "no-cache",
            "Expires" => "Fri, 01 Jan 1990 00:00:00 GMT",
            "Cache-Control" => "no-cache, must-revalidate, no-store, max-age=0, private", */

        $response = $next($request);
        $response->headers->set('Pragma' , 'no-cache');
        $response->headers->set('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
        $response->headers->set('Cache-Control', 'no-cache, must-revalidate, no-store, max-age=0, private');
        return $response;
        
    }
}