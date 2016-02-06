<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body> 
        <div class="col-md-6 col-md-offset-3">

         <form id="payment-form" action="#" method="POST">

          <input class="card-amount-int" type="hidden" value="15" />
          <input class="card-currency" type="hidden" value="EUR" />
          <input type="hidden" id="paymill_token" name="paymill_token">

          <div class="form-row form-group">
            <label>Card number</label>
            <input class="card-number form-control" type="text" size="20" />
          </div>

          <div class="form-row form-group">
            <label>CVC</label>
            <input class="card-cvc form-control" type="text" size="4" />
          </div>

          <div class="form-row form-group">
            <label>Name</label>
            <input class="card-holdername form-control" type="text" size="4" />
          </div>

          <div class="form-row form-group">
            <label>Expiry date (MM/YYYY)</label>
            <input class="card-expiry-month " type="text" size="2" />
            <span></span>
            <input class="card-expiry-year" type="text" size="4" />
          </div>


          <button class="submit-button btn btn-danger" type="submit">Submit</button>

        </form>

        </div>
    <script src="https://code.jquery.com/jquery-2.2.0.js"></script>

        <script type="text/javascript">
        var PAYMILL_PUBLIC_KEY = '84826886873b16ac220deb8fd852d437';
        </script>
    <script type="text/javascript" src="https://bridge.paymill.com/"></script>

    <script type="text/javascript">
        $(document).ready(function() {
  $("#payment-form").submit(function(event) {
    // Deactivate submit button to avoid further clicks
    $('.submit-button').attr("disabled", "disabled");

    var code25 = paymill.createToken({
      number: $('.card-number').val(),  // required, ohne Leerzeichen und Bindestriche
      exp_month: $('.card-expiry-month').val(),   // required
      exp_year: $('.card-expiry-year').val(),     // required, vierstellig z.B. "2016"
      cvc: $('.card-cvc').val(),                  // required
      amount_int: $('.card-amount-int').val(),    // required, integer, z.B. "15" für 0,15 Euro
      currency: $('.card-currency').val(),    // required, ISO 4217 z.B. "EUR" od. "GBP"
      cardholder: $('.card-holdername').val() // optional
    }, PaymillResponseHandler);                   // Info dazu weiter unten
    //console.log(code25);
    return false;
  });

  function PaymillResponseHandler(error, result) {
  if (error) {
    // Shows the error above the form
    $(".payment-errors").text(error.apierror);
    $(".submit-button").removeAttr("disabled");
  } else {
    var form = $("#payment-form");
    // Output token
    var token = result.token;
    //console.log(token);
    $('#paymill_token').val(token);

     var token = $('#paymill_token').val();
        $.ajax({
            type: "POST",
            url: "/paymill/"+token,
            data:  {token: token},
            success: function (result) {
                console.log(result);
            }
        });
    // Insert token into form in order to submit to server
    form.append("");
  }
}

});
    </script>
<script type="text/javascript">
    // $('#paymill_token').on("change", function(){
    //     alert('Hello');
    //     var token = $('#paymill_token').val();
    //     $.ajax({
    //         type: $(this).attr('method'),
    //         url: "/paymill/token/{token}",
    //         data: token,
    //         success: function (result) {
    //             console.log(result);
    //         }
    //     });
    //     e.preventDefault();
    // });
</script>
    </body>
</html>
