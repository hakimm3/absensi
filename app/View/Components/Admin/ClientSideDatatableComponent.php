<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClientSideDatatableComponent extends Component
{
    /**
     * Create a new component instance.
     */
    protected $id;
    protected $title;
    public function __construct($id, $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.client-side-datatable-component', [
            'id' => $this->id,
            'title' => $this->title,
        ]);
    }
}
