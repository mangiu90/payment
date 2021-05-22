<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Laravel\Cashier\Exceptions\IncompletePayment;

class Subscriptions extends Component
{
    protected $listeners = ['render'];

    public function render()
    {
        return view('livewire.subscriptions');
    }

    public function newSubscription($name, $price)
    {
        try {

            auth()->user()->newSubscription($name, $price)->trialDays(7)->create();
            $this->emitTo('invoices', 'render');

        } catch (IncompletePayment $exception) {

            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('billing.index')]
            );
        }
    }

    public function changingPlan($name, $price)
    {
        auth()->user()->subscription($name)->swap($price);

        $this->emitTo('invoices', 'render');
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
