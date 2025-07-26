<?php

namespace App\View\Components\candidate\dataforms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AllocatedSchoolComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $allocateSchool = null;
    public function __construct($allocateSchool = null)
    {
        $this->allocateSchool = $allocateSchool;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.candidate.dataforms.allocated-school-component');
    }
}
