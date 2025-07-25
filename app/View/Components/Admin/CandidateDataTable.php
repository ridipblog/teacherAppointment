<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CandidateDataTable extends Component
{
    /**
     * Create a new component instance.
     */
    public $dataBase = null;
    public function __construct($dataBase = null)
    {
        $this->dataBase = $dataBase;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.candidate-data-table');
    }
}
