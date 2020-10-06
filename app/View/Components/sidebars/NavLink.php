<?php

namespace App\View\Components\sidebars;

use Illuminate\View\Component;

class NavLink extends Component
{
    public $name;
    public $route;
    public $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $route, $icon)
    {
        $this->name = $name;
        $this->route = $route;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sidebars.nav-link');
    }
}
