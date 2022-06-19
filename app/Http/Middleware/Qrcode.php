<?php

namespace App\Http\Middleware;

use App\Models\Meja;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Qrcode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = (Session::has('token')) ? Session::get('token') : null;
        $query = Meja::select(['id', 'nama'])->where('qrcode', $token);
        if ($query->count() == 1) {
            Session::put('meja', $query->first());
            return $next($request);
        }
        return redirect()->to('/home/scan');
    }
}
