<div id="banner" class="innerbanner accounthistorybanner"> 
  <div class="container"> 
    <div class="bannerdesc text-center">
      <div class="bannertext">
        <div class="bannercaption">
          <h1>you`re the boss of your account.</h1>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-9">
        <div class="officerblock clearfix">

          <div class="officerimg pull-left">  <?php  if(!empty($this->request->data['Customer']['image'])) {


 ?>
					                            <img src="<?php echo $cdn.'/Customers/'.$this->request->data['Customer']['image']; ?>" > <?php 
					                        } else { ?>
					                                <img src="https://u.o0bc.com/avatars/stock/_no-user-image.gif"><?php //echo "No Image Found";
					                        } ?></div>
          <div class="officerdet clearfix">

 

            <h3><a href=""><?php 
			echo $this->request->data['Customer']['first_name'].' '.$this->request->data['Customer']['last_name'];?></a></h3>
            <p>Product and Business Devlopment</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bannerbg"></div>
</div>


<section class="container"> </section>
<div class="innercontentsection accountpages">
  <div class="container">
    <div class="content">
      <div id="TabbedPanels1" class="TabbedPanels accounthistory">
        <ul class="TabbedPanelsTabGroup clearfix">
          <li class="TabbedPanelsTab col-md-3 col-sm-3 col-xs-12" tabindex="0">
            <p class="cf"><span class="hisicon"></span><?php echo __('ORDER HISTORY', true); ?></p>
          </li>
          <li class="TabbedPanelsTab col-md-3 col-sm-3 col-xs-12" tabindex="0">
            <p class="cf"><span class="proficon"></span><?php echo __('PROFILE', true); ?></p>
          </li>
          <li class="TabbedPanelsTab col-md-3 col-sm-3 col-xs-12" tabindex="0">
            <p class="cf"><span class="cardicon"></span><?php echo __('ADD CARD', true); ?></p>
          </li>
          <li class="TabbedPanelsTab col-md-3 col-sm-3 col-xs-12" tabindex="0">
            <p class="cf"><span class="addricon"></span><?php echo __('ADDRESS BOOK', true); ?></p>
          </li>
        </ul>



        <div class="TabbedPanelsContentGroup">
          <div class="TabbedPanelsContent">
            <div class="acc_his_block">
              <div class="text-center mrgTB30">
                <h2 class="blgrtitle "><span class="blackborder">Order</span> <span class="greenborder">History</span></h2>
              </div>
			  <?php 
			  $grandtotal=0; 
			  foreach($order_detail as $key => $value){ $grandtotal += $value['Order']['order_grand_total']; } ?>
              <div class="clearfix pad20">
                <p class="price pull-right">Total Price:  <?php echo $grandtotal; ?></p>
              </div>
              <div id="Accordion1" class="Accordion" tabindex="0">
				<?php			
				if(!empty($order_detail)) { 
				foreach($order_detail as $key => $value){
				?>
			   <div class="AccordionPanel">
                  <div class="AccordionPanelTab clearfix"><div class="pull-left"><?php echo __('Order No', true); ?> : <?php echo $value['Order']['ref_number'];?></div><div class="pull-right"><span class="menu-down"></span></div></div>
                  <div class="AccordionPanelContent">
                    <div class="acchist_acc pad20">
                      <div class="row">
                        <div class="col-md-12 col-sm-12">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 accdet">
                              <div class="mrgT10">
                                <p><span><?php echo __('Payment Type', true); ?> :</span> <?php echo __($value['Order']['payment_type']);?></p>
                                <p><span><?php echo __('Delivery Date', true); ?> :</span> <?php echo $value['Order']['delivery_date'];?></p>
                                <p><span><?php echo __('Review', true); ?> :</span> <?php
											if(!empty($value['Review']['rating'])){
												$amount = $value['Review']['rating'] * 20;?>
												<span class="review_rating_outer">
													<span class="review_rating_grey"></span>
													<span class="review_rating_green" style="width:<?php echo $amount;?>%;"></span>
												</span>

											<?php }else {
												if($value['Order']['status'] == 'Delivered'){?>
												<a href="javascript:void(0);"
												   onclick = "orderid(<?php echo$value['Order']['id'];?>)"data-toggle="modal"
												   data-target="#reviewPopup"><?php echo __('Review', true); ?></a><?php }
											}	?></p>
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6 accdet">
                              <div class="mrgT10">
                                <p><span><?php echo __('Order At', true); ?> :</span> <?php echo $value['Order']['created'];?></p>
                                <p><span><?php echo __('Status', true); ?> :</span> <?php echo __($value['Order']['status']);?></p>
                                <p><span><?php echo __('Details', true); ?> :</span> <?php
											echo $this->Html->link('<i class="fa fa-search"></i>',
																	array('controller'=>'Customers',
																		   'action'=>'orderView',
																			$value['Order']['id']),
																	array('class'=>'buttonEdit',
																			'escape'=>false));?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				<?php
					}
				} ?>
              </div>
              <div class="text-center">
                <div class="clearfix contshop mrgTB20"><a href="" class="pull-left shopcarttag"><span class="shopcart"></span></a> <a href="<?php echo $siteUrl; ?>" class="pull-left shotext"> Continue Shopping </a></div>
              </div>
            </div>
          </div>
          <div class="TabbedPanelsContent">
            <div class="acc_his_block">
              <div class="text-center mrgTB30">
                <h2 class="blgrtitle "><span class="blackborder">MY</span> <span class="greenborder">Profile</span></h2>
              </div>
			  <?php echo $this->Form->create('customer', array('class' => 'login-form','type'=>'file')); ?>
              <div class="clearfix addprofblock">
                <div class="clearfix">
                  <div class="col-md-6 profinfo">
				
                    <div class="form-group">
                      <label class="sr-only" for="exampleInputAmount">Select File</label>
                      <div class="input-group filetype">
                        <!-- <input type="file" class="form-control" placeholder="No file Selected"> -->
						<?php
					                        
					                        echo $this->Form->input("Customer.image",
					                                 				array("label"=>false,
							                                              "type"=>"file",
																		  'onchange' => 'showimage(event);',
																		  'placeholder' => 'No file Selected',
							                                              "class"=>"form-control textbox margin-t-15",
							                                               ));
											?> <span class="nofiletext">No file Selected</span><?php 
							                echo $this->Form->input('Customer.org_logo',
							                            array('class' => 'form-control',
							                            	  'type' => 'hidden',
							                                  'label' => false,
							                                  'value' => $this->request->data['Customer']['image']));
						                ?>
                        <!-- <span class="nofiletext">No file Selected</span> -->
                        <div class="input-group-addon"><span class="attachicon"></span></div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="sr-only" for="exampleInputAmount">Email</label>
                      <div class="input-group">
                        <!-- <input type="text" class="form-control" placeholder="Email"> -->
						<?php
			                    					echo $this->Form->input('Customer.customer_email',
			                    										array('class'=>'form-control',
			                    											  'autocomplete' => 'off',
			                    											  'readonly' => false,
			                                                                  'label' => false,
			                    											  'div' => false)); ?><?php
			                    				/*	echo $this->Form->input('Customer.customer_email',
			                    										array('class'=>'form-control textbox',
			                    											  'autocomplete' => 'off',
			                                                                  'label' => false,
			                    											  'div' => false)); */?>
                        <div class="input-group-addon"><span class="msgicon"></span></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 profinfo">
                    <div class="form-group">
                      <label class="sr-only" for="exampleInputAmount">Name</label>
                      <div class="input-group">
                        <!-- <input type="text" class="form-control" placeholder="Name"> -->
						<?php
			                    					echo $this->Form->input('Customer.first_name',
			                    										array('class'=>'form-control',
			                    											  'autocomplete' => 'off',
			                    											  'readonly' => false,
			                                                                  'label' => false,
			                    											  'div' => false)); ?> 
										<?php
			                            /*echo $this->Form->input('Customer.first_name',
			                    										array('class'=>'form-control textbox',
			                    											  'autocomplete' => 'off',
			                                                                  'label' => false,
			                    											  'div' => false)); */?>
                        <div class="input-group-addon"><span class="nameicon"></span></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="sr-only" for="exampleInputAmount">Phone Number</label>
                      <div class="input-group"><?php 
					  echo $this->Form->input('Customer.customer_phone',
			                    										array('class'=>'form-control',
			                    											  'autocomplete' => 'off',
			                    											  'readonly' => false,
			                                                                  'label' => false,
			                    											  'div' => false)); 
			                    				/*	echo $this->Form->input('Customer.customer_phone',
			                    										array('class'=>'form-control textbox',
			                    											  'autocomplete' => 'off',
			                                                                  'label' => false,
			                    											  'div' => false)); */?>
                        <!-- <input type="text" class="form-control" placeholder="Phone Number"> -->
                        <div class="input-group-addon"><span class="phoneicon"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pad20">
                  <h3><?php echo __('Do You Wanna Newsletter', true); ?></h3>
                  <div class="clearfix">
						<label class="checkbox-inline"> <?php 
							$option1 = array('Yes'  => __('Yes'));
							$option2 = array('No'   => __('No'));
							echo $this->Form->radio('Customer.news_letter_option',$option1,
							array('checked'=>$option1,
							'label'=>false,
							'legend'=>false,                        
							'hiddenField'=>false)); ?>
							</label>
							<label class="checkbox-inline"><?php
							echo $this->Form->radio('Customer.news_letter_option',$option2,
							array('checked'=>$option2,
							'label'=>false,
							'legend'=>false,
							'hiddenField'=>false)); ?>
						</label>
                    <!-- <label class="checkbox-inline">
                      <input type="checkbox" id="inlineCheckbox1" value="option1">
                      Yes </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" id="inlineCheckbox2" value="option2">
                      No </label> -->
                  </div>
                </div>
                <div class="text-center">
				 <?php echo $this->Form->button(__('Submit'),array('class'=>'btn btn-primary'));  ?>
	                    <?php echo $this->Form->end();?>
                 <!--  <button class="btn" type="submit">Submit</button>
                  <button class="btn" type="submit">Change Password</button> -->
                </div>
              </div>
              <div class="text-center">
                <div class="clearfix contshop mrgTB20"><a class="pull-left shopcarttag" href=""><span class="shopcart"></span></a> <a href="<?php echo $siteUrl; ?>" class="pull-left shotext"> Continue Shopping </a></div>
              </div>
            </div>
          </div>
          <div class="TabbedPanelsContent">
            <div class="acc_his_block">
              <div class="text-center mrgTB30">
                <h2 class="blgrtitle "><span class="blackborder">My</span> <span class="greenborder">saved Card</span></h2>
              </div>
              <div class="clearfix padLR20">
               <!--  <p class="removeiconbl pull-right">Remove <span class="removeicon"></span></p> -->
              </div>
			  <?php 
			  if(!empty($Stripe_detail)){
			  foreach ($Stripe_detail as $key => $value) { ?>
              <div class="clearfix savedcardblock" id="<?php echo "card".$value['StripeCustomer']['id'];?>">
                <div class="img pull-left"><img alt="cod_icon" src="<?php echo $siteUrl.'/frontend/images/visa-card.png'; ?>">
				</div>
                <div class="cardinfo clearfix">
                  <h4>XXXX XXXX XXXX <?php echo $value['StripeCustomer']['card_number'] ;?></h4>
                  <p><?php echo $value['StripeCustomer']['customer_name'] ;?><!-- Allahabad Bank Debit Card --><a class="delete_card" href="javascript:void(0)" onclick="deletecard(<?php echo $value['StripeCustomer']['id']; ?>)"><span class="removeicon"></span></a></p>
                </div>
              </div>
			  <?php } } ?>
              <div class="text-center pad20"> <a class="addbtn btn" data-target="#demo-6" data-toggle="modal"><span class="cardiconwt"></span>Add new card</a></div> 
            </div>
          </div>
          <div class="TabbedPanelsContent">
          <div class="acc_his_block">
              <div class="text-center mrgTB30">
                <h2 class="blgrtitle "><span class="blackborder">Address</span> <span class="greenborder">book</span></h2>
              </div>
              
              <div class="clearfix addrbook">
              <?php 
				if (!empty($addressBook)) {
				foreach($addressBook as $key => $value) { ?>
              <div class="col-md-6 addrbookbl" id="record<?php echo $value['CustomerAddressBook']['id'];?>">
              	<div class="addrbg"><h2><?php echo $value['CustomerAddressBook']['address_title']; ?></h2>
              <div class="row"><p class="col-md-6 col-sm-6"><?php echo $value['CustomerAddressBook']['address']; ?><br><?php echo $value['CustomerAddressBook']['landmark']; ?><br>
			  <?php echo $value['City']['city_name'];  ?>-<?php echo $value['Location']['zip_code']; ?><br>
			  <?php echo $value['State']['state_name'];  ?>-</p></div></div>
<?php if($value['CustomerAddressBook']['def_add']) { $check = "checked=checked"; } else { $check = ''; } ?>
				<div class="defaddr clearfix"><div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                 <label class="checkbox-inline">
                      <input type="checkbox" class="allcheck" id="inlineCheckbox<?php  echo $value['CustomerAddressBook']['id']; ?>" value="option1" onclick="makeDefaultAdd(this,'<?php  echo $value['CustomerAddressBook']['id']; ?>')" <?php echo $check; ?>>
                      Default Address <a href="javascript:void(0);"  id="edit" 
		                                            onclick="customerAddressBookEdit(<?php echo $value['CustomerAddressBook']['id'];?>)" style="color:white;"><i class="fa fa-edit"></i></a> </label>
                
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                 <a href="javascript:void(0);" onclick="customerdelete(<?php echo $value['CustomerAddressBook']['id'];?>,'customeraddress')" style="color:white;"><p> Delete Address</p></a>
                
                </div>
                
                
                </div></div>
              </div>
            <?php } } ?>
              </div>
              <div class="text-center pad20"> <a class="addbtn btn"  href="#" data-target="#demo-5" data-toggle="modal"><span class="addriconwt"></span>Add Address</a></div>
              </div>
          
          
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!--login-->
<div class="modal fade add_adress_parent" id="demo-5" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="css-popup" >
<div class="add-new-card-popup">
<div class="text-center mrgTB30">
                <h2 class="blgrtitle "><span class="blackborder">Add</span> <span class="greenborder">New Address</span></h2>
              </div>
              
              
              <div class="content-popup">
              
<?php echo $this->Form->create("CustomerAddressBook",
						array("id"=>'AddCustomerAddressBook_Ordercustomer',
							  "url"=>array("controller"=>'customers','action'=>'addAddressBook')));?>
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
											'onclick' => 'return addAddressCheck();',
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
<!--login-->

<!----Add Card--->
<div class="modal fade add_adress_parent" id="demo-6" tabindex="-1">
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
									'id'   => 'UserIndexForm',
									"url"=> array("controller" => 'customers',
                              					 'action' 	   => 'customerCardAdd'))); ?>
  <div class="form-group">
    <label class="sr-only"><?php echo __('Name on Card', true); ?></label>
	<?php echo $this->Form->input("Card.Name",
									array("type"=>"text",
											"label"=>false,
											'data-stripe' => 'name',
											"class"=>"form-control",
											'value' => '',
											'placeholder' => 'Name on Card')); 
						?>
    <!-- <input type="email" class="form-control" id="sr-only" placeholder="Name on Card"> -->
  </div>
  <div class="form-group">
    <label class="sr-only"><?php echo __('Card Number', true); ?></label>
	<?php 
								echo $this->Form->input("Card.number",
										array("type"=>"text",
												"label"=>false,
												'data-stripe' => 'number',
												"class"=>"form-control intnumber",
												'height' => 40,
												'maxlength' => 16,
												'value' => '',
												'placeholder' => 'XXXX-XXXX-XXXX-XXXX')); ?>
    <!-- <input type="password" class="form-control" placeholder="Card Number"> -->
  </div>
  
  <div class="form-group">
    <label class="sr-only"><?php echo __('CVV', true); ?></label>
	<?php 
									echo $this->Form->input("Card.cvv",	
										array("type"=>"password",
												"label"=>false,
												'data-stripe' => 'cvc',
												"class"=>"form-control",
												'value' => '',
												'placeholder' => 'CVV')); 
								?>
   <!--  <input type="password" class="form-control" placeholder="CVV"> -->
  </div>
  
  <div class="myselection"> <div class="form-group row"> <div class="col-md-3 col-sm-3"><label><?php echo __('Expiry Date', true); ?></label></div><div class="col-md-9 col-sm-9"> <div class="row"><div class="col-md-6 col-sm-6">
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
  </div>  <div class="col-md-6  col-sm-6"><?php
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
								?></div></div></div> </div> </div>
  
  <p class="text-center"><?php echo __('The card will automatically be stored in your customer profile so that you can check out faster next time.', true); ?></p><?php 
							echo $this->Form->button(__('Submit'),
								array("label"=>false,
										"id"=>"stripebtn",
										"class"=>"btn addbtn mrgTB20",
										'onclick' => 'return saveCard();',
										"type"=>'submit')); 
						?>
<?php echo $this->Form->end(); ?>
              
              </div>

</div>

</div>
    </div>
  </div>
</div>
<div class="modal fade" id="editBookAddress">

</div>
<!---Add Card-->


<?php echo $this->element('frontend/footer'); ?>