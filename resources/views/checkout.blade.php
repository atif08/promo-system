<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Checkout Form</h2>
    @if (session()->has('message'))
        <div class="alert alert-{{session('type')}}">
            {{session('message')}}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" value="{{old('first_name')}}" id="firstName" name="first_name" required>
            </div>
            <div class="form-group col-md-6">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="last_name" value="{{old('last_name')}}"  required>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}"  required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}"  required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}"  required>
            </div>
            <div class="form-group col-md-4">
                <label for="state">State</label>
                <select id="state" class="form-control" name="state" value="{{old('state')}}"  required>
                    <option value="punjab"></option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" name="zip" value="{{old('zip')}}"  required>
            </div>
        </div>
        <div class="form-group">
            <label for="promoCode">Promo Code</label>
            <input type="text" class="form-control" id="promoCode" value="{{old('promo_code')}}"  name="promo_code">
        </div>
        <h4 class="mb-3">Payment</h4>
        <div class="d-block my-3">
            <div class="custom-control custom-radio">
                <input id="credit" name="payment_method" value="credit_card" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Credit card</label>
            </div>
            <div class="custom-control custom-radio">
                <input id="debit" name="payment_method" value="debit_card" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">Debit card</label>
            </div>
            <div class="custom-control custom-radio">
                <input id="paypal" name="payment_method" value="papyal" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">PayPal</label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" name="cc_name" value="{{old('cc_name')}}"  required>
                <small class="text-muted">Full name as displayed on card</small>
            </div>
            <div class="form-group col-md-6">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" name="cc_number" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" name="cc_expiration" value="{{old('cc_expiration')}}"  required>
            </div>
            <div class="form-group col-md-3">
                <label for="cc-cvv">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" name="cc_cvv" value="{{old('cc_cvv')}}"  required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cc-name">Promo Code</label>
                <input type="text" class="form-control" id="cc-name" name="promo_code" value="{{old('promo_code')}}">
                <small class="text-muted">Add promo code</small>
            </div>

        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Continue to checkout</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
