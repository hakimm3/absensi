<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalComponent extends Component
{
    /**
     * Create a new component instance.
     */
    protected $id;
    protected $size;
    public function __construct($id, $size = '')
    {
        $this->id = $id;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.modal-component', [
            'id' => $this->id,
            'size' => $this->size,
        ]);
    }
}
