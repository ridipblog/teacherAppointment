<?php

namespace App\View\Components\candidate\dataforms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CandidateBasicComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $candData = null;
    public function __construct($candData = null)
    {
        $this->candData = $candData;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.candidate.dataforms.candidate-basic-component');
    }
}
