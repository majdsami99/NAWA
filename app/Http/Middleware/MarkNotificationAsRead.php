<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id =$request->query('nid');
        if($id && $request->user()){
            $notification=$request->user()->unreadNotifications()->find($id);
            if($notification){
                $notification->MarkAsRead();  /// فكرته بانه الاشعار يصير صفر بعد ما اقرا جميع النوتيفيشكين
            }
        }
        return $next($request);
    }
}
