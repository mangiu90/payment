<div>
    <section class="card">
        <div class="px-6 py-4 bg-green-50">
            <h1 class="text-gray-700 text-lg font-bold">Métodos de pago agregados</h1>
        </div>

        <div class="card-body divide-y divide-gray-200">
            @foreach ($paymentMethods as $paymentMethod)

            <article class="text-sm text-gray-700 py-2">
                <h1><span class="font-bold">{{$paymentMethod->billing_details->name}}</span> xxxx-{{$paymentMethod->card->last4}}</h1>
                <p>Expira {{$paymentMethod->card->exp_month}}/{{$paymentMethod->card->exp_year}}</p>
            </article>
                
            @endforeach
        </div>

    </section>
</div>
