<?php

// app/View/Components/Header.php
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Carrito;

class Header extends Component
{
    public $cartQuantity;

    public function __construct()
    {
        $this->cartQuantity = 0;

        if (Auth::check()) {
            $this->cartQuantity = Carrito::where('user_id', Auth::id())->count();
        } else {
            $carrito = session()->get('carrito', []);
            $this->cartQuantity = count($carrito);
            
        }
    }

    public function render()
    {
        return view('components.header');
    }
}
