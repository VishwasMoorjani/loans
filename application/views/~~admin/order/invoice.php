 <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/bootstrap.min.css" type="text/css" />
<?php $address = get_record_by_address($order->address);
  $user = get_record_by_user_id($order->user_id);
 $billing_address = json_decode($order->data);

$total_item_purchease=0;
foreach ($product as $key => $value) {
	$total_item_purchease += $value->cart_res->cart_qty; 
}
    //pr($billing_address);
 ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet" />
       <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/all.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>font/flaticon.css" type="text/css" />
   <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/style.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url() ?>assets/css/receiptstyle.css">
    <section class="content">
      <div class="container">
        <div class="">
          <div class="">
            <div class="box">
              <div class="box-header with-border">
                <div class="box-title"> Invoice No: #<?php echo $order->id; ?>
                </div> <a title="Print Order" href="javascript:" onclick="printBill()" id="print_btn" class="btn btn-md btn-default pull-right"><i class="fa fa-print"></i></a> 
              </div>
              <div class="box-body">
                                  <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Seller Information
                      </th>
                      <th>Shipping Address
                      </th>
                      <th>Billing Address
                      </th>
                    </tr> </thead> <tbody>
                    <tr>
                      <td>
                                                        <p>Uday</p>
    <p><b>GST NUMBER:08BWHPK9133J1Z5</b></p>
    <p><b>A-9SURAJPOLE MANDI,, JAIPUR, Jaipur, Rajasthan, 302003</p>
    <p><b>Contact Info:9636234000 </b></p>
                      </td>
