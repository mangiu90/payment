<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Laravel\Cashier\Exceptions\IncompletePayment;

class Subscriptions extends Component
{
    public $price;
    public $name = 'Curso pasarela de pagos';
    public $coupon;

    protected $listeners = ['render'];

    public function mount($price)
    {
        $this->price = $price;
    }

    public function render()
    {
        return view('livewire.subscriptions');
    }

    public function newSubscription()
    {
        try {

            if ($this->coupon) {
                auth()->user()->newSubscription($this->name, $this->price)
                    ->withCoupon($this->coupon)
                    ->trialDays(7)
                    ->create();
            } else {
                auth()->user()->newSubscription($this->name, $this->price)
                    ->withCoupon($this->coupon)
                    ->trialDays(7)
                    ->create();
            }

            $this->emitTo('invoices', 'render');
            $this->emitTo('subscriptions', 'render');

        } catch (IncompletePayment $exception) {

            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('billing.index')]
            );
        }
    }

    public function changingPlan()
    {
        auth()->user()->subscription($this->name)->swap($this->price);

        $this->emitTo('invoices', 'render');
        $this->emitTo('subscriptions', 'render');
    }

    public function cancelingSubscription()
    {
        auth()->user()->subscription($this->name)->cancel();

        $this->emitTo('subscriptions', 'render');
    }

    public function resumingSubscription()
    {
        auth()->user()->subscription($this->name)->resume();

        $this->emitTo('subscriptions', 'render');
    }
}
