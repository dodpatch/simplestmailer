<?php

namespace App\View\Components\sidebars;

use Illuminate\View\Component;

class User extends Component
{
   public $name;
   public $imageLink;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $imageLink)
    {
        $this->name = $name;
        $this->imageLink = $imageLink;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sidebars.user');
    }
}