<?php if($order->order_source!="mobile"){ ?>
    <td>
    <?php if($billing_address->sameasabove==1){ ?>
    <p><b>Customer Name :</b><?php echo $billing_address->shipping_name ?> </p>
    <p><b>Customer Mobile :</b><?php echo $billing_address->shipping_phone ?></p>
    <p><b>Customer Email :</b><?php echo $billing_address->payer_email ?></p>
      <p class="font-weight600"><b>Company name :</b> <?php echo $billing_address->shipping_company_name ?></p>
    <p class="font-weight600"><b>GST Number :</b> <?php echo $billing_address->shipping_gst_number ?></p>
  
    <p class="font-weight600"><b>Address :</b> <?php echo $billing_address->shipping_bulling_address ?></p>
    <!-- <p class="font-weight600"><b>LandMark. :</b> <?php echo $address->landmark ?></p> -->
    <p class="font-weight600"><b>Pin Code:</b><?php echo $billing_address->shipping_pincode ?></p>
  <?php }else { ?>
        <p><b>Customer Name :</b><?php echo $address->receiver_name ?> </p>
    <p><b>Customer Mobile :</b><?php echo $address->receiver_mobile ?></p>
    <p><b>Customer Email :</b><?php echo $billing_address->payer_email ?></p>
      <p class="font-weight600"><b>Company name :</b> <?php echo $address->company_name ?></p>
    <p class="font-weight600"><b>GST Number :</b> <?php echo $address->gst_number ?></p>
  
    <p class="font-weight600"><b>Address :</b> <?php echo $address->address ?></p>
    <!-- <p class="font-weight600"><b>LandMark. :</b> <?php echo $address->landmark ?></p> -->
    <p class="font-weight600"><b>Pin Code:</b><?php echo $address->zip ?></p>
  <?php } ?>  
    </td>

    <td>
    <p><b>Customer Name :</b><?php echo $billing_address->billing_address_name ?></p>
    <p><b>Customer Mobile :</b><?php echo $billing_address->billing_address_phone ?></p>
    <p><b>Customer Email :</b><?php echo $billing_address->payer_email ?></p>
      <p class="font-weight600"><b>Company name. :</b> <?php echo $billing_address->billing_address_company_name ?></p>
    <p class="font-weight600"><b>GST Number :</b> <?php echo $billing_address->billing_address_gst_number ?></p>
  
    <p class="font-weight600"><b>Address :</b> <?php echo $billing_address->billing_address_address ?></p>
    <!-- <p class="font-weight600"><b>LandMark. :</b> <?php echo $address->landmark ?></p> -->
  
    </td>
  <?php } else { ?>
         <td>
    <p><b>Customer Name :</b><?php echo $billing_address->shipping_name ?></p>
    <p><b>Customer Mobile :</b><?php echo $billing_address->shipping_phone ?></p>
    <p><b>Customer Email :</b><?php echo $user->email ?></p>
    <p class="font-weight600"><b>Company Name. :</b> <?php echo $billing_address->shipping_company_name ?></p>
    <p class="font-weight600"><b>GST Number :</b> <?php echo $billing_address->shipping_gst_number ?></p>
    
    <p class="font-weight600"><b>Address:</b> <?php echo $billing_address->shipping_bulling_address ?></p>
    <!-- <p class="font-weight600"><b>LandMark. :</b> <?php echo $address->landmark ?></p> -->
    <p class="font-weight600"><b>Pin Code:</b><?php echo $billing_address->shipping_pincode ?></p>
    </td>

    <td>
    <p><b>Customer Name :</b><?php echo $billing_address->billing_address_name ?></p>
    <p><b>Customer Mobile :</b><?php echo $billing_address->billing_address_phone ?></p>
    <p><b>Customer Email :</b><?php echo $user->email ?></p>
    <p class="font-weight600"><b>Company Name. :</b> <?php echo $billing_address->billing_address_company_name ?></p>
    <p class="font-weight600"><b>GST Number :</b> <?php echo $billing_address->billing_address_gst_number ?></p>
    
    <p class="font-weight600"><b>Address. :</b> <?php echo $billing_address->billing_address_address ?></p>
    <!-- <p class="font-weight600"><b>LandMark. :</b> <?php echo $address->landmark ?></p> -->
    <p class="font-weight600"><b>Pin Code:</b><?php echo $billing_address->billing_pincode ?></p>
    </td>
   <?php } ?> 
                    </tr> </tbody>
                  </table>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Order Summary
                          </th>
                          <th>
                          </th>
                          <th>
                          </th> <th>
                          </th> <th>
                          </th>
                        </tr></thead> <tbody>
                        <tr>
                          <td>
                            <p><b>Total Qty:</b> <?php  echo $total_item_purchease; ?></p>
                            <p></p>
                            <p><b>Order Total: <i class="fa fa-dollar"></i><?php echo $order->amount; ?></b></p>
                            <p><b>Payment Recieved:</b> <?php if($order->payment_method=="COD"){echo "No";}else{echo "Yes"; } ?></p>
                          </td>
                          <td>
                            <p><b>Payment Method: </b> <?php echo $order->payment_method; ?> </p>
                            <p><b>Transcation ID:</b> <b><i><?php echo $order->transection_id; ?></i></b></p>
                          </td>
                          <td><p><b>Delivery Date:</b> <?php echo $order->selectedDate; ?></p></td>
                                                  <td>
                          <p><b>Time:</b> <?php echo $order->selectedTime; ?></p>
                        </td>
                          <td>
                            <p><b>Order Date:</b> <?php echo date("d/m/Y g:i",strtotime($order->created_at)); ?></p>
                          </td>
                        </tr> </tbody>
                      </table>
                      <hr>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Order Details
                          </th>
                        </tr></thead>
                      </table>
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>S.No
                            </th>
                                <th>HSN</th>
                            <th>Product ID</th>
                        
                            <th>Item Name
                            </th>
                            <th>MRP</th>
                            <th>Price
                            </th>
                            <th>Qty
                            </th>
                     <!--        <th>Status
                            </th> -->
                           
                            <th>CGST
                            </th>
                            <th>SGST
                            </th> 
              
                            <th colspan="4">Total
                            </th>
                           
                          </tr> </thead> <tbody>
                                         <?php $i=1;$subtotal = 0; $myarray=array();$total_saveing =array();$gst_array = array(); $vsubt=0; foreach($product as $value){
                      //pr($value);  
                      $product_details = get_product_record_by_id($value->product_id);
                       $subtotal+=$value->amount ;
                       if($value->v_id!=0){
                        $varient_detail = get_purchase($value->v_id);
                       
                        $vsubt+=$value->var_price *$value->quantity;;
                       ?>
                          <tr>
                              <td> <?php echo $i; ?>
                              </td>
                              <td><?php echo $product_details->hsn ?></td>
                              <td><?php echo $product_details->custom_product_id; ?></td>
                            <td>
                              <div class="row">
                                <div class="col-md-2"> 
                                </div>
                                <div class="col-md-10"> <b><?php echo $product_details->product_name; ?><br> SIZE: <?php echo $varient_detail->size ?><br> COLOR:<?php echo $value->color ?></b> 
                                <br> <small class="mleft22"><a  href="<?php echo site_url() ?>admin/vendor/view/<?php echo $user->id ?>"><?php echo $user->shope_name; ?></a></small>
                                  <?php if($order->order_source!="mobile"){ ?>
                                <br> <small class="mleft22"><b>Priced: </b> <i class="fa fa-dollar"></i> <?php if(isset($value->var_pricevar_price)){  echo $value->var_price; }else{   echo  $value->var_price;  } ?></small>
                              <?php }else{ ?>
                                            <?php if(isset($value->mrp)){  echo $value->mrp; }else{   echo  $value->price;  } ?></small>
                                             <?php if(isset($value->price)){  echo $value->price; }else{   echo  $value->price;  } ?></small>
                              <?php } ?>  
                              
                              </div>
                            </div>
                          </td>
                          <td><?php echo $varient_detail->mrp ?></td>
                          <td><?php echo $value->amount ?></td>
                          <td><?php echo $value->qty ?></td>
                                                      <td><?php
                           // pr($value->cart_res->taxes_id);
                            $tax_record = get_tax_details($product_details->taxes_id);
                           // pr($tax_record);
                            //var_dump($tax_record);
                            if($tax_record->tax_type=="half"){

                              $devide = 50/100;
                            }else{
                                $devide = 70/100;
                            }
                            echo $tax_record->percent*$devide;echo"%";
                            echo "<br>";
                            $cal  =  ($tax_record->percent+100)/100;
                            $minus=$value->amount/$cal; 
                            $foo= ($value->amount-$minus);
                            $foo = $foo*$value->qty;
                           $foo =  $foo*$devide;
                           echo $sgst_amt =  number_format((float)$foo, 2, '.', '');
                            $cgst[] = number_format((float)$sgst_amt, 2, '.', '');
                           ?></td>

                          
                          <td><?php
                            if($tax_record->tax_type=="half"){

                              $devide = 50/100;
                            }else{
                               $devide = 30/100;
                            }
                            echo $tax_record->percent*$devide;echo"%";
                            echo "<br>";
                            $cal  =  ($tax_record->percent+100)/100;
                            $minus=$value->amount/$cal; 
                            $foo= ($value->amount-$minus);
                            $foo = $foo*$value->qty;
                           $foo =  $foo*$devide;
                           echo $sgst_amt =  number_format((float)$foo, 2, '.', '');
                           $sgst_array[] = number_format((float)$foo, 2, '.', '');
                           ?></td>
                        <td colspan="3"><?php echo $varient_detail->price* $value->qty ?><br>(Including  of GST )</td>
                      </tr>
                    <?php } else { ?>
                                                <tr>
                              <td> <?php echo $i; ?>
                              </td>
                              <td><?php echo $product_details->hsn ?></td>
                              <td><?php echo $product_details->custom_product_id; ?></td>
                            <td>
                               <b><?php echo $product_details->product_name; ?></b>  

                          </td>
                              <td><?php echo $product_details->mrp ?></td>
               <td> <?php if(isset($value->v_id) && $value->v_id!=0){   echo ($varient_detail->price);                       $ts = $product_details->mrp - $product_details->price;
                            $total_saveing[] = $value->qty * $ts;
                          }else{   echo  $value->amount; 
                                                 $ts = $product_details->mrp - $value->amount;
                            $total_saveing[] = $value->qty * $ts;
                           } 
      
                           ?></td>
                            <?php if($order->order_source!="mobile"){ ?>
                          <td> 
                            <?php  if(isset($value->qty->mValue)){echo $value->qty->mValue; }else{echo $value->quantity; } ?>
                          </td>
                        <?php } else{ ?>
                          <td> <?php echo $value->qty; ?></td>
                        <?php } ?>
             <!--              <td>
                            <span class="label label-default">Pending
                            </span>
                          </td> -->
                          <?php  /*<td>
                             <?php echo $value->cart_res->taxes_name; ?> <i class="fa fa-dollar"></i>
                           
                           
                          </td> */ ?>
                            <td><?php
                           // pr($value->cart_res->taxes_id);
                            $tax_record = get_tax_details($product_details->taxes_id);
                          //  pr($tax_record);
                            //var_dump($tax_record);
                            if($tax_record->tax_type=="half"){

                              $devide = 50/100;
                            }else{
                                $devide = 70/100;
                            }
                            echo $tax_record->percent*$devide;echo"%";
                            echo "<br>";
                            $cal  =  ($tax_record->percent+100)/100;
                            $minus=$value->amount/$cal; 
                            $foo= ($value->amount-$minus);
                            $foo = $foo*$value->qty;
                           $foo =  $foo*$devide;
                           echo $sgst_amt =  number_format((float)$foo, 2, '.', '');
                            $cgst[] = number_format((float)$sgst_amt, 2, '.', '');
                           ?></td>

                          
                          <td><?php
                            if($tax_record->tax_type=="half"){

                              $devide = 50/100;
                            }else{
                               $devide = 30/100;
                            }
                            echo $tax_record->percent*$devide;echo"%";
                            echo "<br>";
                            $cal  =  ($tax_record->percent+100)/100;
                            $minus=$value->amount/$cal; 
                            $foo= ($value->amount-$minus);
                            $foo = $foo*$value->qty;
                           $foo =  $foo*$devide;
                           echo $sgst_amt =  number_format((float)$foo, 2, '.', '');
                           $sgst_array[] = number_format((float)$foo, 2, '.', '');
                           ?></td>

                          <?php /* ?> <td><?php  $cal  =  ($tax_record->taxex_percent+100)/100;
                            $minus=$value->cart_res->price/$cal; 
                            $foo= ($value->cart_res->price-$minus);
                            $foo = $foo*$value->qty;
                           echo  number_format((float)$foo, 2, '.', '');
                            $gst_array[] = number_format((float)$foo, 2, '.', '');
                           ?></td><?php */ ?>

   
                            <td  colspan="3"> <?php echo $value->amount* $value->qty ?>
                            <br> <small>(Including  of GST )</small>
                          </td>
                   
                       
                      </tr>
                    <?php } ?>  
                    <?php $i++;} ?>
