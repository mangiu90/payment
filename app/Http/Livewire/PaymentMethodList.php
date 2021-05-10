<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PaymentMethodList extends Component
{
    public function render()
    {
        $paymentMethods = auth()->user()->paymentMethods();

        return view('livewire.payment-method-list', compact('paymentMethods'));
    }
}
