<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServerSideDatatableComponent extends Component
{
    /**
     * Create a new component instance.
     */
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.server-side-datatable-component', ['id' => $this->id]);
    }
}
