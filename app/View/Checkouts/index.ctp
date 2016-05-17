<?php
	echo $this->Form->create('Order', array('controller' => 'checkouts',
											'action' => 'conformOrder')); ?>
<div class="innercontentsection checkoutpage">
  <div class="container">
    <div class="content">
      <div id="accordion" class="Accordion checkout_acc" tabindex="0">
        <div class="panel panel-default">
          <div class="AccordionPanelTab" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
            <div class="row checkouttitletab">
              <div class="selecteddiv"><span class="ok-icon"></span></div>
              <div class="col-md-4 col-sm-4 titlediv fldiv">1. Login ID </div>
              <div class="col-md-4 col-sm-4 titlediv">
                  
                   <?php
                  // echo "<pre>";
                  // print_r($addresses);
                   
                if(!empty($addresses)){
                    $user_email = $addresses[0]["Customer"]["customer_email"];
                }else{
                    $user_email = "";
                }
                ?>
                  
                <p><?php echo $user_email; ?></p>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="text-right">
                  <button class="btn addbtn" type="submit">Change Login</button>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-collapse collapse in" id="collapse1">
            <div class="pad20 login_part">
                
               
                
              <p class="emailtext">Logged in as <a href="mailto:<?php echo $user_email; ?>"><?php echo $user_email; ?></a></p>
              <p class="textnote">Please note that upon clicking "Sign out" you will lose items in your cart and will be redirected to Chilcart home page.</p>
              <div class="inlinecontent">
                  <a class="btn signoutbut" href="<?php echo $siteUrl; ?>/customer/users/userLogout">Sign Out</a>
                <p class="signouttext">Continue with checkout</p>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="AccordionPanelTab" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
            <div class="row checkouttitletab">
              <div class="selecteddiv"><span class="ok-icon"></span></div>
              <div class="col-md-4 col-sm-4 titlediv fldiv">2. Delivery Address </div>
              <div class="col-md-4 col-sm-4 titlediv">
                <?php
                    if(!empty($def_addresses)){
                        $user_first_name = $def_addresses[0]["Customer"]["first_name"];
                        $user_last_name = $def_addresses[0]["Customer"]["last_name"];
                        $user_name = $user_first_name." ".$user_last_name;
                        
                        $user_phone = $def_addresses[0]["Customer"]["customer_phone"];
                        
                    }else{
                        $user_name = "";
                        $user_phone = "";
                    }
                ?>
                <h3><?php echo $user_name; ?><span><?php echo $user_phone; ?></span></h3>
                
                <?php
                
                if(!empty($def_addresses)){
                        $user_address_title = $def_addresses[0]["CustomerAddressBook"]["address_title"];
                        $user_address = $def_addresses[0]["CustomerAddressBook"]["address"];
                        $user_address_landmark = $def_addresses[0]["CustomerAddressBook"]["landmark"];
                        $user_address_city = $customerCity[1];
                        $user_address_state = $customerState[1];
                        
                        $final_address = $user_address_title.", ". $user_address.", ". $user_address_landmark." ". $user_address_city.", ". $user_address_state;
                        
                }
                else{
                    
                    $final_address = "";
                    
                }
                ?>
                
                <p><?php echo $final_address; ?> </p>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="text-right">
                  <button class="btn addbtn" type="submit">Change Address</button>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-collapse collapse" id="collapse2">
            <div class="clearfix addrbook padTB20">
                
               
                <?php foreach ($addresses as $keys => $values) {
									//echo "<pre>"; print_r($values);
									?>
									
									<div class="col-md-6 col-sm-6 addrbookbl" id="record<?php echo $values['CustomerAddressBook']['id'];?>">
										<label class="editAdrr <?php echo ($keys == 0) ? "active" : ''; ?>">

			        						<input type="radio" <?php if($keys == 0){echo "checked=\"checked\"";} ?> name="data[Order][delivery_id]" value="<?php echo $values['CustomerAddressBook']['id']; ?>" />	 
			        						
                                                                                       <div class="addrbg">
                  <h2><?php echo $values['CustomerAddressBook']['address_title']; ?></h2>
                  <div class="row">
				  
                   <?php
			        								   echo '<p>'.$values['CustomerAddressBook']['address'].' ,</p>'.
			        										'<p>'.$values['CustomerAddressBook']['landmark'].' ,</p>'.
			        										'<p>'.$customerArea[$values['CustomerAddressBook']['location_id']].' ,'.
			        											  $customerCity[$values['CustomerAddressBook']['city_id']].' ,</p>'.
			        										'<p>'.$state_list[$values['CustomerAddressBook']['state_id']].' - '.
			        											  $customerAreaCode[$values['CustomerAddressBook']['location_id']].'</p>';
			        							 ?>
                  </div>
                </div>
           <?php if($values['CustomerAddressBook']['def_add']) { $check = "checked=checked"; } else { $check = ''; } ?>                    
<div class="defaddr clearfix">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label class="checkbox-inline">
					  
						<input type="checkbox" class="allcheck" id="inlineCheckbox<?php  echo $values['CustomerAddressBook']['id']; ?>" value="option1" onclick="makeDefaultAdd(this,'<?php  echo $values['CustomerAddressBook']['id']; ?>')" <?php echo $check; ?>>
					  
                       <!-- <input type="checkbox" value="option1" id="inlineCheckbox1">-->
                        Default Address </label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                      <a href="javascript:void(0);" onclick="customerdelete(<?php echo $values['CustomerAddressBook']['id'];?>,'customeraddress')" style="color:white;"><p> Delete Address</p></a>
                    </div>
                  </div>
                </div>                                                                                       
                                                                                       
			        						
			        						<!-- <span class="edit_options">
			        							<a href="#"><i class="fa fa-pencil"></i></a>
			        							<a href="#"><i class="fa fa-times"></i></a>
			        						</span> -->
											
			        					
		        					</div>
		        					<?php } ?>
                
                
                
              
               
               
              
            </div>
              
              
            <div class="text-center padB20"> <a data-target="#demo-10" data-toggle="modal" href="javascript:void(0);" class="addbtn btn"><span class="addriconwt"></span>Add Address</a></div>
            
            
                    <div id="orderTypeCheck" class="contain clearfix"> <?php 
							foreach ($storeSlots as $keyss => $valuess) { 
                                                          //  echo "<pre>";
                                                           //print_r($valuess['timeslates']);
                                                          //  print_r($optionDays);
								?>
								<div class="store_slotes">
									<div class="row">
										<div class="col-md-12 text-center new_radio_button">
											<span class="switch_buton margin-b-20"> <?php

												$option1 = array('Collection' 	=> '');
												$option2 = array('Delivery' 	=> ''); 

												if ($valuess['delivery'] == 'Yes' && $valuess['collection'] == 'Yes') { ?>

												
													<label> <?php

			                                          	echo $this->Form->radio('order_type'.$valuess['store_id'],$option1,
		                                          							array('checked'=>$option1,
		                                          								'label'=>false,
		                                          								'legend'=>false,
		                                          								'name' => 'data[Order][timeSlot]['.$keyss.'][orderType]',
		                                          								'onclick'=>'slotStore('.$valuess['store_id'].')',
		                                          								'hiddenField'=>false)); ?>
		                                          								<span><?php echo __('Collection'); ?></span>
		                                            </label>
		                                            <label>  <?php 
			                                           	echo $this->Form->radio('order_type'.$valuess['store_id'],$option2,
			                                       							array('checked'=>$option2,
			                                       								'label'=>false,
			                                       								'legend'=>false,
			                                       								'name' => 'data[Order][timeSlot]['.$keyss.'][orderType]',
			                                       								'onclick'=>'slotStore('.$valuess['store_id'].')',
			                                       								'checked' => 'checked',
			                                       								'hiddenField'=>false)); ?>
			                                       								<span><?php echo __('Delivery'); ?></span>
					                                </label>
					                           

				                                <?php

				                            } elseif ($valuess['collection'] == 'Yes') { ?>
				                            	
					                            	<label> <?php

			                                          	echo $this->Form->radio('order_type'.$valuess['store_id'],$option1,
		                                          							array('checked'=>$option1,
		                                          								'label'=>false,
		                                          								'legend'=>false,
		                                          								'checked' => 'checked',
		                                          								'name' => 'data[Order][timeSlot]['.$keyss.'][orderType]',
		                                          								'onclick'=>'slotStore('.$valuess['store_id'].')',
		                                          								'hiddenField'=>false)); ?> 
		                                          								<span><?php echo __('Collection'); ?></span>
		                                            </label> <?php
		                                        } elseif ($valuess['delivery'] == 'Yes') { ?>

		                                        	<label>  <?php 
			                                           	echo $this->Form->radio('order_type'.$valuess['store_id'],$option2,
			                                       							array('checked'=>$option2,
			                                       								'label'=>false,
			                                       								'legend'=>false,
			                                       								'name' => 'data[Order][timeSlot]['.$keyss.'][orderType]',
			                                       								'onclick'=>'slotStore('.$valuess['store_id'].')',
			                                       								'checked' => 'checked',
			                                       								'hiddenField'=>false)); ?>  
			                                       								<span><?php echo __('Delivery'); ?></span>
					                                </label> 
					                           
					                            <?php
				                            } ?>
				                            
				                            </span>
										</div>
										<div class="col-md-6 new_radio_button">

											<div class="form-group clearfix">
												<label class="control-label col-md-12 text-left store_name"> <?php 
											echo $valuess['store_name']; ?> </label> 

											
			                                
												<div class="col-md-12"> <?php

													echo $this->Form->input('dateType',
																array('type'=>'select',
																		'id' => 'dateType'.$valuess['store_id'],
																 		'class'=>'form-control select_date',
																 		'name' => 'data[Order][timeSlot]['.$keyss.'][type]',
																 		'options'=> array($optionDays),
																 		'onchange' => 'slotStore('.$valuess['store_id'].')',
																 		'label'=> false)); ?>
												</div>
											</div>

										</div>
										<div class="col-md-6 new_radio_button">
											<div class="form-group clearfix">

												<div class="control-label col-md-12 text-left">
													<span id="orderType_<?php echo $valuess['store_id']; ?>"> <?php
														if ($valuess['delivery'] == 'Yes' && $valuess['collection'] == 'Yes') {
															//echo __('Delivery');
															echo 'Delivery';
														} elseif ($valuess['collection'] == 'Yes') {
															//echo __('Collection');
															echo 'Collection';
														} elseif ($valuess['delivery'] == 'Yes') { 
															//echo __('Delivery');
															echo 'Delivery';
														} ?>  
													</span> <?php echo __('Time'); ?>


												</div>

												<div class="col-md-12">
													<?php

														if (!empty($valuess['timeslates'])) {
															$setUp = array('type'=>'select',
																			'id' => 'timeslot'.$valuess['store_id'],
																	 		'class'=>'form-control deliveryCharge',
																	 		'options'=> array($valuess['timeslates']),
																	 		'name' => 'data[Order][timeSlot]['.$keyss.'][time]',
																	 		'empty' => __('Select Time'),
																	 		'label'=> false,
																	 		'div' => false);
														} else {
															$setUp = array('type'=>'select',
																			'id' => 'timeslot'.$valuess['store_id'],
																	 		'class'=>'form-control deliveryCharge date_slot',
																	 		'name' => 'data[Order][timeSlot]['.$keyss.'][time]',
																	 		'empty' => __('Select Time'),
																	 		'label'=> false,
																	 		'div' => false);
													} ?>

													

												<?php

													echo $this->Form->input('timeSlates',$setUp);

													echo $this->Form->input('stores',
																array('type' => 'hidden',
																	  'name' => 'data[Order][timeSlot]['.$keyss.'][store_id]',
																	  'value' => $valuess['store_id'])); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								 <?php
							} ?>


						</div>
            
            
            
            
          </div>
        </div>
        <div class="panel panel-default">
          <div class="AccordionPanelTab" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
            <div class="row checkouttitletab">
              <div class="selecteddiv"><span class="ok-icon"></span></div>
              <div class="col-md-12 titlediv fldiv">3. Order Summary <?php if($cartCount[0]["productCount"] != ""){ echo $cartCount[0]["productCount"]; } ?> items </div>
            </div>
          </div>
          <div class="panel-collapse collapse" id="collapse3">
            <div class="orderdetails">
              <div class="clearfix orderheading pad20 mobilehide">
                <div class="col-md-2 wrap15"></div>
                <div class="col-md-3">Item</div>
                <div class="col-md-1 wrap5">Qty</div>
                <div class="col-md-2 wrap15">Price</div>
               <div class="col-md-3">Delivery Details</div>
                <div class="col-md-2 wrap15">Subtotal </div>
              </div>
                
                
               <?php
                
               
               if(!empty($storeCart)){
                    foreach($storeCart as $key => $value){
                    
                  
                    
              ?> 
               
                 <div class="clearfix orderdet pad20 ">
                <div class="col-md-2 col-sm-2 wrap15">
                  <div class="imgdiv text-center">
                      <?php
                      $imageSrc = "https://dnrskjoxjtgst.cloudfront.net/stores/products/home/".$value["ShoppingCart"]["product_image"];
                      ?>
                      
                       <img style="max-height:150px;" src="<?php echo $imageSrc; ?>"  alt='<?php echo $value["ShoppingCart"]["product_name"]; ?>' title='<?php echo $value["ShoppingCart"]["product_name"]; ?>' onerror="this.onerror=null;this.src=<?php echo $siteUrl; ?>/images/no-imge.jpg" />
                      
                   </div>
                 </div>
                     
                 <div class="col-md-3 col-sm-10">
                  <div class="itemdiv">
                  
                    <p class="itemtitle"><?php echo $value["ShoppingCart"]["product_name"]; ?></p>
                    <div class="desktophide itembl">
                  <!--  <p><span class="tl">Qty :</span><span class="qtydiv"><?php echo  $value["ShoppingCart"]["product_quantity"]; ?></span></p>
                     <p><span class="tl">Price :</span><span class="rsdiv">Rs.<?php echo $value["ShoppingCart"]["product_total_price"]; ?></span></p>
                      <p><span class="tl">Delivery Detail :</span><span class="delivdet">by Wed, 27th Apr [FREE]</span></p> 
                       <p><span class="tl">Total Price :</span><span class="rsdiv">Rs. <?php echo $value["ShoppingCart"]["product_total_price"]; ?></span></p>-->
                    </div>
                    
                  </div>
                </div>
                     
                   <div class="col-md-1 wrap5 mobilehide">
                       
                       <?php
                       
                       $single_price = $value["ShoppingCart"]["product_total_price"]/$value["ShoppingCart"]["product_quantity"];
                       
                       ?>
                       
                  <p class="qtydiv"><?php echo  $value["ShoppingCart"]["product_quantity"]; ?></p>
                </div>
                <div class="col-md-2 wrap15 mobilehide">
                  <p class="rsdiv"><?php echo html_entity_decode($this->Number->currency($single_price, $siteCurrency)); ?></p>
                </div>
                <div class="col-md-3 mobilehide">
                    
                    
                    <div class="date_slot"><?php echo date("d-m-Y"); ?></div>
                    
             <!--     <p class="delivdet">by Wed, 27th Apr [FREE]</p> -->
                </div>
                <div class="col-md-2 wrap15 mobilehide">
                  <p class="rsdiv"><?php echo html_entity_decode($this->Number->currency($value["ShoppingCart"]["product_total_price"], $siteCurrency)); ?></p>
                </div>
                     
                     
                </div>
               
             <?php
                }
             }
                ?>
                
              <div class="pad20">
                <p class="alerttext">Send Order Confirmation SMS alert to <?php echo $user_phone; ?></p>
              </div>
              <div class="padLR20 padB20 clearfix">
                
                <div class="pull-right ordersum">
                  <p class="amountpay">Amount Payable:<?php echo html_entity_decode($this->Number->currency(round($total[0][0]["cartTotal"],2), $siteCurrency)); ?></p>
                </div>
                <div class="pull-left ordersum">
                  <button type="button" class="btn addbtn">Continue</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="AccordionPanelTab" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
            <div class="row checkouttitletab">
              <div class="selecteddiv"><span class="ok-icon"></span></div>
              <div class="col-md-12 titlediv fldiv">4. Payment Method </div>
            </div>
          </div>
          <div class="panel-collapse collapse" id="collapse4">
            <div class="paymethoddiv">
              <div class="clearfix">
                <div class="col-md-9 paymethodlistdiv as_fade_in">
                  <div id="TabbedPanels1" class="TabbedPanels clearfix">
                    <ul class="col-md-3 TabbedPanelsTabGroup">
                      <li class="TabbedPanelsTab" tabindex="0">
                        <div class="paytypetitle" data-toggle="tab" href="#cart1">Payment</div>
                      </li>
                      
                      
                    </ul>
                    <div class="col-md-9 TabbedPanelsContentGroup as_cart_parent">
                      <div id="cart1" class="tab-pane fade in">
                        <div class="carddetail card_details_sp">
                          
                             <div class="row">
                             <form>
                             <div class="col-md-12"><div class="cardDetailHead">Cash on delivery</div></div>
                             <div class="clearfix"></div>
                                 <div class="col-md-6">
                                   <fieldset>
                                       <input type="radio" name="data[Order][paymentMethod]" value="cod" id="cod" checked="checked">
                                       <label class="editpayment" for="cod">
                                       <img style="height:24px; vertical-align: middle;" alt="cod_icon" title="cod_icon" src="https://testing.chillcart.ie/frontend/images/cod_icon.png">

                                                                               <span class="editAdd ">Cash on delivery</span>
                                       </label>
                                   </fieldset>
                                   <div class="clearfix"></div>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="col-md-12"><div class="cardDetailHead">Saved Card Details</div></div>
                                 <div class="clearfix"></div>
								 <?php

									foreach ($stripeCards as $key => $card) { ?>
										<div class="col-md-6">
										   <fieldset>
										   <input type="radio" name="data[Order][paymentMethod]" value="<?php echo $card['StripeCustomer']['id']; ?>" id="<?php echo $card['StripeCustomer']['id']; ?>" />
											<label class="editpayment" for="<?php echo $card['StripeCustomer']['id']; ?>">
				        						
				        						<div class="card_info">
				        							<span class="editAdd contain truncate">
				        								<img style="height:24px; vertical-align: middle;" alt="cod_icon" title="cod_icon" src="<?php echo $siteUrl.'/	frontend/images/debit_card.png'; ?>">
				        								<?php echo $card['StripeCustomer']['customer_name']; ?>
				        							</span>
				        							<p class="margin-t-20">XXXX XXXX XXXX <?php echo $card['StripeCustomer']['card_number']; ?> </p>	        							
				        						</div>  
				        					</label>
											</fieldset>
				        				</div>
										<div class="clearfix"></div>
				        			<?php } ?>
								 <div class="col-md-12"><a class="addbtn btn" data-target="#demo-15" data-toggle="modal"><span class="cardiconwt"></span>Add Card</a>  </div>
								 
								 
                               </form>


                            </div>
                            


                            
                            

                            
                            
                        </div>
                     
                     
                     
                     
                      </div>
                      
                        
                        <?php
									echo $this->Form->input('order_description',
														array('class' => 'form-control address-customer-notes',
															  'placeholder' => __('Eg: Door bell is broken, please knock.'),
															  'label'=>false,
															  'rows' => 2)); ?>
                        
                    </div>
                  </div>
                </div>
                <div class="col-md-3 paymethodlistdiv">
                  <div class="amountdet">
                    <div class="clearfix totalamtext">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p>Total</p>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <p>Rs. <?php echo html_entity_decode($this->Number->currency(round($total[0][0]["cartTotal"],2), $siteCurrency)); ?></p>
                      </div>
                    </div>
                    <div class="clearfix totalamtext bgchange">
                      <p class="text-right">Amount Payable<span>Rs. <?php echo html_entity_decode($this->Number->currency(round($total[0][0]["cartTotal"],2), $siteCurrency)); ?></span></p>
                    </div>
                    <div class="clearfix pay_button text-center">
                        <button class="btn btn-primary" type="submit">Pay Now</button>
                    </div>
                    
                      <?php
	echo $this->Form->end(); ?>
                      
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--ADD ADDRESS-->

