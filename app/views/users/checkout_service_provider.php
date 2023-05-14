<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Accept a payment</title>
    <meta name="description" content="A demo of a payment on Stripe" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/checkout.css';?>" />
    <script src="https://js.stripe.com/v3/"></script>
    <!-- <script src="<?php echo URLROOT . '/public/checkout.js';?>" defer></script> -->
  </head>
  <body>
    <!-- Display a payment form -->
    <form id="payment-form">
      <div class="product">
        <!-- <img src="<?php echo URLROOT.'/public/uploads/'.$data['image1'];?>" alt="The cover of Stubborn Attachments" /> -->
        <div class="description">
          <h3><?php echo $data['title'];?></h3>
          <h5>LKR1500.00</h5>
        </div>
      </div>
      <div id="link-authentication-element">
        <!--Stripe.js injects the Link Authentication Element-->
      </div>
      <div id="payment-element">
        <!--Stripe.js injects the Payment Element-->
      </div>
      <button id="submit">
        <div class="spinner hidden" id="spinner"></div>
        <span id="button-text">Pay now</span>
      </button>
      <div id="payment-message" class="hidden"></div> 
    </form>
  </body>
  <script>
    // This is your test publishable API key.
        const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY;?>');
        
        // The items the customer wants to buy
        const items = [{ id: "xl-tshirt" }];
        
        let elements;
        
        initialize();
        checkStatus();
        
        document
          .querySelector("#payment-form")
          .addEventListener("submit", handleSubmit);
        
        let emailAddress = '';
        // Fetches a payment intent and captures the client secret
        async function initialize() {
          const url='<?php echo URLROOT?>/users/payment';
        
          const { clientSecret } = await fetch(url, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ items }),
          }).then((r) => r.json());
        
          elements = stripe.elements({ clientSecret });
        
          const linkAuthenticationElement = elements.create("linkAuthentication");
          linkAuthenticationElement.mount("#link-authentication-element");
        
          const paymentElementOptions = {
            layout: "tabs",
          };
        
          const paymentElement = elements.create("payment", paymentElementOptions);
          paymentElement.mount("#payment-element");
        }
        
        async function handleSubmit(e) {
          e.preventDefault();
          setLoading(true);
        
          const { error } = await stripe.confirmPayment({
            elements,
            confirmParams: {
              // Make sure to change this to your payment completion page
              return_url: "<?php echo URLROOT?>/users/paid_service_provider/<?php echo $data['user_id'];?>",
              receipt_email: '<?php echo $_SESSION['user_email'];?>',
            },
          });
        
          // This point will only be reached if there is an immediate error when
          // confirming the payment. Otherwise, your customer will be redirected to your `return_url`. 
          // For some payment methods like iDEAL, your customer will
          // be redirected to an intermediate site first to authorize the payment, then
          // redirected to the `return_url`.
          if (error.type === "card_error" || error.type === "validation_error") {
            showMessage(error.message);
          } else {
            showMessage("An unexpected error occurred.");
          }
        
          setLoading(false);
        }
        
        // Fetches the payment intent status after payment submission
        async function checkStatus() {
          const clientSecret = new URLSearchParams(window.location.search).get(
            "payment_intent_client_secret"
          );
        
          if (!clientSecret) {
            return;
          }
        
          const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);
        
          switch (paymentIntent.status) {
            case "succeeded":
              showMessage("Payment succeeded!");
              break;
            case "processing":
              showMessage("Your payment is processing.");
              break;
            case "requires_payment_method":
              showMessage("Your payment was not successful, please try again.");
              break;
            default:
              showMessage("Something went wrong.");
              break;
          }
        }
        
        // ------- UI helpers -------
        
        function showMessage(messageText) {
          const messageContainer = document.querySelector("#payment-message");
        
          messageContainer.classList.remove("hidden");
          messageContainer.textContent = messageText;
        
          setTimeout(function () {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
          }, 4000);
        }
        
        // Show a spinner on payment submission
        function setLoading(isLoading) {
          if (isLoading) {
            // Disable the button and show a spinner
            document.querySelector("#submit").disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#button-text").classList.add("hidden");
          } else {
            document.querySelector("#submit").disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#button-text").classList.remove("hidden");
          }
        }
  </script>
</html>