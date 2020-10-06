<?php

namespace App\View\Components\sidebars;

use Illuminate\View\Component;

class folder extends Component
{
    public $name;
    public $icon;
    public $badge;
    public $isactive;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $icon, $badge = '', $isactive = false)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->badge = $badge;
        $this->isactive = $isactive;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sidebars.folder');
    }
}