<div class="modal fade add_adress_parent" id="demo-10" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="css-popup" >
<div class="add-new-card-popup">
<div class="text-center mrgTB30">
                <h2 class="blgrtitle "><span class="blackborder">Add</span> <span class="greenborder">New Address</span></h2>
              </div>
              
              
              <div class="content-popup">
              
<?php echo $this->Form->create("CustomerAddressBook",
						array("id"=>'AddCustomerAddressBookCheckout',
							  "url"=>array("controller"=>'checkouts','action'=>'addAddressBook')));?>
  <div class="form-group">
    <label class="sr-only"><?php echo __('Address Title', true); ?></label>
	<?php echo $this->Form->input('address_title',array('class'=>'form-control','label'=>false,'placeholder' =>'Address Title')); ?>
    <!-- <input type="email" class="form-control" id="sr-only" placeholder="Address Title"> -->
  </div>
  <div class="form-group">
    <label class="sr-only"><?php echo __('Street Address', true); ?></label>
	<?php
											echo $this->Form->input('address',
													array('class'=>'form-control',
															'type' => 'text',
															'label'=>false,'placeholder' =>'Street Address')); ?>
    <!-- <input type="password" class="form-control" placeholder="Street Address"> -->
  </div>
  
  <div class="form-group">
    <label class="sr-only"><?php echo __('Landmark', true); ?></label>
	<?php
											echo $this->Form->input('landmark',
													array('class'=>'form-control',
															'label'=>false,'placeholder' =>'Landmark')); ?>
    <!-- <input type="password" class="form-control" placeholder="Landmark"> -->
  </div>
  <!-- <div class="form-group">
    <label class="sr-only">Country</label>
    <input type="text" class="form-control" placeholder="Country">
  </div> -->
  <div class="form-group">
    <label class="sr-only"><?php echo __('State', true); ?></label>
	<?php
											echo $this->Form->input('state_id',
												array('type'  => 'select',
													  'class' => 'form-control',
													  'options'=> array($state_list),
                                                      'onchange' => 'cityFillters();',
													  'empty' => __('Select State'),
									 				  'label'=> false,'placeholder' =>'State')); ?>
    <!-- <input type="password" class="form-control" placeholder="State"> -->
  </div>
  <div class="form-group">
    <label class="sr-only"><?php echo __('city', true); ?></label>
	<?php
											echo $this->Form->input('city_id',
												array('type'  => 'select',
													  'class' => 'form-control',
                                                      'onchange' => 'locationFillters();',
													  'empty' => __('Select City'),
									 				  'label'=> false,'placeholder' =>'City')); ?>
    <!-- <input type="password" class="form-control" placeholder="City"> -->
  </div>
  <div class="form-group">
    <label class="sr-only"><?php echo __('Area/zipcode', true); ?></label>
	<?php
										echo $this->Form->input('location_id',
												array('type'  => 'select',
													  'class' => 'form-control',
													  'empty' => __('Select Area/Zip'),
									 				  'label'=> false,'placeholder' =>'Pincode'));  ?>
    <!-- <input type="password" class="form-control" placeholder="Pincode"> -->
  </div>
 
  <div class="form-group">
		<label class="sr-only"><?php echo __('Address Phone', true); ?></label>
		<?php
						echo $this->Form->input('address_phone',
								array('class'=>'form-control',
									'id'=>'phone',
									'type'=>'text',
										'label'=>false,'placeholder'=>"Phone Number")); 
										echo $this->Form->input('status',
							                            array('class' => 'form-control',
							                            	  'type' => 'hidden',
							                                  'label' => false,
							                                  'value' => 1));?>
		<!-- <input type="password" class="form-control" placeholder="Phone Number"> -->
		</div>
  <?php echo $this->Form->button(__('Submit'),
									array("label"=>false,
											"class"=>"btn btn-primary",
											'onclick' => 'return addAddressCheckCheckout();',
											"type"=>'submit')); 
		 ?>
  <!-- <button type="submit" class="btn addbtn mrgTB20">Submit</button> -->
