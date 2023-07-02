<?php

namespace App\View\Components;

use App\Models\product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class trendingproducts extends Component
{
    public $products;
    /**
     * Create a new component instance.
     */
    public $title;
    public function __construct($title='trending Products',$count=8)
    {
        $this->title=$title;
        $this->products=product::withoutGlobalScope('owner')
        ->with('category') //eager load تنفيذ جملتين الاستعلام وجملة استرجاع ال10 جمل
        ->active()->latest('updated_at')
        ->take($count) ///limit(8)
        ->get();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.trendingproducts');
    }
}
