<?php

namespace App\Views;

use App\Requests\Request;

interface ViewComponent
{
    public function render(Request $request): void;
}