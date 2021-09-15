@extends('layouts.admin')

@section('content')
    <form class="card" method="post" id="payment-form" style="padding: 20px"
        action="{{ route('admin.checkout', compact('apartment')) }}">
        @csrf
        @method('POST')
        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
                <a href="{{ route('admin.apartments.index', compact('apartment')) }}">Torna ai tuoi appartamenti</a>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (!session('success_message'))
            <div>
                <div class="card-group sponsors">
                    @foreach ($sponsors as $sponsor)
                        <div class="card border m-2 text-center">
                            <label class="card-body text-center" for="{{ $sponsor->name }}">
                                <h3 class="sponsor-name card-title text-center">{{ $sponsor->name }} </h3>
                                <p class="card-text">durata: {{ $sponsor->period }} ORE</p>
                                <p class="card-text"><small
                                        class="font-weight-bold text-monospace sponsor-price">{{ $sponsor->price }}
                                        €</small></p>
                                <input class="text-center" type="radio" id="{{ $sponsor->name }}" name="amount"
                                    value="{{ $sponsor->price }}">
                            </label>
                        </div>
                    @endforeach
                </div>
                <section>
                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
                </section>
                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="custom-button" type="submit"><span>Completa pagamento</span></button>
            </div>
        @endif
    </form>

    <script src="https://js.braintreegateway.com/web/dropin/1.27.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";
        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            paypal: {
                flow: 'vault'
            }
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
                    // Add the nonce to the form and submit
                    document.querySelector('#nonce').value = 'fake-valid-visa-nonce';
                    console.log(document.querySelector('#nonce').value)
                    form.submit();
                });
            });
        });
    </script>
@endsection
