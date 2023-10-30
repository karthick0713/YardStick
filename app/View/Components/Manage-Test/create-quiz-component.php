<?php

namespace App\View\Components\Manage-Test;

use Illuminate\View\Component;

class create-quiz-component extends Component
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
        return view('components.manage--test.create-quiz-component');
    }
}
