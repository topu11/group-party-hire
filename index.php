<?php
define('ENCODER_IT_STRIPE_PK',"pk_test_51OD1o3HXs2mM51TXR04wpLYzxxWNpOQWZr8Y84oV0Bp5aP1sB0gVic7JqBdrOgQmqYAwT7a9TOfq4UBG5ioifu9F00VwcHhkCb");
define('ENCODER_IT_STRIPE_SK',"sk_test_51OD1o3HXs2mM51TXAPMu48pbSpxilR2QjxiXEipq60TE8y96wg51zs9qPSDZomhDtYGcmwIFPboEgFaHi1SINsNZ00FZ8b7i8R");
define('ENCODER_IT_PAYPAL_CLIENT','AVT1TGV_xT-FR1XRXZdKgsyoXIhHf_N4-j26F0W6bYXgLcv4r2jJLu7Bsa1aabiU-0pVGrDFUIdOpvrQ');
define('ENCODER_IT_After_Pay_link','https://portal.sandbox.afterpay.com/afterpay.js');
//define('path','/group-party-hire');
define('path',null);
?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script type="text/javascript" src="<?=ENCODER_IT_After_Pay_link?>"></script>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
    <title>Party Hire Group</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="<?=path?>/plugins/intl-tel-input/build/css/intlTelInput.css"
    />
    <link rel="stylesheet" href="<?=path?>/assets/css/style.css" />
  </head>
  <body>
    <main>
      <section class="main__section section_one">
        <div class="container">
          <form action="" id="fileUploadForm">
            <div class="row">
              <div class="left_text_logo_col col-md-6">
                <div class="text_col">
                  <label for="exampleInputEmail1" class="form-label"
                    >Enter The Amount Below</label
                  >
                  <div class="payment__amount input-group">
                    <span class="input-group-text" id="basic-addon1">A$</span>
                    <input
                      type="number"
                      class="form-control"
                      min="1.0"
                      step="any"
                      id="input_amount"
                    />
                  </div>
                  <p>Booking Free : $<span id="booking_amount">0.00</span></p>
                </div>
                <div class="img_col my-3 text-center">
                  <img src="<?=path?>/assets/images/left_img.png" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="input__grp mb-3">
                  <label for="exampleInputEmail1" class="form-label"
                    >Email</label
                  >
                  <input
                    type="email"
                    class="form-control"
                    name="email"
                    id="email"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                  />
                </div>
                <div class="input__grp mb-3">
                  <label for="exampleInputPassword1" class="form-label"
                    >Name</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    name="name"
                    id="name"
                    id="exampleInputPassword1"
                  />
                </div>
                <div class="input__grp mb-3">
                  <label for="exampleInputPassword1" class="form-label"
                    >Mobile Number</label
                  >
                  <div class="au__input_g input-group">
                    <span class="input-group-text">
                      <img src="<?=path?>/assets/images/AU_icon.png" alt="">
                    </span>
                    <input
                      type="tel"
                      class="form-control"
                      id="mobile_no"
                      placeholder=""
                      name="mobile_no"
                      value="+61"
                    />
                  </div>
                </div>
                

                <div class="right_col right_total_price">
                  <div class="payment_method_container">
                    <div class="item btn_container d-flex">
                      <!-- <input
                        type="radio"
                        name="payment_method"
                        id="encoderit_paypal"
                        value="Paypal"
                        onclick="check_radio_payment_method(this.id)"
                      />
                      <span>Paypal</span> -->
                      <button
                        class="btn btn_item"
                        name="payment_method"
                        id="encoderit_paypal"
                        value="Paypal"
                        onclick="check_radio_payment_method(this.id)"
                      >
                        <img src="<?=path?>/assets/images/paypal_icon.png" />
                        <span>Paypal</span>
                      </button>
                      <button
                        class="btn btn_item"
                        name="payment_method"
                        id="encoderit_stripe"
                        value="Credit Card"
                        onclick="check_radio_payment_method(this.id)"
                      >
                        <img src="<?=path?>/assets/images/credit_icon.png" />
                        <span>Credit Card</span>
                      </button>
                      <button
                        class="btn btn_item"
                        name="payment_method"
                        id="encoderit_after_pay_transfer"
                        value="After Pay"
                        onclick="check_radio_payment_method(this.id)"
                      >
                        <img src="<?=path?>/assets/images/afterpay_icon.png" />
                        <span>AfterPay</span>
                      </button>
                    </div>
                    <div class="item d-flex-center">
                      <!-- <input
                        type="radio"
                        name="payment_method"
                        id="encoderit_stripe"
                        value="Credit Card"
                        onclick="check_radio_payment_method(this.id)"
                      />
                      <span>Credit Card</span> -->
                    </div>
                    <div class="item d-flex-center">
                      <!-- <input
                        type="radio"
                        name="payment_method"
                        id="encoderit_bank_transfer"
                        value="Bank Transfer"
                        onclick="check_radio_payment_method(this.id)"
                      />
                      <span>AfterPay</span> -->
                    </div>
                  </div>
                  <div class="paymet-area">
                    <div id="stripe_payment_div" style="display: none">
                      <div id="card-element"></div>
                      <div id="card-errors" role="alert"></div>
                    </div>
                  </div>
                  <div id="paypal-button-container" style="display: none"></div>
                  <div id="after_pay_container" style="display: none">
                  <button id="afterpay-button" class="btn btn-primary">
                    Afterpay it!
                  </button>
                 </div>
                  <div class="p_group">
                    <p>Payment Amount: <span id="payment_amount"></span></p>
                    <p>Booking Fee: <span id="booking_free"></span></p>
                    <p>Grand Total: <span id="grand_total"></span></p>
                  </div>
                  <div class="submit_btn" id="encoder_it_submit_btn_user_form">
                    <input
                      class="btn pay_btn"
                      type="submit"
                      name="btn"
                      value="Pay"
                    />
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </section>
    </main>

    <script>
      const ENCODER_IT_STRIPE_PK = "<?=ENCODER_IT_STRIPE_PK?>";
      let payment_method = "";
      let grand_price = 0;
      let after_pay_token='';
      const ajax_endpoints = "<?=path?>/form_submit.php";
      const after_pay_backend = "<?=path?>/after_pay.php";
    </script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=<?=ENCODER_IT_PAYPAL_CLIENT?>&currency=AUD&disable-funding=paylater"></script>
    <script src="<?=path?>/assets/js/stripe.js"></script>
    <script src="<?=path?>/assets/js/paypal.js"></script>
    <script src="<?=path?>/assets/js/afterPay.js"></script>
    <script src="<?=path?>/assets/js/scripts.js"></script>
  </body>
</html>
