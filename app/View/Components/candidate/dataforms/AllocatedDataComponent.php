<?php

namespace App\View\Components\candidate\dataforms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AllocatedDataComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $allocatedData = null;
    public function __construct($allocatedData = null)
    {
        $this->allocatedData = $allocatedData;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.candidate.dataforms.allocated-data-component');
    }
}
