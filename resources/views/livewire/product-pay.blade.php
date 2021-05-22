<div>
    <div class="card relative">
        <div wire:loading.flex class="absolute w-full h-full bg-gray-100 bg-opacity-25 z-30 items-center justify-center">
            <x-spinner size="20"></x-spinner>
        </div>

        <div class="card-body">
            <div class="flex justify-between items-center">
                <h1 class="text-lg font-bold text-gray-700">Método de pago</h1>

                <img class="h-8 mb-4" src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" alt="">
            </div>

            <form action="" id="card-form">
                <div class="form-group" id="card-form">
                    <label class="form-label">Nombre de la tarjeta</label>

                    <input class="form-control" id="card-holder-name" type="text" placeholder="Ingese el nombre del titular de la tarjeta" required>
                </div>

                <!-- Stripe Elements Placeholder -->
                <div class="form-group">
                    <label class="form-label">Número de tarjeta</label>

                    <div class="form-control" id="card-element"></div>

                    <span class="invalid-feedback" id="card-error"></span>
                </div>
                
                <button class="btn btn-primary" id="card-button">
                    Process Payment
                </button>
           </form>
        </div>
    </div>

    @slot('js')
    <script>
        document.addEventListener('livewire:load', function () {
            stripe();
        });

        Livewire.on('resetStripe', function () {
            document.getElementById('card-form').reset();
            stripe();

            alert('La compra se realizo con exito.');
        });

        Livewire.on('errorPayment', function () {
            document.getElementById('card-form').reset();
            stripe();

            alert('Hubo un error en la compra, intentalo de nuevo.');
        });
    </script>

    <script>
        function stripe() {
            const stripe = Stripe('{{config('stripe.key')}}');
    
            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');

            //metodo de pago
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const cardForm = document.getElementById('card-form');

            cardForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const { paymentMethod, error } = await stripe.createPaymentMethod(
                    'card', cardElement, {
                        billing_details: { name: cardHolderName.value }
                    }
                );

                if (error) {
                    document.getElementById('card-error').textContent = error.message;
                } else {
                    Livewire.emit('paymentMethodCreate', paymentMethod.id);
                }
            });
        }
    </script>
    @endslot
</div>
