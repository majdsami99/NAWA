<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Notification extends Component
{
    /**
     * Create a new component instance.
     */
    public $notification;
    public $unread ;
    public function __construct()
    {
        $user =Auth::user();
        $this->notification =$user->Notifications()->limit(5)->get(); //readnotifications relation
        $this->unread=$user->unreadnotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.notification');
    }
}
