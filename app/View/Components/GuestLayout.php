<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Crée une nouvelle instance du composant.
     */
    public function __construct()
    {
        //
    }

    /**
     * Retourne la vue du composant.
     */
    public function render(): View
    {
        return view('components.guest-layout');
    }
}