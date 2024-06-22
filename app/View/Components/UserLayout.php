<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public $backgroundColor;

    public function __construct($backgroundColor = null)
    {
        $this->backgroundColor = $backgroundColor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.user-layout', [
            'backgroundColor' => $this->backgroundColor,
        ]);
    }
}
