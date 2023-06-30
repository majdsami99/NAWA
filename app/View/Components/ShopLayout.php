<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShopLayout extends Component
{
    public $title;
    public $showbreadcrump;
    /**
     * Create a new component instance.
     */
    public function __construct($title,$showbreadcrump=true)
    {
        $this->title=$title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.shop',[
            'title'=>$this->title,
        ]);
    }
}
