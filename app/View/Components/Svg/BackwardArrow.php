<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class BackwardArrow extends Component
{
    protected ?string $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class = null)
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $class = $this->class ? "class='$this->class'" : '';

        return <<<blade
            <svg $class> <path d="M18.271,9.212H3.615l4.184-4.184c0.306-0.306,0.306-0.801,0-1.107c-0.306-0.306-0.801-0.306-1.107,0 L1.21,9.403C1.194,9.417,1.174,9.421,1.158,9.437c-0.181,0.181-0.242,0.425-0.209,0.66c0.005,0.038,0.012,0.071,0.022,0.109 c0.028,0.098,0.075,0.188,0.142,0.271c0.021,0.026,0.021,0.061,0.045,0.085c0.015,0.016,0.034,0.02,0.05,0.033l5.484,5.483 c0.306,0.307,0.801,0.307,1.107,0c0.306-0.305,0.306-0.801,0-1.105l-4.184-4.185h14.656c0.436,0,0.788-0.353,0.788-0.788 S18.707,9.212,18.271,9.212z"></path> </svg>
        blade;
    }
}
