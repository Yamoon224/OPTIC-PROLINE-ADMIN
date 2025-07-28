<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $id;
    public $name;
    public $type;
    public $value;
    public $placeholder;
    public $required;
    public $class;

    /**
     * Create a new component instance.
     *
     * @param string $id
     * @param string $name
     * @param string $type
     * @param mixed $value
     * @param string|null $placeholder
     * @param bool $required
     * @param string|null $class
     * 
     * @return void
     */
    public function __construct(
        $id,
        $name,
        $type = 'text',
        $value = null,
        $placeholder = null,
        $required = false,
        $class = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.form.input');
    }
}
