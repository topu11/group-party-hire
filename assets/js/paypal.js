paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: grand_price,
                    currency_code: 'AUD',
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            //const result=JSON.stringify(details,null,2);
           // console.log(details.purchase_units[0].payments.captures[0].id , details.purchase_units[0].payments.captures[0].status);
            let paypal_tansaction_id=details.purchase_units[0].payments.captures[0].id;
            let paypal_transaction_status=details.purchase_units[0].payments.captures[0].status;
            let paypal_transaction_name=details.payer.name.given_name;
            if(paypal_transaction_status == "COMPLETED")
            {
              swal.showLoading();
              var input_amount=document.getElementById('input_amount').value;
              var booking_free= parseFloat(input_amount*0.03).toFixed(2)
      
             var formdata = new FormData();
      
            formdata.append('name',document.getElementById('name').value);
            formdata.append('email',document.getElementById('email').value);
            formdata.append('mobile_no',document.getElementById('mobile_no').value);
            formdata.append('input_amount',input_amount);
            formdata.append('booking_free',booking_free);
            formdata.append('payment_method',payment_method);
            formdata.append('paymentMethodId',paypal_tansaction_id);
            formdata.append('paypal_transaction_name',paypal_transaction_name);
     
   
      $.ajax({
              url: ajax_endpoints,
              type: 'post',
              processData: false,
              contentType: false,
              processData: false,
              data: formdata,
              success: function(data) {
                swal.hideLoading()
                const obj = JSON.parse(data);
                console.log(obj);
             document.getElementById("fileUploadForm").reset();
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
                      //location.reload();
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
                      

                      html: html,
                  
                     });
                  }
              }
                });
            }
        });
    },
    onError: function(err) {
        console.error('Error:', err);
        alert('Can Not Pay Zero')
    }
}).render('#paypal-button-container');