<div class="innercontentsection checkoutpage">
  <div class="container">
    <div class="content">
      <div id="Accordion1" class="Accordion checkout_acc" tabindex="0">
        <div class="AccordionPanel">
          <div class="AccordionPanelTab">
            <div class="row checkouttitletab">
              <div class="selecteddiv"><span class="ok-icon"></span></div>
              <div class="col-md-4 col-sm-4 titlediv fldiv">1. Login ID </div>
              <div class="col-md-4 col-sm-4 titlediv">
                <p>webclues@gmail.com</p>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="text-right">
                  <button class="btn addbtn" type="submit">Change Login</button>
                </div>
              </div>
            </div>
          </div>
          <div class="AccordionPanelContent checkoutcontent">
            <div class="pad20 login_part">
                
                <?php
                if(!empty($addresses)){
                    $user_email = $addresses[0]["Customer"]["customer_email"];
                }else{
                    $user_email = "";
                }
                ?>
                
              <p class="emailtext">Logged in as <a href="mailto:<?php echo $user_email; ?>"><?php echo $user_email; ?></a></p>
              <p class="textnote">Please note that upon clicking "Sign out" you will lose items in your cart and will be redirected to Chilcart home page.</p>
              <div class="inlinecontent">
                <a class="btn signoutbut" href="<?php echo $siteUrl.'/customer/users/userLogout'; ?>">Sign Out</a>
                <p class="signouttext">Continue with checkout</p>
              </div>
            </div>
          </div>
        </div>
        <div class="AccordionPanel">
          <div class="AccordionPanelTab">
            <div class="row checkouttitletab">
              <div class="selecteddiv"><span class="ok-icon"></span></div>
              <div class="col-md-4 col-sm-4 titlediv fldiv">2. Delivery Address </div>
              <div class="col-md-4 col-sm-4 titlediv">
                <?php
                    if(!empty($addresses)){
                        $user_first_name = $addresses[0]["Customer"]["first_name"];
                        $user_last_name = $addresses[0]["Customer"]["last_name"];
                        $user_name = $user_first_name." ".$user_last_name;
                        
                        $user_phone = $addresses[0]["Customer"]["customer_phone"];
                        
                    }else{
                        $user_name = "";
                        $user_phone = "";
                    }
                ?>
                <h3><?php echo $user_name; ?><span><?php echo $user_phone; ?></span></h3>
                
                <?php
                
                if(!empty($addresses)){
                        $user_address_title = $addresses[0]["CustomerAddressBook"]["address_title"];
                        $user_address = $addresses[0]["CustomerAddressBook"]["address"];
                        $user_address_landmark = $addresses[0]["CustomerAddressBook"]["landmark"];
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
          <div class="AccordionPanelContent checkoutcontent">
            <div class="clearfix addrbook padTB20">
              <div class="col-md-6 col-sm-6 addrbookbl">
                <div class="addrbg">
                  <h2><?php echo $user_name; ?></h2>
                  <div class="row">
                    <p class="col-md-6"><?php echo $final_address; ?> </p>
                  </div>
                </div>
                <div class="defaddr clearfix">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label class="checkbox-inline">
                        <input type="checkbox" value="option1" id="inlineCheckbox1">
                        Default Address </label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                      <p> Delete Address</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 addrbookbl">
                <div class="addrbg">
                  <h2><?php echo $user_name; ?></h2>
                  <div class="row">
                    <p class="col-md-6"><?php echo $final_address; ?> </p>
                  </div>
                </div>
                <div class="defaddr clearfix">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <label class="checkbox-inline">
                        <input type="checkbox" value="option1" id="inlineCheckbox1">
                        Default Address </label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                      <p> Delete Address</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center padB20"> <a href="" class="addbtn btn"><span class="addriconwt"></span>Add Address</a></div>
          </div>
        </div>
        <div class="AccordionPanel">
          <div class="AccordionPanelTab">
            <div class="row checkouttitletab">
              <div class="selecteddiv"><span class="ok-icon"></span></div>
              <div class="col-md-12 titlediv fldiv">3. Order Summary 4 items </div>
            </div>
          </div>
          <div class="AccordionPanelContent checkoutcontent">
            <div class="orderdetails">
              <div class="clearfix orderheading pad20 mobilehide">
                <div class="col-md-2 wrap15"></div>
                <div class="col-md-3">Item</div>
                <div class="col-md-1 wrap5">Qty</div>
                <div class="col-md-2 wrap15">Price</div>
                <div class="col-md-3">Delivery Details</div>
                <div class="col-md-2 wrap15">Subtotal </div>
              </div>
              <div class="clearfix orderdet pad20 ">
                <div class="col-md-2 col-sm-2 wrap15">
                  <div class="imgdiv text-center"><img src="images/camera-image.png"></div>
                </div>
                <div class="col-md-3 col-sm-10">
                  <div class="itemdiv">
                    <p class="itemtitle">Camera</p>
                    <p>Canon EOS 1200D (Kit with 8 GB Card &amp; Bag EF S18-55 IS II+55-250mm IS II) DSLR Camera</p>
                    <div class="desktophide itembl">
                     <p><span class="tl">Qty :</span><span class="qtydiv">1</span></p>
                     <p><span class="tl">Price :</span><span class="rsdiv">Rs.24999</span></p>
                      <p><span class="tl">Delivery Detail :</span><span class="delivdet">by Wed, 27th Apr [FREE]</span></p>
                       <p><span class="tl">Total Price :</span><span class="rsdiv">Rs.24999</span></p>
                    </div>
                    
                  </div>
                </div>
                <div class="col-md-1 wrap5 mobilehide">
                  <p class="qtydiv">1</p>
                </div>
                <div class="col-md-2 wrap15 mobilehide">
                  <p class="rsdiv">Rs.24999</p>
                </div>
                <div class="col-md-3 mobilehide">
                  <p class="delivdet">by Wed, 27th Apr [FREE]</p>
                </div>
                <div class="col-md-2 wrap15 mobilehide">
                  <p class="rsdiv">Rs.24999</p>
                </div>
              </div>
              <div class="clearfix orderdet pad20 ">
                <div class="col-md-2 col-sm-2 wrap15">
                  <div class="imgdiv text-center"><img src="images/camera-image.png"></div>
                </div>
                <div class="col-md-3 col-sm-10">
                  <div class="itemdiv">
                    <p class="itemtitle">Camera</p>
                    <p>Canon EOS 1200D (Kit with 8 GB Card &amp; Bag EF S18-55 IS II+55-250mm IS II) DSLR Camera</p>
                    <div class="desktophide itembl">
                     <p><span class="tl">Qty :</span><span class="qtydiv">1</span></p>
                     <p><span class="tl">Price :</span><span class="rsdiv">Rs.24999</span></p>
                      <p><span class="tl">Delivery Detail :</span><span class="delivdet">by Wed, 27th Apr [FREE]</span></p>
                       <p><span class="tl">Total Price :</span><span class="rsdiv">Rs.24999</span></p>
                    </div>
                    
                  </div>
                </div>
                <div class="col-md-1 wrap5 mobilehide">
                  <p class="qtydiv">1</p>
                </div>
                <div class="col-md-2 wrap15 mobilehide">
                  <p class="rsdiv">Rs.24999</p>
                </div>
                <div class="col-md-3 mobilehide">
                  <p class="delivdet">by Wed, 27th Apr [FREE]</p>
                </div>
                <div class="col-md-2 wrap15 mobilehide">
                  <p class="rsdiv">Rs.24999</p>
                </div>
              </div>
              <div class="pad20">
                <p class="alerttext">Send Order Confirmation SMS alert to +91 9879431254</p>
              </div>
              <div class="padLR20 padB20 clearfix">
                
                <div class="pull-right ordersum">
                  <p class="amountpay">Amount Payable: Rs.41677</p>
                </div>
                <div class="pull-left ordersum">
                  <button type="button" class="btn addbtn">Continue</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="AccordionPanel">
          <div class="AccordionPanelTab">
            <div class="row checkouttitletab">
              <div class="selecteddiv"><span class="ok-icon"></span></div>
              <div class="col-md-12 titlediv fldiv">4. Payment Method </div>
            </div>
          </div>
          <div class="AccordionPanelContent checkoutcontent">
            <div class="paymethoddiv">
              <div class="clearfix">
                <div class="col-md-9 paymethodlistdiv">
                  <div id="TabbedPanels1" class="TabbedPanels clearfix">
                    <ul class="col-md-3 TabbedPanelsTabGroup">
                      <li class="TabbedPanelsTab" tabindex="0">
                        <div class="paytypetitle">Credit Card</div>
                      </li>
                      <li class="TabbedPanelsTab" tabindex="0">
                        <div class="paytypetitle">Net Banking</div>
                      </li>
                      <li class="TabbedPanelsTab" tabindex="0">
                        <div class="paytypetitle">EMI</div>
                      </li>
                      <li class="TabbedPanelsTab" tabindex="0">
                        <div class="paytypetitle">Debit Card</div>
                      </li>
                      <li class="TabbedPanelsTab" tabindex="0">
                        <div class="paytypetitle">COD</div>
                      </li>
                      <li class="TabbedPanelsTab" tabindex="0">
                        <div class="paytypetitle">Gift Card</div>
                      </li>
                    </ul>
                    <div class="col-md-9 TabbedPanelsContentGroup">
                      <div class="TabbedPanelsContent">
                        <div class="carddetail">
                          <p class="smalltext">Pay using EMI on Credit Card</p>
                          <div class="mrgTB20">
                            <p class="text">Flipcart does not change any processing fee for availing amount in case of any cancallation.</p>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Select Type of Card</label>
                            <select class="form-control">
                              <option selected>----Select a Bank----</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="TabbedPanelsContent">
                        <div class="carddetail">
                          <p class="smalltext">Pay using EMI on Credit Card</p>
                          <div class="mrgTB20">
                            <p class="text">Flipcart does not change any processing fee for availing amount in case of any cancallation.</p>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Select Type of Card</label>
                            <select class="form-control">
                              <option selected>----Select a Bank----</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="TabbedPanelsContent">
                        <div class="carddetail">
                          <p class="smalltext">Pay using EMI on Credit Card</p>
                          <div class="mrgTB20">
                            <p class="text">Flipcart does not change any processing fee for availing amount in case of any cancallation.</p>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Select Type of Card</label>
                            <select class="form-control">
                              <option selected>----Select a Bank----</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="TabbedPanelsContent">
                        <div class="carddetail">
                          <p class="smalltext">Pay using EMI on Credit Card</p>
                          <div class="mrgTB20">
                            <p class="text">Flipcart does not change any processing fee for availing amount in case of any cancallation.</p>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Select Type of Card</label>
                            <select class="form-control">
                              <option selected>----Select a Bank----</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="TabbedPanelsContent">
                        <div class="carddetail">
                          <p class="smalltext">Pay using EMI on Credit Card</p>
                          <div class="mrgTB20">
                            <p class="text">Flipcart does not change any processing fee for availing amount in case of any cancallation.</p>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Select Type of Card</label>
                            <select class="form-control">
                              <option selected>----Select a Bank----</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="TabbedPanelsContent">
                        <div class="carddetail">
                          <p class="smalltext">Pay using EMI on Credit Card</p>
                          <div class="mrgTB20">
                            <p class="text">Flipcart does not change any processing fee for availing amount in case of any cancallation.</p>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Select Type of Card</label>
                            <select class="form-control">
                              <option selected>----Select a Bank----</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                        </div>
                      </div>
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
                        <p>Rs. 41677</p>
                      </div>
                    </div>
                    <div class="clearfix totalamtext bgchange">
                      <p class="text-right">Amount Payable<span>Rs. 41677</span></p>
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
</div>
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