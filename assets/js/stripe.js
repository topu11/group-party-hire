var stripe = Stripe(ENCODER_IT_STRIPE_PK);
  var elements = stripe.elements({'currency':'aud'});
  var cardElement = elements.create('card', {
  style: {
    base: {
      iconColor: '#000',
      color: '#3c434a',
      fontWeight: '500',
      fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
      fontSize: '16px',
      fontSmoothing: 'antialiased',
      ':-webkit-autofill': {
        color: '#fce883',
      },
      '::placeholder': {
        color: '#3c434a',
      },
    },
    invalid: {
      iconColor: '#ff000c',
      color: '#ff000c',
    },
      g: {
    fill: '#000',
  },
  },
});
  
  // Mount the Card Element to the DOM
  cardElement.mount('#card-element');
  
  /******* Stripe Sections end */

  var form = document.getElementById('fileUploadForm');
  form.addEventListener('submit', function(event) {
    event.preventDefault();

     if(payment_method == "Credit Card"){
      stripe.createPaymentMethod({
      type: 'card',
      card: cardElement,
      billing_details: {
           name: document.getElementById('name').value,
           email:document.getElementById('email').value,
          },
        }).then(function(result) {
          if (result.error) {
            // Display error to your user
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
          } else {
            
            swal.showLoading();
            var input_amount=document.getElementById('input_amount').value;
            var booking_free= parseFloat(input_amount*0.03).toFixed(2)
            var formdata = new FormData();
            formdata.append('paymentMethodId',result.paymentMethod.id);
            formdata.append('name',document.getElementById('name').value);
            formdata.append('email',document.getElementById('email').value);
            formdata.append('mobile_no',document.getElementById('mobile_no').value);
            formdata.append('input_amount',input_amount);
            formdata.append('booking_free',booking_free);
            formdata.append('payment_method',payment_method);
            $.ajax({
                    url: ajax_endpoints,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    success: function(data) {
                      const obj = JSON.parse(data);
                      console.log(obj);
                     
                        if (obj.success == "success") {
                            Swal.fire({
                                // position: 'top-end',
                                icon: 'success',
                                text: 'Payment is successfully done',
                                showConfirmButton: true,
                                //timer: 5000
                            })
                             document.getElementById("fileUploadForm").reset();
                             $('#booking_amount').html('0.00');
                             $('#payment_amount').html('');
                             $('#booking_free').html('');
                             $('#grand_total').html('');
                             $('#paypal-button-container').hide();
                             $('#stripe_payment_div').hide();
                        }
                        if(obj.success == "error")
                        {
                          let message_arr=obj.message.split(';')
                          let html='';
                          for(let index=0;index<message_arr.length;index++)
                          {
                               var temp=message_arr[index]+"\n";
                               html = html+temp;
                          }
                          swal.fire({
                            

                            text: html,
                        
                           });
                        }
                    }
            });
          }
        });
     }
     else if(payment_method == "After Pay")
     {
         return;
     }
     else
     {
      swal.fire({text: 'Please Select Transaction methods', });
     }
     
     
});