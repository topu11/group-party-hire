<?php
define('ENCODER_IT_STRIPE_PK',"pk_test_51OD1o3HXs2mM51TXR04wpLYzxxWNpOQWZr8Y84oV0Bp5aP1sB0gVic7JqBdrOgQmqYAwT7a9TOfq4UBG5ioifu9F00VwcHhkCb");
define('ENCODER_IT_STRIPE_SK',"sk_test_51OD1o3HXs2mM51TXAPMu48pbSpxilR2QjxiXEipq60TE8y96wg51zs9qPSDZomhDtYGcmwIFPboEgFaHi1SINsNZ00FZ8b7i8R");

include('stripe-php-library/init.php' );
include('smtp/PHPMailerAutoload.php');



\Stripe\Stripe::setApiKey(ENCODER_IT_STRIPE_SK);


if($_POST['payment_method']=="Paypal")
{
    $is_payment_success=encode_it_paypal_payment();
    if(!empty($is_payment_success))
    {
        echo $is_payment_success;
    } 
}elseif($_POST['payment_method']=="Credit Card")
{
    $encode_it_stripe_payment_return=encode_it_stripe_payment();
    $decoded_stripe=json_decode($encode_it_stripe_payment_return,true);
    if($decoded_stripe['status'] == "success")
    {
            $to_email_customer=$_POST['email'];
            $to_mail_copy="touhidul.developer.2024@gmail.com";
            $Subject="Group Party Hire - Payment Successful";
             $grand_total=$_POST['input_amount']+$_POST['booking_free'];
                $email_body='';
                $email_body = '<p> Contact Name: ' . $_POST['name']. '</p>';
                $email_body .= '<p> Contact Email: ' . $_POST['email'] . '</p>';
                $email_body .= '<p> Contact Number: ' . $_POST['mobile_no'] . '</p>';
                $email_body .= '<p> Payment Method: ' . $_POST['payment_method'] . '</p>';
                $email_body .= '<p> Transaction Number: ' . $_POST['paymentMethodId'] . '</p>';
                $email_body .= '<p> Payment Amount: ' . $_POST['input_amount'] . '</p>';
                $email_body .= '<p> Booking Free: ' . $_POST['booking_free'] . '</p>';
                $email_body .= '<p> Grand Total: ' . $grand_total . '</p>';
      
                if((smtp_mailer($to_email_customer,$Subject,$email_body) == "Sent") &&(smtp_mailer($to_mail_copy,$Subject,$email_body) == "Sent"))
        {
            echo  json_encode([
                'success' => 'success',
                'message'=>'Form Submmited Successfully'
            ]);  
        }else
        {
            echo  json_encode([
                'success' => 'error',
                'message'=>'Something worng.;'
            ]);
        }                        
    }
    else
     {
        echo  json_encode([
            'success' => 'error',
            'message'=>$decoded_stripe['message'].';'
        ]);              
    }
}

    function encode_it_stripe_payment()
    {
        try {
            // Create a PaymentIntent
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => ($_POST['input_amount']+$_POST['booking_free'])* 100, // Replace with your actual amount
                'currency' => 'aud',
                'payment_method' => $_POST['paymentMethodId'],
                //'confirmation_method' => 'manual',
                'confirm' => true,
                'metadata' => [
                    'email' => $_POST['email'],
                    'name'=>$_POST['name'],
                    'mobile_no'=>$_POST['mobile_no'],
                ],
                'automatic_payment_methods'=>[
                    'enabled'=>true,
                    'allow_redirects'=>'never'
                ]
            ]);
           
            // Confirm the PaymentIntent
            // if ($paymentIntent->status === 'requires_action' ||
            //     $paymentIntent->status === 'requires_source_action') {
            //     // Card action required
            //     $confirmation = \Stripe\PaymentIntent::confirm($paymentIntent->id);
            // }
             //var_dump($paymentIntent);
            // Handle the success or failure of the payment
            if ($paymentIntent->status === 'succeeded') {
                // Payment succeeded
                return json_encode(['status' => 'success', 'message' => 'Payment succeeded!']);
            } else {
                // Payment failed
                return json_encode(['status' => 'failure', 'message' => 'Payment failed.']);
            }
        } catch (\Exception $e) {
            // Handle errors
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }

          
    }



   function encode_it_paypal_payment()
   {
    $to_email_customer=$_POST['email'];
    $to_mail_copy="touhidul.developer.2024@gmail.com";
    $Subject="Group Party Hire - Payment Successful";
    $grand_total=$_POST['input_amount']+$_POST['booking_free'];
       $email_body='';
       $email_body = '<p> Contact Name: ' . $_POST['name']. '</p>';
       $email_body .= '<p> Contact Email: ' . $_POST['email'] . '</p>';
       $email_body .= '<p> Contact Number: ' . $_POST['mobile_no'] . '</p>';
       $email_body .= '<p> Payment Method: ' . $_POST['payment_method'] . '</p>';
       $email_body .= '<p> paypal Transaction Name: ' . $_POST['paypal_transaction_name'] . '</p>';
       $email_body .= '<p> Transaction Number: ' . $_POST['paymentMethodId'] . '</p>';
       $email_body .= '<p> Payment Amount: ' . $_POST['input_amount'] . '</p>';
       $email_body .= '<p> Booking Free: ' . $_POST['booking_free'] . '</p>';
       $email_body .= '<p> Grand Total: ' . $grand_total . '</p>';

        if((smtp_mailer($to_email_customer,$Subject,$email_body) == "Sent") &&(smtp_mailer($to_mail_copy,$Subject,$email_body) == "Sent"))
        {
        echo  json_encode([
            'success' => 'success',
            'message'=>'Form Submmited Successfully'
        ]);  
        }
        else
        {
            return  json_encode([
                'success' => 'error',
                'message'=>'Something worng.;'
            ]);
        }
   }

   function encode_it_afterpay_payment()
   {
    $to_email_customer=$_POST['email'];
    $to_mail_copy="touhidul.developer.2024@gmail.com";
    $Subject="Group Party Hire - Payment Successful";
    $grand_total=$_POST['input_amount']+$_POST['booking_free'];
       $email_body='';
       $email_body = '<p> Contact Name: ' . $_POST['name']. '</p>';
       $email_body .= '<p> Contact Email: ' . $_POST['email'] . '</p>';
       $email_body .= '<p> Contact Number: ' . $_POST['mobile_no'] . '</p>';
       $email_body .= '<p> Payment Method: ' . $_POST['payment_method'] . '</p>';
       $email_body .= '<p> Transaction Number: ' . $_POST['paymentMethodId'] . '</p>';
       $email_body .= '<p> Payment Amount: ' . $_POST['input_amount'] . '</p>';
       $email_body .= '<p> Booking Free: ' . $_POST['booking_free'] . '</p>';
       $email_body .= '<p> Grand Total: ' . $grand_total . '</p>';

       if((smtp_mailer($to_email_customer,$Subject,$email_body) == "Sent") &&(smtp_mailer($to_mail_copy,$Subject,$email_body) == "Sent"))
        {
        echo  json_encode([
            'success' => 'success',
            'message'=>'Form Submmited Successfully'
        ]);  
        }
        else
        {
            return  json_encode([
                'success' => 'error',
                'message'=>'Something worng.;'
            ]);
        }
   }



function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 2; 
	$mail->Username = "touhidulislamcuetcse@gmail.com";
	$mail->Password = "jeythingmoowmpqq";
	$mail->SetFrom("touhidulislamcuetcse@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->addAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
}