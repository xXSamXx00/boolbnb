@extends('layouts.registered')

@section('content')
    @include('partials.error')
    <form method="post" id="payment-form"
        action="{{ route('registered.checkout', ['apartment' => $apartment->id, 'sponsor' => $sponsor->id]) }}">
        @csrf
        <section class="mt-5 form-pay p-4 rounded-3">
            <div>
                <p class="fs-5">Hai scelto il pacchetto <span class="sponsor_id fw-bold">{{ $sponsor->name }}</span> </p>
                <span class="input-label">Prezzo</span>
                <div class="input-wrapper price-wrapper">
                    <p class="fs-4 fw-bold">{{ $sponsor->price }}€</p>
                </div>
            </div>

            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
            <input type="hidden" id="nonce" name="payment-method-nonce" value="{{ $sponsor->price }}">
        <button class="button btn button_pay text-white" type="submit"><span>Acquista ora!🎉</span></button>
        </section>


    </form>

    <!-- includes the Braintree JS client SDK -->
    <script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
    <!-- includes jQuery -->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
            // Insert your tokenization key here
            authorization: client_token,
            container: '#bt-dropin',
            paypal: {
                flow: 'vault'
            },
            locale: 'it_IT'
        }, function(createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }

                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
    </script>
@endsection
