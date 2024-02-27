document.getElementById("afterpay-button").addEventListener("click", function() {
    AfterPay.initialize({countryCode: "AU"});
    AfterPay.open();
    
    var input_amount=document.getElementById('input_amount').value;
    var booking_free= parseFloat(input_amount*0.03).toFixed(2);
    var formdata = new FormData();
    formdata.append('name',document.getElementById('name').value);
    formdata.append('email',document.getElementById('email').value);
    formdata.append('mobile_no',document.getElementById('mobile_no').value);
    formdata.append('input_amount',input_amount);
    formdata.append('booking_free',booking_free);

    $.ajax({
        url: after_pay_backend,
        type: 'post',
        processData: false,
        contentType: false,
        processData: false,
        data:formdata,
        success: function(data) {
            AfterPay.transfer({token: data});
        }
                    
      });
    AfterPay.onComplete = function(event) {
      if (event.data.status == "SUCCESS") {
        // The customer confirmed the payment schedule.
        // The token is now ready to be captured from your server backend.
      } else {
        // The customer cancelled the payment or closed the popup window.
      }
    }
    
  });