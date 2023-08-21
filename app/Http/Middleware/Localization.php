<?php

namespace App\Http\Middleware;

use Closure;
use App;
use DB; 
use Schema;


class Localization
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

         try {
            DB::connection()->getPdo();

                if(Schema::hasTable('settings')){
                   App::setLocale(App\Setting::get_option('language'));
                }
                    
        } catch (\Exception $e) {
            //die("Could not connect to the database. Please check your configuration. error:" . $e );
        }
           
        

        return $next($request);
    }
}