<?php echo $this->Form->end(); ?>
              </div>

</div>

</div>
    </div>
  </div>
</div>



<!----Add Card--->
<div class="modal fade add_adress_parent" id="demo-15" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="css-popup">
<div class="add-new-card-popup">
<div class="text-center mrgTB30">
                <h2 class="blgrtitle "><span class="blackborder">Add</span> <span class="greenborder">New Card</span></h2>
              </div>
              
              
              <div class="content-popup">
              
             
                  <?php
				echo $this->Form->create('User',
								array('class'  => 'form-horizontal paymentTab',
										'name' => 'StripeForm',
										"url"=> array("controller" => 'checkouts',
                                  					 'action' 	   => 'customerCardAdd'))); ?>
				
				<div class="text-center">
					<label id="error" class="margin-b-15"></label>
				</div>

				<div class="form-group clearfix">
					<label class="control-label col-md-4"><?php echo __('Name on Card', true); ?><span class="star">*</span> :</label>
					<div class="col-md-7">
						<?php
							echo $this->Form->input("Card.Name",
									array("type"=>"text",
											"label"=>false,
											'data-stripe' => 'name',
											"class"=>"form-control",
											'value' => '')); 
						?>
                                            
                                            
                                            <?php 
					echo $this->Form->input('stores',
									array('type' => 'hidden',
										  'id' => 'checkout',
										  'value' => 'checkout')); ?>
                                            
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label col-md-4"><?php echo __('Card Number', true); ?><span class="star">*</span>
						<span class="payment-cart-icons"></span> :
					</label>
					<div class="col-md-7">
						<div class="input-group cc merged input-group-card-number">
							<span class="input-group-addon lock"><i class="fa fa-lock"></i></span> <?php 
								echo $this->Form->input("Card.number",
										array("type"=>"text",
												"label"=>false,
												'data-stripe' => 'number',
												"class"=>"form-control intnumber",
												'height' => 40,
												'value' => '',
												'maxlength' => 16,
												'placeholder' => 'XXXX-XXXX-XXXX-XXXX')); ?>
							<span class="input-group-addon input-group-valid"><i class="fa fa-check"></i></span>
							<span class="input-group-addon input-group-card-icon"><i class="fa fa-credit-card"></i></span>
						</div>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label col-md-4"><?php echo __('CVV', true); ?><span class="star">*</span>
						<img src="<?php echo $siteUrl; ?>/frontend/images/cvv.gif" class="cvv"> :
					</label>
					<div class="col-md-4">
						<div class="input-group cc merged input-group-card-number">
							<span class="input-group-addon lock"><i class="fa fa-lock"></i></span> 
								<?php 
									echo $this->Form->input("Card.cvv",	
										array("type"=>"password",
												"label"=>false,
												'data-stripe' => 'cvc',
												"class"=>"form-control",
												'value' => '')); 
								?>
						</div>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label col-md-4"><?php echo __('Expiry Date', true); ?><span class="star">*</span> : </label>
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-6">
								<?php
									$month  = array("1"=>"Jan",  "2"=>"Feb", "3"=>"Mar",
													"4"=>"Apr","5"=>"May", "6"=>'Jun',
													"7"=>"Jul", "8"=>"Aug", "9"=>"Sep",
													"10"=>"Oct", "11"=>"Nov", "12"=>"Dec");
									echo $this->Form->input("Card.expmonth",
												array("type"=>"select",
														"label"=>false,
														"options"=>$month,
														'data-stripe' => 'exp-month',
														"class"=>"form-control valid")); 
								?>
							</div>
							<div class="col-md-6">
								<?php
									$curyear    = date("Y");
									$endyear    = $curyear+20;
									$years  = array();
									for($i=$curyear;$i<=$endyear;$i++){
										
										$years[$i]=$i;
												
									}
									echo $this->Form->input("Card.expyear",
											array("type"=>"select",
													"label"=>false,
													"options"=>$years,
													'data-stripe' => 'exp-year',
													"class"=>"form-control valid"));
								?>
							</div>
						</div>

					</div>
				</div>

				
				<div class="form-group clearfix">						
					<div class="col-md-8 col-md-offset-4 paymentInfo">
						<?php echo __('The card will automatically be stored in your customer profile so that you can check out faster next time.', true); ?>
					</div>
				</div>
				<div class="form-group clearfix margin-t-25">						
					<div class="col-md-8 col-md-offset-4">
						<?php 
							echo $this->Form->button(__('Submit'),
								array("label"=>false,
										"id"=>"stripebtn",
										"class"=>"btn btn-primary",
										'onclick' => 'return saveCard();',
										"type"=>'submit')); 
						?>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
                  
              
              </div>

