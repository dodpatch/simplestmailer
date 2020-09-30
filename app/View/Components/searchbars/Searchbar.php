<?php

namespace App\View\Components\searchbars;

use Illuminate\View\Component;

class Searchbar extends Component
{
   
    public $action = 'POST';
    public $route ;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($method, $action)
    {
        $this->method = $method;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.searchbars.searchbar');
    }
}
