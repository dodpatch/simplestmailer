<?php

namespace App\View\Components\sidebars;

use Illuminate\View\Component;

class Brand extends Component
{
    public $name;
    public $route;
    public $logolink;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $route, $logolink)
    {
        $this->name = $name;
        $this->route = $route;
        $this->logolink= $logolink;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sidebars.brand');
    }
}