</div>

</div>
    </div>
  </div>
</div>



<script type="text/javascript">

function slotStore (id) {
	var type = $('#dateType'+id).val();
	var orderTypeVal = ($('#OrderOrderType'+id+'Collection').prop("checked")) ? 'Collection' : 'Delivery';

	var orderType = ($('#OrderOrderType'+id+'Collection').prop("checked")) ? '<?php echo __("Collection"); ?>' : '<?php echo __("Delivery"); ?>';
	$('#orderType_'+id).html(orderType);

	$.post(rp+'checkouts/storeTimeSlot',{'id':id, 'type': type, 'orderType': orderTypeVal}, function(response) {
		$('#timeslot'+id).html(response);
	});
        
         var date_data = new Date();
        var datedata = "";
        if($("select.select_date").val() == "Today"){
           
           datedata = date_data.getDate() + "-" + date_data.getMonth() + "-" + date_data.getFullYear();
        }
        else{
             
            var newdate = new Date(date_data);

            newdate.setDate(newdate.getDate() + 1);

            var dd = newdate.getDate();
            var mm = newdate.getMonth() + 1;
            var y = newdate.getFullYear();

            var datedata = dd + '-' + mm + '-' + y;

        }
        
        $("div.date_slot").empty();
        $("div.date_slot").append(datedata);
        
}

