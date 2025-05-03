<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StreakDisplay extends Component
{
    public $type;
    public $streak;
    public $days;
    /**
     * Create a new component instance.
     */
    public function __construct($type, $streak, $days = [])
    {
        $this->type = $type;
        $this->streak = $streak;
        $this->days = $days;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.streak-display');
    }
}
