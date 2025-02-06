<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontLayout extends Component
{
    public $titel ;
    /**
     * Create a new component instance.
     */
    public function __construct($titel =null)
    {
        $this->titel = $titel ?? config('app.name');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.LayoutFront.front');
    }
}
