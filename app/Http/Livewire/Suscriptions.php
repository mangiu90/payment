<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Suscriptions extends Component
{
    public function render()
    {
        return view('livewire.suscriptions');
    }

    public function newSubscription($name, $price)
    {
        auth()->user()->newSubscription($name, $price)->create();
    }

    public function changingPlan($name, $price)
    {
        auth()->user()->subscription($name)->swap($price);
    }

    public function cancelingSubscription($name)
    {
        auth()->user()->subscription($name)->cancel();
    }

    public function resumingSubscription($name)
    {
        auth()->user()->subscription($name)->resume();
    }
}
