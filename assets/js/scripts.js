$(document).ready(function(){
    //alert("Allah Akbar")
    // $('#input_amount').on('change',function(){
    //     $('#booking_amount').html(parseFloat($('#input_amount').val()*0.3))
    // })

    document.getElementById('input_amount').addEventListener('change', function(event) {
        var input_amount = event.target.value;
        if(input_amount <= 0)
             {
                  return ;
             }
        $('#booking_amount').html(parseFloat(input_amount*0.03).toFixed(2))
    });
    
    document.getElementById('input_amount').addEventListener('input', function(event) {
    var input_amount = event.target.value;
    if(input_amount <= 0)
             {
                  return ;
             }
    $('#booking_amount').html(parseFloat(input_amount*0.03).toFixed(2))
    var payment_amount_float = parseFloat(input_amount).toFixed(2);
    $('#payment_amount').html("$ "+payment_amount_float);
    $('#booking_free').html("$ "+ parseFloat(input_amount*0.03).toFixed(2));
    var grand_total=(parseFloat(input_amount)+parseFloat(input_amount*0.03)).toFixed(2)
    grand_price=grand_total;
    $('#grand_total').html("$ "+grand_total)

    });
    
     
})

// $(function() {
//      $("#mobile_no").intlTelInput({
//         onlyCountries: ["au"]
//      });
//      });


    //  $("#mobile_no").on("blur keyup change", function() {
    //       if($(this).val() == '') {
    //           var getCode = $("#mobile_no").intlTelInput('getSelectedCountryData').dialCode;
    //           $(this).val('+'+getCode);
    //           //alert(getCode)
    //  }});

    //  $(document).on("click","#mobile_no",function(){
    //           if($("#mobile_no").val() == '') {
    //               var getCode = $("#mobile_no").intlTelInput('getSelectedCountryData').dialCode;
    //               $("#mobile_no").val('+'+getCode);
    //  }})     

    $('#submit_btn').on('click',function(e){
     e.preventDefault();
     var input_amount= $('#input_amount').val();
     var booking_free= parseFloat(input_amount*0.03).toFixed(2)
     var formdata = new FormData();
     formdata.append('input_amount',input_amount);
     formdata.append('booking_free',booking_free);
     formdata.append('mobile_no',$('#mobile_no').val());
     
     $.ajax({
          url: '/form_submit.php',
          type: 'post',
          processData: false,
          contentType: false,
          processData: false,
          data: formdata,
          success: function(data) {
            
          }
     });
})
     
function check_radio_payment_method(id,e)
{
    event.preventDefault();
  document.getElementById('stripe_payment_div').style.display='none';
  document.getElementById('paypal-button-container').style.display='none'; 

  var input_amount=document.getElementById('input_amount').value;
  var email=document.getElementById('email').value;
  var name=document.getElementById("name").value;
  var mobile_no=document.getElementById("mobile_no").value;
  if(!validateEmail(email))
  {
      swal.fire({
              text: "please input correct Email Address",
            });
            document.getElementById(id).checked = false;      
      return false;
  }
  if(!isPhone(mobile_no))
  {
      swal.fire({
              text: "please input correct Australian Phone number Example +61 4 1234 5678 ",
            });
            document.getElementById(id).checked = false;      
      return false;
  }
 
  if(input_amount == 0  || !validateEmail(email) || !name || !isPhone(mobile_no))
  {
     swal.fire({
              text: "please provide all information",
            });
            document.getElementById(id).checked = false;      
      return false;
       
  }
  
  payment_method=document.getElementById(id).value;
  if(id == "encoderit_stripe")
  {
     document.getElementById('stripe_payment_div').style.display='block';
     document.getElementById('paypal-button-container').style.display='none';
     document.getElementById('after_pay_container').style.display='none';
     document.getElementById('encoder_it_submit_btn_user_form').style.display='block';
     /*** Show the Submit Button */
     
  }else if(id=="encoderit_paypal")
  {
    document.getElementById('stripe_payment_div').style.display='none';
    document.getElementById('paypal-button-container').style.display='block';
    document.getElementById('after_pay_container').style.display='none';
    document.getElementById('encoder_it_submit_btn_user_form').style.display='none';
    /*** hide the Submit Button */
    
  }
  else if(id=="encoderit_after_pay_transfer")
  {
    document.getElementById('stripe_payment_div').style.display='none';
    document.getElementById('paypal-button-container').style.display='none';
    document.getElementById('after_pay_container').style.display='block';        
    document.getElementById('encoder_it_submit_btn_user_form').style.display='none';
    /*** hide the Submit Button */
  }
  else
  {
    document.getElementById('stripe_payment_div').style.display='none';
    document.getElementById('paypal-button-container').style.display='none';
    document.getElementById('after_pay_container').style.display='none';
    document.getElementById('encoder_it_submit_btn_user_form').style.display='none';
     /*** hide the Submit Button */
    
  }
}

const validateEmail = (email) => {
     return String(email)
       .toLowerCase()
       .match(
         /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
       );
   };
   
const isPhone = (phoneNumber) => {
  const cleanedPhoneNumber = phoneNumber.replace(/-|\s/g, ''); // Remove spaces and hyphens before performing test
  const pattern = new RegExp('^(?:\\+?(61))? ?(?:\\((?=.*\\)))?(0?[2-57-8])\\)? ?(\\d\\d(?:[- ](?=\\d{3})|(?!\\d\\d[- ]?\\d[- ]))\\d\\d[- ]?\\d[- ]?\\d{3})$');
  return pattern.test(cleanedPhoneNumber);
} 
   