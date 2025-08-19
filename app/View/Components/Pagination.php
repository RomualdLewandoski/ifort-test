<?php

namespace App\View\Components;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\Component;

class Pagination extends Component
{
    public Paginator $paginator;

    public function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    public function render()
    {
        return view('partials.pagination');
    }
}
