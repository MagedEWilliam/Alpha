<?php
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
require 'classes/paypal_init.php';

if ( ! session_id() ) @ session_start();

if (isset($_GET['success']) && $_GET['success'] == 'true') {


    $paymentId = $_GET['paymentId'];
    $payerId = $_GET['PayerID'];

    $payment = Payment::get($paymentId, $paypal);

    $exec = new PaymentExecution();
    $exec->setPayerId($payerId);
    $showmeta = false;

    if($showmeta){
        echo '<pre>';
// print_r( $payment );
        print_r( $payment->id );
        echo '<br>';
        print_r( uniqid(rand(), false) );
        echo '<br>';
        print_r( password_hash($payment->id, PASSWORD_DEFAULT) );
        echo '<br>';
        print_r( hash('sha512', $payment->id) );
        echo '<br>';
        print_r($_SESSION);
        echo '</pre>';
    }
    if($showmeta){
        print_r( $payment->getState() );
        print_r( $payment->getCart() );

        print_r( $payment->transactions[0]->amount->total );
        print_r( $payment->transactions[0]->amount->currency );

        print_r( $payment->id );
        print_r( hash('sha512', $payment->id) );
        print_r( $payment->intent );
        print_r( $payment->state );
        print_r( $payment->cart );
        print_r( $payment->payer->payment_method );
        print_r( $payment->payer->status );
        print_r( $payment->payer->payer_info->email );
        print_r( $payment->payer->payer_info->first_name );
        print_r( $payment->payer->payer_info->last_name );
        print_r( $payment->payer->payer_info->payer_id );
        print_r( $payment->payer->payer_info->shipping_address->recipient_name );
        print_r( $payment->payer->payer_info->shipping_address->line1 );
        print_r( $payment->payer->payer_info->shipping_address->city );
        print_r( $payment->payer->payer_info->shipping_address->state );
        print_r( $payment->payer->payer_info->shipping_address->postal_code );
        print_r( $payment->payer->payer_info->shipping_address->country_code );
        print_r( $payment->payer->payer_info->phone );
        print_r( $payment->payer->payer_info->country_code );
        echo '<br>';
        print_r( $payment->transactions[0]->amount->total );
        print_r( $payment->transactions[0]->amount->currency );
        print_r( $payment->transactions[0]->amount->details->subtotal );
        echo '<br>';
        print_r( $payment->transactions[0]->description );
        print_r( $payment->transactions[0]->invoice_number );

        print_r( $payment->transactions[0]->item_list->items );
        
        print_r( $payment->transactions[0]->item_list->shipping_address->recipient_name );
        print_r( $payment->transactions[0]->item_list->shipping_address->line1 );
        print_r( $payment->transactions[0]->item_list->shipping_address->city );
        print_r( $payment->transactions[0]->item_list->shipping_address->state );
        print_r( $payment->transactions[0]->item_list->shipping_address->postal_code );
        print_r( $payment->transactions[0]->item_list->shipping_address->country_code );
    }

    if (isset($_GET['order']) ) {
        try {
            $result = $payment->execute($exec, $paypal);
            print_r($result);

            require 'classes/class_stock.php';
            $stock = new Stock;
            for ($i=0; $i < count($payment->transactions[0]->item_list->items); $i++) { 
                $description = $payment->transactions[0]->item_list->items[$i]->description;
                $itemcode = str_replace('Item code: ', '', $description);

                $qun = $payment->transactions[0]->item_list->items[$i]->quantity;
                $stock->downUpdateQun($itemcode, $qun);
            }
            
            require 'classes/class_sendmail.php';

            $mailSender  = new MailSender;
            $htmlcontent = "<style>
            .ui.message{position:relative;min-height:1em;margin:1em 0;background:#F8F8F9;padding:1em 1.5em;line-height:1.4285em;color:rgba(0,0,0,.87);-webkit-transition:opacity .1s ease,color .1s ease,background .1s ease,box-shadow .1s ease;transition:opacity .1s ease,color .1s ease,background .1s ease,box-shadow .1s ease;border-radius:.28571429rem;box-shadow:0 0 0 1px rgba(34,36,38,.22) inset,0 0 0 0 transparent}.ui.message:first-child{margin-top:0}.ui.message:last-child{margin-bottom:0}
            .ui.success.message{background-color:#FCFFF5;color:#2C662D}.ui.attached.success.message,.ui.success.message{box-shadow:0 0 0 1px #A3C293 inset,0 0 0 0 transparent}.ui.success.message .header{color:#1A531B}
            
            </style>
            <div class='ui toowide success message'>Success, Order id is: ".$payment->id." <a class='ui green button' id='checkit' href=''>Check order status</a></div>";

            //$payment->payer->payer_info->email
            $mailSender->sendMail('Maged.EWilliam@gmail.com', 'Alpha Cart update1', $htmlcontent);
            

            echo "<div class='ui toowide success message'>Success, Order id is: ".$payment->id." <a class='ui green button' id='checkit' href=''>Check order status</a></div>";
            echo '<script>$("#checkit").attr("href",  $.query.set("order", "check") );</script>';

        } catch (Exception $e) {
            $showmeta = false;
            $data = json_decode($e->getData());
        // print_r($e->getData());

            require_once 'classes/class_order.php';
            $setorder = new setOrder;
            // $setorder->($_SESSION['id'], $_GET['token']);


            if( $_GET['order'] == 'new') {

                echo "<div class='ui toowide error message'>" . $data->message . "</div>";
            }elseif ( $_GET['order'] == 'check') {

                echo "<div class='ui toowide success message'>Order id is: ".$payment->id."</div>";
            }

        }
        if($showmeta){
            print_r( $payment->transactions[0]->related_resources[0]->sale->id);
            print_r( $payment->transactions[0]->related_resources[0]->sale->state);
            print_r( $payment->transactions[0]->related_resources[0]->sale->payment_mode);
            print_r( $payment->transactions[0]->related_resources[0]->sale->reason_code);
            print_r( $payment->transactions[0]->related_resources[0]->sale->protection_eligibility);
            print_r( $payment->transactions[0]->related_resources[0]->sale->transaction_fee->value);
            print_r( $payment->transactions[0]->related_resources[0]->sale->transaction_fee->currency);
            print_r( $payment->transactions[0]->related_resources[0]->sale->parent_payment);
            print_r( $payment->transactions[0]->related_resources[0]->sale->create_time);
            print_r( $payment->transactions[0]->related_resources[0]->sale->update_time);
            print_r( $payment->transactions[0]->related_resources[0]->sale->links[0]->href);
            print_r( $payment->transactions[0]->related_resources[0]->sale->links[0]->rel);
            print_r( $payment->transactions[0]->related_resources[0]->sale->links[0]->method);
            print_r( $payment->transactions[0]->related_resources[0]->sale->links[1]->href);
            print_r( $payment->transactions[0]->related_resources[0]->sale->links[1]->rel);
            print_r( $payment->transactions[0]->related_resources[0]->sale->links[1]->method);
            print_r( $payment->transactions[0]->related_resources[0]->sale->links[2]->href);
            print_r( $payment->transactions[0]->related_resources[0]->sale->links[2]->rel);
            print_r( $payment->transactions[0]->related_resources[0]->sale->links[2]->method);
            print_r( $payment->transactions[0]->related_resources[0]->sale->links[2]->method);

            print_r( $payment->transactions[0]->create_time );
            print_r( $payment->transactions[0]->links );
        }

    } else {

        if(isset($_SESSION['username']) ){
            echo '<div class="field"><a class="ui green big button" href="' . $_SERVER['REQUEST_URI'] . '&order=new"><i class="ui icon payment alternate"></i>Place Order</a></div></form>';
        }else{
            include"pages/parts/signup_part.php";
        }
    }
} else {

    echo "<div class='ui toowide warning message'>User Cancelled the Approval</div>";
}
?>