<tr>
                    <td>
                    </td>
                    <td>
                    </td>
                                        <td>
                    </td>
                                        <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td> 


                     <td>
                      <b>GST Total</b> 
                    </td>

                    <td><?php echo array_sum($cgst) ?></td>

                    <td>     
                      <?php echo array_sum($sgst_array); ?> 
                    </td>
                    <!-- <td>    <?php// echo array_sum($gst_array); ?>       </td> -->
                    <td colspan="3">
                     
                    </td>
                  </tr>
                  <tr>
                    <td>
                    </td>  <td>
                    </td>  <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>  <td>
                       <b>Subtotal</b>    
                    </td>  
                    <td>

                    </td>
                    <td></td>
                    <td>    </td>
                    <td>      </td>
                    <td>
                      <?php echo $subtotal; ?> 
                    </td>
                  </tr>
                  <tr>
                    <td>
                    </td><td>
                    </td><td>
                    </td><td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                       <b>Coupon Discount</b>
                    </td>
                     <td>
                    </td>
                    <td>
                    </td>
                    <td>

                    </td>

                    <td>
                      
                    </td> 
                     <td>
                      <b><i class="fa fa-dollar"></i><?php if($order->discount){echo $order->discount;}else{echo "0.00";} ?></b> 
                    </td>
                  </tr>
                  <tr>
  
                  <tr>                    
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                             <td></td>
                             <td><b>Shipping</b></td>
                             <td></td>
                             <td></td>
                             <td></td>
       <?php if($order->order_source!="mobile"){ ?>
                  <td>
                    </td>
                    <td ><b><?php echo $billing_address->derlivery_charge ?></b> 
                    </td>
        <?php } else { ?>
                    <td>
                    </td>
                    <td ><b><?php if($order->shipping){echo $order->shipping;}else{echo "0";} ?></b> 
                    </td>
        <?php } ?>            
                  </tr>
                  <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td> <td>
                    </td>
                     <td>
                    </td>
                    <td><b>Grand Total</b></td>
                    <td>
                    </td>
                                       <td>
                    </td>
                                       <td>
                    </td>
                    <td>
                      
                    </td>
                    <td>
                      <b><i class="fa fa-dollar"></i> <?php echo $order->amount; ?> </b>
                    </td>
                  </tr>
                                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>You saved in this deal</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo array_sum($total_saveing); ?></td>
                  </tr>
                   </tbody>
                </table>
                        <h4>Thank You For Shopping With Us</h4>
                        <h4><align"Right">Dcommercegrocery.com</h4>
                        <img src="http://dcommercegrocery.com/assets/admin/admin/056bc10aa4aa7f8e1a18657a1e12aa49.png" alt="logo.jpeg" style="height: 100px;">
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
<br>
<br>
              </div>
            </div>
          </div>
        </div>
      </div></section>

      <script type="text/javascript">
        function printBill() {
          $('#print_btn').hide();
          setTimeout(function(){  window.print(); }, 1000);
         
        }
      </script>