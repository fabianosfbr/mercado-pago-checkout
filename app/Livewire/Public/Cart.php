<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class Cart extends Component implements HasForms
{
    use InteractsWithForms;

    public $itens = [];

    public function mount()
    {
        $this->itens = [
            0 => [
                'title' => 'Throwback Hip',
                'category' => 'Bag',
                'color' => 'Salmon',
                'picture' => 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg',
                'price' => '32.00'
            ],
            1 => [
                'title' => 'Medium Stuff',
                'category' => 'Satchel',
                'color' => 'Blue',
                'picture' => 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-02.jpg',
                'price' => '90.00'
            ]
        ];
    }



    public function render()
    {

        return view('livewire.public.cart');
    }

    public function checkout(): void
    {
        $this->dispatchBrowserEvent('close-modal', ['id' => 'cart']);
        $this->dispatchBrowserEvent('open-modal', ['id' => 'checkout']);
    }

    //Método auxiliar que gerar float aleatório entre um intervalo

    private function random_float($min, $max)
    {
        return ($min + lcg_value() * (abs($max - $min)));
    }
}
