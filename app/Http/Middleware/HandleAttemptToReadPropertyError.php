<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HandleAttemptToReadPropertyError
{
    public function handle($request, Closure $next)
    {
        try {
            return $next($request);
        } catch (ModelNotFoundException $e) {
            // Tangkap exception ModelNotFoundException dan arahkan ke halaman utama
            return redirect('/');
        } catch (\ErrorException $e) {
            // Tangkap kesalahan yang terkait dengan properti 'name' dan arahkan ke halaman utama
            if ($e->getMessage() === "Attempt to read property 'name' on null") {
                return redirect('/');
            }

            throw $e;
        }
    }
}

