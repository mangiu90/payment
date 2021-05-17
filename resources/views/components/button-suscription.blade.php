@props(['name', 'price'])

<div class="w-full">
    @if (auth()->user()->subscribed($name))
        @if (auth()->user()->subscribedToPlan($price, $name))
            @if (auth()->user()->subscription($name)->onGracePeriod())
            <button wire:click="resumingSubscription('{{ $name }}')"
                wire:loading.remove
                wire:target="resumingSubscription('{{ $name }}')"
                class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full">
                Reanudar Plan
            </button>

            <button wire:loading.flex 
                wire:target="resumingSubscription('{{ $name }}')"
                class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                <x-spinner size="6" class="mr-2"></x-spinner>
                Reanudar Plan
            </button>  
            @else
            <button wire:click="cancelingSubscription('{{ $name }}')"
                wire:loading.remove
                wire:target="cancelingSubscription('{{ $name }}')"
                class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full">
                Cancelar
            </button>

            <button wire:loading.flex 
                wire:target="cancelingSubscription('{{ $name }}')"
                class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                <x-spinner size="6" class="mr-2"></x-spinner>
                Cancelar
            </button>
            @endif
        @else
        <button wire:click="changingPlan('{{ $name }}', '{{ $price }}')"
            wire:loading.remove
            wire:target="changingPlan('{{ $name }}', '{{ $price }}')"
            class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full">
            Cambiar de Plan
        </button>

        <button wire:loading.flex 
            wire:target="changingPlan('{{ $name }}', '{{ $price }}')"
            class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
            <x-spinner size="6" class="mr-2"></x-spinner>
            Cambiar de Plan
        </button>
        @endif
    @else
    <button wire:click="newSubscription('{{ $name }}', '{{ $price }}')" 
        wire:loading.remove
        wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
        class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full">
        Suscribirse
    </button>

    <button wire:loading.flex 
        wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
        class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
        <x-spinner size="6" class="mr-2"></x-spinner>
        Suscribirse
    </button>
    @endif
</div>