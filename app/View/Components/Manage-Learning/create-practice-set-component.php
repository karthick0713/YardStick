<?php

namespace App\View\Components\Manage-Learning;

use Illuminate\View\Component;

class create-practice-set-component extends Component
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
        return view('components.manage--learning.create-practice-set-component');
    }
}