</script>

<?php echo $this->element('frontend/footer'); ?>

<?php /*<div class="container searchshopContent shopcheckout"> <?php
	echo $this->Form->create('Order', array('controller' => 'checkouts',
											'action' => 'conformOrder')); ?>
		<div class="checkout-tabs-bar-block col-md-2">
			<a id="deliverAddress_tab" class="checkout-tabs active">
				<div class="checkout-tabs-icon address"></div>
				<div class="checkout-tabs-text"> <?php echo __('Address', true); ?></div>
			</a>
			<a id="payment_tab" class="checkout-tabs">
				<div class="checkout-tabs-icon payment"></div>
				<div class="checkout-tabs-text"><?php echo __('Payment', true); ?></div>
			</a>
			<a id="reviewConform_tab" class="checkout-tabs">
				<div class="checkout-tabs-icon review"></div>
				<div class="checkout-tabs-text"><?php echo __('Review &amp; Confirm', true); ?></div>
			</a>
		</div>
		<div class="addessBox col-md-10">
			<div id="deliverAddress" class="addessBox col-md-12 col-xs-12">
				<div class="panel panel-default">
				<?php echo __('Review & Confirm');
					echo $this->Form->input('stores',
									array('type' => 'hidden',
										  'id' => 'checkout',
										  'value' => 'checkout')); ?>
					<div class="panel-body addressBg">
						<div class="panel-subheading">
							<h3 class="clearfix">
								<span class="pull-left"><?php echo __('Delivery Address', true); ?></span>
								<span class="pull-right">
									<a class="addnewAdrr" data-toggle="modal" data-target="#addDeliverAddress" href="javascript:void(0);">
										<i class="fa fa-plus"></i>
									</a>
								</span>
							</h3>
							<div id="locationError"></div>
							<div class="checkoutWrapper clearfix"> 
								<div class="row">
									<?php foreach ($addresses as $keys => $values) {
									//echo "<pre>"; print_r($values);
									?>
									
									<div class="col-md-6 col-sm-6">
										<label class="editAdrr <?php echo ($keys == 0) ? "active" : ''; ?>">

			        						<input type="radio" <?php if($keys == 0){echo "checked=\"checked\"";} ?> name="data[Order][delivery_id]" value="<?php echo $values['CustomerAddressBook']['id']; ?>" />	 
			        						<address>
			        							<p class="font-new color_new"> <?php echo $values['CustomerAddressBook']['address_title']; ?></p> <?php
			        								   echo '<p>'.$values['CustomerAddressBook']['address'].' ,'.
			        										'<p>'.$values['CustomerAddressBook']['landmark'].' ,</p>'.
			        										'<p>'.$customerArea[$values['CustomerAddressBook']['location_id']].' ,'.
			        											  $customerCity[$values['CustomerAddressBook']['city_id']].' ,</p>'.
			        										'<p>'.$customerState[$values['CustomerAddressBook']['state_id']].' - '.
			        											  $customerAreaCode[$values['CustomerAddressBook']['location_id']].'</p>';
			        							 ?>

			        						</address>
			        						<!-- <span class="edit_options">
			        							<a href="#"><i class="fa fa-pencil"></i></a>
			        							<a href="#"><i class="fa fa-times"></i></a>
			        						</span> -->
											
			        					</label>
		        					</div>
		        					<?php } ?>
		        				</div>							
							</div>
						</div>
						<div class="store_slotes">
							<div class="form-group clearfix">
								<label class="control-label col-md-12 text-left" for="customerNotes">
									<?php echo __('Any instructions for delivery (optional)') ; ?></label>
								<div class="col-md-12"> <?php
									echo $this->Form->input('order_description',
														array('class' => 'form-control address-customer-notes',
															  'placeholder' => __('Eg: Door bell is broken, please knock.'),
															  'label'=>false,
															  'rows' => 2)); ?>
								</div>
							</div>
						</div>
						<div id="orderTypeCheck" class="contain clearfix"> <?php 
							foreach ($storeSlots as $keyss => $valuess) { 
								//echo "<pre>"; print_r($valuess);
								?>
								<div class="store_slotes">
									<div class="row">
										<div class="col-md-12 text-center">
											<span class="switch_buton margin-b-20"> <?php

												$option1 = array('Collection' 	=> '');
												$option2 = array('Delivery' 	=> ''); 

												if ($valuess['delivery'] == 'Yes' && $valuess['collection'] == 'Yes') { ?>

												
													<label> <?php

			                                          	echo $this->Form->radio('order_type'.$valuess['store_id'],$option1,
		                                          							array('checked'=>$option1,
		                                          								'label'=>false,
		                                          								'legend'=>false,
		                                          								'name' => 'data[Order][timeSlot]['.$keyss.'][orderType]',
		                                          								'onclick'=>'slotStore('.$valuess['store_id'].')',
		                                          								'hiddenField'=>false)); ?>
		                                          								<span><?php echo __('Collection'); ?></span>
		                                            </label>
		                                            <label>  <?php 
			                                           	echo $this->Form->radio('order_type'.$valuess['store_id'],$option2,
			                                       							array('checked'=>$option2,
			                                       								'label'=>false,
			                                       								'legend'=>false,
			                                       								'name' => 'data[Order][timeSlot]['.$keyss.'][orderType]',
			                                       								'onclick'=>'slotStore('.$valuess['store_id'].')',
			                                       								'checked' => 'checked',
			                                       								'hiddenField'=>false)); ?>
			                                       								<span><?php echo __('Delivery'); ?></span>
					                                </label>
					                           

				                                <?php

				                            } elseif ($valuess['collection'] == 'Yes') { ?>
				                            	
					                            	<label> <?php

			                                          	echo $this->Form->radio('order_type'.$valuess['store_id'],$option1,
		                                          							array('checked'=>$option1,
		                                          								'label'=>false,
		                                          								'legend'=>false,
		                                          								'checked' => 'checked',
		                                          								'name' => 'data[Order][timeSlot]['.$keyss.'][orderType]',
		                                          								'onclick'=>'slotStore('.$valuess['store_id'].')',
		                                          								'hiddenField'=>false)); ?> 
		                                          								<span><?php echo __('Collection'); ?></span>
		                                            </label> <?php
		                                        } elseif ($valuess['delivery'] == 'Yes') { ?>

		                                        	<label>  <?php 
			                                           	echo $this->Form->radio('order_type'.$valuess['store_id'],$option2,
			                                       							array('checked'=>$option2,
			                                       								'label'=>false,
			                                       								'legend'=>false,
			                                       								'name' => 'data[Order][timeSlot]['.$keyss.'][orderType]',
			                                       								'onclick'=>'slotStore('.$valuess['store_id'].')',
			                                       								'checked' => 'checked',
			                                       								'hiddenField'=>false)); ?>  
			                                       								<span><?php echo __('Delivery'); ?></span>
					                                </label> 
					                           
					                            <?php
				                            } ?>
				                            
				                            </span>
										</div>
										<div class="col-md-6">

											<div class="form-group clearfix">
												<label class="control-label col-md-12 text-left store_name"> <?php 
											echo $valuess['store_name']; ?> </label> 

											
			                                
												<div class="col-md-12"> <?php

													echo $this->Form->input('dateType',
																array('type'=>'select',
																		'id' => 'dateType'.$valuess['store_id'],
																 		'class'=>'form-control',
																 		'name' => 'data[Order][timeSlot]['.$keyss.'][type]',
																 		'options'=> array($optionDays),
																 		'onchange' => 'slotStore('.$valuess['store_id'].')',
																 		'label'=> false)); ?>
												</div>
											</div>

										</div>
										<div class="col-md-6">
											<div class="form-group clearfix">

												<div class="control-label col-md-12 text-left">
													<span id="orderType_<?php echo $valuess['store_id']; ?>"> <?php
														if ($valuess['delivery'] == 'Yes' && $valuess['collection'] == 'Yes') {
															//echo __('Delivery');
															echo 'Delivery';
														} elseif ($valuess['collection'] == 'Yes') {
															//echo __('Collection');
															echo 'Collection';
														} elseif ($valuess['delivery'] == 'Yes') { 
															//echo __('Delivery');
															echo 'Delivery';
														} ?>  
													</span> <?php echo __('Time'); ?>


												</div>

												<div class="col-md-12">
													<?php

														if (!empty($valuess['timeslates'])) {
															$setUp = array('type'=>'select',
																			'id' => 'timeslot'.$valuess['store_id'],
																	 		'class'=>'form-control deliveryCharge',
																	 		'options'=> array($valuess['timeslates']),
																	 		'name' => 'data[Order][timeSlot]['.$keyss.'][time]',
																	 		'empty' => __('Select Time'),
																	 		'label'=> false,
																	 		'div' => false);
														} else {
															$setUp = array('type'=>'select',
																			'id' => 'timeslot'.$valuess['store_id'],
																	 		'class'=>'form-control deliveryCharge',
																	 		'name' => 'data[Order][timeSlot]['.$keyss.'][time]',
																	 		'empty' => __('Select Time'),
																	 		'label'=> false,
																	 		'div' => false);
													} ?>

													

												<?php

													echo $this->Form->input('timeSlates',$setUp);

													echo $this->Form->input('stores',
																array('type' => 'hidden',
																	  'name' => 'data[Order][timeSlot]['.$keyss.'][store_id]',
																	  'value' => $valuess['store_id'])); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								 <?php
							} ?>


						</div>	
						<div class="checkout-bottom checkoutbtm">
							<a onclick="checkoutpagintaion('#deliverAddress','#payment');" class="btn btn-primary pull-right">Continue</a>
							<a class="btn btn-default pull-left" href="<?php echo $siteUrl.'/shop/'.$valuess['seo_url'].'/'.$valuess['store_id']; ?>"><?php echo __('Back to Store', true); ?></a>
						</div>
					</div>
				</div>
			</div>
			<div id="payment" class="addessBox col-md-12 col-xs-12" style="display:none;">
				<div class="panel panel-default">
					<div class="panel-body addressBg">
						<div class="panel-subheading">
						<h3 class="clearfix">
								<span class="pull-left"><?php echo __('Payment Details', true); ?> </span>								
							</h3>
							<div class="paymentWrapper clearfix">
								<div class="row">
									<div class="col-md-12"><div class="cardDetailHead"><?php echo __('Cash on delivery', true); ?></div></div>
									<div class="col-md-4">
										<label class="editpayment active">
											<img style="height:24px;" alt="cod_icon" title="cod_icon" src="<?php echo $siteUrl.'/frontend/images/cod_icon.png'; ?>">
			        						<input type="radio" name="data[Order][paymentMethod]" value="cod" checked = "checked"/>
											<span class="editAdd "><?php echo __('Cash on delivery', true); ?></span>
			        					</label> 
			        				</div>
			        			</div>
								<div class="row">								

			        				<div class="col-md-12">
			        					<div class="cardDetailHead"><?php echo __('Saved Card Details', true); ?>
			        					<span class="pull-right">
											<a class="addnewAdrr" data-toggle="modal" data-target="#addpayment" href="javascript:void(0);">
												<i class="fa fa-plus"></i> &nbsp;<?php echo __('Add Card', true); ?>
											</a>
										</span>
			        					</div>
			        					
			        				</div>
			        				<?php

									foreach ($stripeCards as $key => $card) { ?>
										<div class="col-md-4 col-xs-12">
											<label class="editpayment">
				        						<input type="radio" name="data[Order][paymentMethod]" value="<?php echo $card['StripeCustomer']['id']; ?>" />
				        						<div class="card_info">
				        							<span class="editAdd contain truncate">
				        								<img style="height:24px;" alt="cod_icon" title="cod_icon" src="<?php echo $siteUrl.'/	frontend/images/debit_card.png'; ?>">
				        								<?php echo $card['StripeCustomer']['customer_name']; ?>
				        							</span>
				        							<p class="margin-t-20">XXXX XXXX XXXX <?php echo $card['StripeCustomer']['card_number']; ?> </p>	        							
				        						</div>  
				        					</label>
				        				</div>
				        			<?php } ?>
								</div>

								
							</div>	
						</div>

						<div class="checkout-bottom checkoutbtm">
							<a onclick="checkoutpagintaion('#payment','#reviewConform');" class="btn btn-primary pull-right"><?php echo __('Continue', true); ?></a>
							<a onclick="checkoutpagintaion('#payment','#deliverAddress');" class="btn btn-default pull-left"><?php echo __('Back to Address', true); ?></a>
						</div>
					</div>
				</div>
			</div>
			<div id="reviewConform" class="addessBox col-xs-12 col-md-12" style="display:none;">
				
			</div>
		</div> <?php
	echo $this->Form->end(); ?>
</div>


<div class="modal fade" id="addDeliverAddress">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title"> 
					<?php echo __('Add New Deliver Address'); ?></h4>
			</div> <?php
			echo $this->Form->create("CustomerAddressBook",
                                  array("id"=>'AddCustomerAddressBook',
                                  		"url"=>array("controller"=>'checkouts',
                                  		'action' => 'customerBookAdd'))); ?>
				<div class="modal-body"> 
					<label  class="error checkAdderorr"></label>
					<div class="form-group clearfix">
						<label class="control-label col-md-4"><?php echo __('Address Title', true); ?></label>
						<div class="col-md-8"> <?php
							echo $this->Form->input('address_title',
									array('class'=>'form-control',
											'label'=>false,
											'value' => '')); ?>
						</div>
					</div>
					<div class="form-group clearfix">
						<label class="control-label col-md-4"><?php echo __('Street Address', true); ?></label>
						<div class="col-md-8"> <?php
							echo $this->Form->input('address',
									array('class'=>'form-control',
											'label'=>false,
											'type' => 'text',
											'value' => '')); ?>
						</div>
					</div>
					<div class="form-group clearfix">
						<label class="control-label col-md-4"><?php echo __('Address Phone', true); ?></label>
						<div class="col-md-8"> <?php
							echo $this->Form->input('address_phone',
									array('class'=>'form-control',
											'label'=>false,
											'value' => '')); ?>
						</div>
					</div>
					<div class="form-group clearfix">
						<label class="control-label col-md-4"><?php echo __('Apt/Suite/Building', true); ?></label>
						<div class="col-md-8"> <?php
							echo $this->Form->input('landmark',
									array('class'=>'form-control',
											'label'=>false,
											'value' => '')); ?>
						</div>
					</div>
				
                    <div class="form-group clearfix">
						<label class="control-label col-md-4"><?php echo __('State', true); ?></label>
						<div class="col-md-8"> <?php
							echo $this->Form->input('state_id',
								array('type'  => 'select',
									  'class' => 'form-control',
									  'options'=> array($customerState),
                                      'onchange' => 'citiesList();',
									  'empty' => __('Select State'),
					 				  'label'=> false,
					 				  'value' => '')); ?>
						</div>
					</div>
                    <div class="form-group clearfix">
						<label class="control-label col-md-4"><?php echo __('city', true); ?></label>
						<div class="col-md-8"> <?php
							echo $this->Form->input('city_id',
								array('type'  => 'select',
									  'class' => 'form-control',
                                      'onchange' => 'locationLists();',
									  'empty' => __('Select City'),
					 				  'label'=> false)); ?>
						</div>
					</div>
                    <div class="form-group clearfix">
						<label class="control-label col-md-4"><?php echo __('Area/zipcode', true); ?></label>
						<div class="col-md-8"> <?php
							echo $this->Form->input('location_id',
									array('type'  => 'select',
										  'class' => 'form-control',
										  'empty' => __('Select Location'),
						 				  'label'=> false));  ?>
						</div>
					</div>
					<div class="form-group clearfix">
						<div class="col-md-8 col-md-offset-4 signup-footer"> <?php 
							echo $this->Form->button(__('Submit'),
									array("label"=>false,
											"class"=>"btn btn-primary",
											'onclick' => 'return addAddressCheck();',
											"type"=>'submit')); ?>
						</div>
					</div>
				</div> <?php
			echo $this->Form->end(); ?>
		</div>
	</div>
</div>
<div class="modal fade" id="addpayment">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title"><?php echo __('Add New Payment', true); ?></h4>
			</div>
			<div class="modal-body"> <?php
				echo $this->Form->create('User',
								array('class'  => 'form-horizontal paymentTab',
										'name' => 'StripeForm',
										"url"=> array("controller" => 'checkouts',
                                  					 'action' 	   => 'customerCardAdd'))); ?>
				
				<div class="text-center">
					<label id="error" class="margin-b-15"></label>
				</div>

				<div class="form-group clearfix">
					<label class="control-label col-md-4"><?php echo __('Name on Card', true); ?><span class="star">*</span> :</label>
					<div class="col-md-7">
						<?php
							echo $this->Form->input("Card.Name",
									array("type"=>"text",
											"label"=>false,
											'data-stripe' => 'name',
											"class"=>"form-control",
											'value' => '')); 
						?>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label col-md-4"><?php echo __('Card Number', true); ?><span class="star">*</span>
						<span class="payment-cart-icons"></span> :
					</label>
					<div class="col-md-7">
						<div class="input-group cc merged input-group-card-number">
							<span class="input-group-addon lock"><i class="fa fa-lock"></i></span> <?php 
								echo $this->Form->input("Card.number",
										array("type"=>"text",
												"label"=>false,
												'data-stripe' => 'number',
												"class"=>"form-control intnumber",
												'height' => 40,
												'value' => '',
												'maxlength' => 16,
												'placeholder' => 'XXXX-XXXX-XXXX-XXXX')); ?>
							<span class="input-group-addon input-group-valid"><i class="fa fa-check"></i></span>
							<span class="input-group-addon input-group-card-icon"><i class="fa fa-credit-card"></i></span>
						</div>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label col-md-4"><?php echo __('CVV', true); ?><span class="star">*</span>
						<img src="<?php echo $siteUrl; ?>/frontend/images/cvv.gif" class="cvv"> :
					</label>
					<div class="col-md-4">
						<div class="input-group cc merged input-group-card-number">
							<span class="input-group-addon lock"><i class="fa fa-lock"></i></span> 
								<?php 
									echo $this->Form->input("Card.cvv",	
										array("type"=>"password",
												"label"=>false,
												'data-stripe' => 'cvc',
												"class"=>"form-control",
												'value' => '')); 
								?>
						</div>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label col-md-4"><?php echo __('Expiry Date', true); ?><span class="star">*</span> : </label>
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-6">
								<?php
									$month  = array("1"=>"Jan",  "2"=>"Feb", "3"=>"Mar",
													"4"=>"Apr","5"=>"May", "6"=>'Jun',
													"7"=>"Jul", "8"=>"Aug", "9"=>"Sep",
													"10"=>"Oct", "11"=>"Nov", "12"=>"Dec");
									echo $this->Form->input("Card.expmonth",
												array("type"=>"select",
														"label"=>false,
														"options"=>$month,
														'data-stripe' => 'exp-month',
														"class"=>"form-control valid")); 
								?>
							</div>
							<div class="col-md-6">
								<?php
									$curyear    = date("Y");
									$endyear    = $curyear+20;
									$years  = array();
									for($i=$curyear;$i<=$endyear;$i++){
										
										$years[$i]=$i;
												
									}
									echo $this->Form->input("Card.expyear",
											array("type"=>"select",
													"label"=>false,
													"options"=>$years,
													'data-stripe' => 'exp-year',
													"class"=>"form-control valid"));
								?>
							</div>
						</div>

					</div>
				</div>

				
				<div class="form-group clearfix">						
					<div class="col-md-8 col-md-offset-4 paymentInfo">
						<?php echo __('The card will automatically be stored in your customer profile so that you can check out faster next time.', true); ?>
					</div>
				</div>
				<div class="form-group clearfix margin-t-25">						
					<div class="col-md-8 col-md-offset-4">
						<?php 
							echo $this->Form->button(__('Submit'),
								array("label"=>false,
										"id"=>"stripebtn",
										"class"=>"btn btn-primary",
										'onclick' => 'return saveCard();',
										"type"=>'submit')); 
						?>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

//Checkout Page Hide and Show Process
function checkoutpagintaion(page1,page2){
	
	var id = '';
	var orderTypeCheck = '';
	var error = locationError = 0;
	$('.error').remove();
	
	$('#locationError').html('');

	var address = $('input[name="data[Order][delivery_id]"]:checked').val();

	if (page1 == '#deliverAddress') {

		$(".deliveryCharge").each(function() {
			if($(this).val() == "") {
	    		$(this).after("<label class='error'> <?php echo __('Please select time'); ?></label>");
	    		error = 1;
	    	} else {
	    		id += $(this).val()+',';
	    	}
		});
		
		$("#orderTypeCheck input[type='radio']:checked").each(function() {
			orderTypeCheck += $(this).val()+','; 
		});
	}

	if (error != 1 ) {

		if (page1 == '#deliverAddress') {

			orderTypeChecks = orderTypeCheck.substr(0, orderTypeCheck.length-1);

			$.post(rp+'checkouts/deliveryLocation',{'id':address, 'orderTypes':orderTypeChecks}, function(response) {
				if (response != '') {
					$('#locationError').html(response);
				} else {

					$(page1).hide();
					$(page1+'_tab').removeClass('active');
					$(page2+'_tab').addClass('active');

					if (page1 == '#deliverAddress') {
						
						orderTypeCheck = orderTypeCheck.substr(0, orderTypeCheck.length-1);
						id = id.substr(0, id.length-1);
						$.post(rp+'checkouts/orderReview',{'id':id, 'orderTypeCheck' : orderTypeCheck}, function(response) {
							$('#reviewConform').html(response);
						});
					};
					$(page2).show();
				}
			});

		} else {
			$(page1).hide();
			$(page1+'_tab').removeClass('active');
			$(page2+'_tab').addClass('active');
			$(page2).show();
		}
	}
}

function slotStore (id) {
	var type = $('#dateType'+id).val();
	var orderTypeVal = ($('#OrderOrderType'+id+'Collection').prop("checked")) ? 'Collection' : 'Delivery';

	var orderType = ($('#OrderOrderType'+id+'Collection').prop("checked")) ? '<?php echo __("Collection"); ?>' : '<?php echo __("Delivery"); ?>';
	$('#orderType_'+id).html(orderType);

	$.post(rp+'checkouts/storeTimeSlot',{'id':id, 'type': type, 'orderType': orderTypeVal}, function(response) {
		$('#timeslot'+id).html(response);
	});
}

</script>*/
?>