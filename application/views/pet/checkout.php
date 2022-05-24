<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <?php 
        // var_dump($_SESSION['product_id']);
        extract($_SESSION['total']);

        ?>
    <div class="container">
        <div class="row justify-content-center mx-auto pt-5">
            <div class="col-5">
                <h4>Billing Address</h4> 
                <form action="<?= base_url() ?>petshits/charge" method="post" id="payment-form">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $_SESSION['user']['first_name'] ?>" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?= $_SESSION['user']['last_name'] ?>">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email_buyer" id="email" value='<?= $_SESSION['user']['email'] ?>' >
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Address</label>
                    <input type="text" class="form-control" name="line1" id="address" placeholder='1234 Main St. (Required)' >
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Address 2</label>
                    <input type="text" class="form-control" name="line2" id="address"  placeholder='Apartment or suite(Optional)'>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="municipality" class="form-label">Municipality</label>
                            <input type="text" class="form-control" name="municipality" id="address" placeholder="Ex: Poblacion, Makati City" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="zip" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" name="zip" id="zip" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="municipality" class="form-label">Telephone or Cellphone Number</label>
                            <input type="text" class="form-control" name="telephone" id="address" placeholder="Ex: 862317234" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 pt-5">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Your Cart
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                            <li class="list-group-item"><?= $value['product'] ?><span class="badge bg-secondary position-absolute end-0 me-3">$ <?= $value['price']?></span></li>
                        <?php } 
                        ?>
                    </ul>
                    <div class="card-footer">
                        Your Total <span class="badge bg-secondary position-absolute end-0 me-3">$ <?= $total ?></span>
                    </div>
                </div>
                <div class="my-3">
                    <label for="description" class="form-label">Note for Seller</label>
                    <textarea class="form-control form-control-sm" name="description" id="description" style="width: 37vh;" rows="5"></textarea>
                </div>
                <div class="my-4">
                    <select class="form-select form-select-sm" name="courier" aria-label=".form-select-sm example" style="width: 37vh;">
                        <option selected>Select Courier</option>
                        <option value="borzo">Borzo</option>
                        <option value="2go express">2Go Express</option>
                        <option value="ninjas van">Ninjas Van</option>
                        <option value="xend">Xend</option>
                        <option value="grab express">Grab Express</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mx-auto pt-5">
            <div class="col-9">
                <hr class="mb-4">
                <h4>Payment</h4>
                    <div class="form-row">
                        <label for="card-element">
                        Credit or debit card
                        </label>
                        <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                        </div>
        
                        <!-- Used to display Element errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
        
                    <button class="btn btn-primary mt-3">Submit Payment</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Set your publishable key: remember to change this to your live publishable key in production
        // See your keys here: https://dashboard.stripe.com/apikeys
        var stripe = Stripe('pk_test_51KeEneFp9N6Yc1V9NUb0c61nMNkLryVguQvr3p50PREPfEwkxXAZBvHx2REqzlaCXuP4J56UuVRZPGp1K6oSpcAG004oB0lvf9');
        // var stripe = Stripe('pk_test_51KeEneFp9N6Yc1V9NUb0c61nMNkLryVguQvr3p50PREPfEwkxXAZBvHx2REqzlaCXuP4J56UuVRZPGp1K6oSpcAG004oB0lvf9');
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        var style = {
            base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            color: '#32325d',
            },
        };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Create a token or display an error when the form is submitted.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
        // Inform the customer that there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
        } else {
        // Send the token to your server.
        stripeTokenHandler(result.token);
        }
    });
    });

    function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
    }

    </script>
</body>
</html>