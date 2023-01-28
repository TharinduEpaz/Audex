<!DOCTYPE html>
<html>
  <head>
    <title>Buy cool new product</title>
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/payment.css';?>">
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <section>
    <?php echo '<pre>'; print_r($data); echo '</pre>';?>
    <!-- <h1></h1><?php echo $data['price'];?></h1> -->
      <div class="product">
        <img src="<?php echo URLROOT.'/public/uploads/'.$data['image1'];?>" alt="The cover of Stubborn Attachments" />
        <div class="description">
          <h3><?php echo $data['title'];?></h3>
          <h5>LKR300.00</h5>
        </div>
      </div>
      <!-- <form action="<?php URLROOT?>/users/payment/<?php urlencode(json_encode($data))?>" method="POST">
        <button type="submit" id="checkout-button">Checkout</button>
      </form> -->
      <button class="stripe-button" id="payButton">
        <div class="spinner hidden" id="spinner"></div>
        <span id="buttonText">Pay Now</span>
      </button>
    </section>
  </body>
  <script>
    // const stripe = Stripe('pk_test_51MU2C4GlTSbBWjmij5ZWbU3wOBLFWZUeBS4AcCwc0FIZQAc9ifJmoZyyK33TYAqWB80sqMouMEWn2UNwyJUbawqU00UMTnoldI');
    // const checkoutButton = document.getElementById('checkout-button');

    // checkoutButton.addEventListener('click', () => {
    //   stripe.redirectToCheckout({
    //     // Make the id field from the Checkout Session creation API response
    //     // available to this file, so you can provide it as argument here
    //     // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
    //     sessionId: '{{CHECKOUT_SESSION_ID}}'
    //   })
    //   // If `redirectToCheckout` fails due to a browser or network
    //   // error, display the localized error message to your customer
    //   // using `error.message`.
    // });

    // Set Stripe publishable key to initialize Stripe.js
    const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

    // Select payment button
    const payBtn = document.querySelector("#payButton");

    // Payment request handler
    payBtn.addEventListener("click", function (evt) {
        setLoading(true);
    
        createCheckoutSession().then(function (data) {
            if(data.sessionId){
                stripe.redirectToCheckout({
                    sessionId: data.sessionId,
                }).then(handleResult);
            }else{
                handleResult(data);
            }
        });
    });

    // Create a Checkout Session with the selected product
    const url='<?php echo URLROOT;?>/users/payment';
    const createCheckoutSession = function (stripe) {
        return fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                createCheckoutSession: 1,
            }),
        }).then(function (result) {
            return result.json();
        });
    };

    // Handle any errors returned from Checkout
    const handleResult = function (result) {
        if (result.error) {
            showMessage(result.error.message);
        }

        setLoading(false);
    };

    // Show a spinner on payment processing
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            payBtn.disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#buttonText").classList.add("hidden");
        } else {
            // Enable the button and hide spinner
            payBtn.disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#buttonText").classList.remove("hidden");
        }
    }

    // Display message
    function showMessage(messageText) {
        const messageContainer = document.querySelector("#paymentResponse");
    
        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;
    
        setTimeout(function () {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
        }, 5000);
    }

  </script>
</html>