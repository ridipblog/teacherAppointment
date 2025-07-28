<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AllUserTableComponent extends Component
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
        return view('components.admin.all-user-table-component');
    }
}
