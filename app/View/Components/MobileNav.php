<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class MobileNav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $events = Category::where(function ($query) {
            $query->where('type', 'event')->orWhere('type', 'both');
        })->orderBy('name', 'asc')->get();
        $services = Category::where(function ($query) {
            $query->where('type', 'service')->orWhere('type', 'both');
        })->orderBy('name', 'asc')->get();
        return view('components.mobile-nav', compact('events', 'services'));
    }
}
