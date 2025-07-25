<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReportTableComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $dataHeader = null;
    public $dataBase = null;
    public function __construct($dataHeader = null, $dataBase = null)
    {
        $this->dataHeader = $dataHeader;
        $this->dataBase = $dataBase;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.report-table-component');
    }
}
