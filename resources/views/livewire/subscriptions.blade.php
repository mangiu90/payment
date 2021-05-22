<div class="w-full">
    @if (auth()->user()->hasDefaultPaymentMethod())
        @if (auth()->user()->subscribed($name))
            @if (auth()->user()->subscribedToPlan($price, $name))
                @if (auth()->user()->subscription($name)->onGracePeriod())
                <button id="reanudar" wire:click="resumingSubscription"
                    wire:loading.attr="disabled"
                    wire:target="resumingSubscription"
                    class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full">
                    <x-spinner wire:loading  wire:target="resumingSubscription" size="6" class="mr-2 inline-block align-middle"></x-spinner>
                    <span>
                        Reanudar Plan
                    </span>
                </button>
                @else
                <button id="cancelar" wire:click="cancelingSubscription"
                    wire:loading.attr="disabled"
                    wire:target="cancelingSubscription"
                    class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full">
                    <x-spinner wire:loading  wire:target="cancelingSubscription" size="6" class="mr-2 inline-block align-middle"></x-spinner>
                    <span>
                        Cancelar
                    </span>
                </button>
                @endif
            @else
            <button id="cambiar" wire:click="changingPlan"
                wire:loading.attr="disabled"
                wire:target="changingPlan"
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full">
                <x-spinner wire:loading  wire:target="changingPlan" size="6" class="mr-2 inline-block align-middle"></x-spinner>
                <span>
                    Cambiar de Plan
                </span>
            </button>
            @endif
        @else
        <button id="suscribirse" wire:click="newSubscription" 
            wire:loading.attr="disabled"
            wire:target="newSubscription"
            class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full">
            <x-spinner wire:loading  wire:target="newSubscription" size="6" class="mr-2 inline-block align-middle"></x-spinner>
            <span>
                Suscribirse
            </span>
        </button>
        @endif
    @else
    <button class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full">
        Agregar método de pago
    </button>
    @endif

</div>
