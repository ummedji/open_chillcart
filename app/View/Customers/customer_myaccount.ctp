<div class="container searchshopContent">
	<div class="row customerMyAccount">
		<div class="myaccount-tabs col-md-2 col-lg-2 col-sm-12 col-xs-12">
			<a class="active" href="javascript:void(0);" id="orderhistory">
				<div class="orderHistory"></div>
				<div class="myaccount-label"> <?php echo __('Order History', true); ?></div>
			</a>
			<a href="javascript:void(0);" id="profile">
				<div class="profile"></div>
				<div class="myaccount-label"> <?php echo __('Profile', true); ?></div>
			</a>
			<a href="javascript:void(0);" id="password_change">
				<div class="address"></div>
				<div class="myaccount-label"> <?php echo __('Password', true); ?></div>
			</a>
			<a href="javascript:void(0);" id="address">
				<div class="address"></div>
				<div class="myaccount-label"> <?php echo __('Address Book', true); ?></div>
			</a>
		</div>
		<div class="col-md-10">
			<a href="<?php echo $siteUrl; ?>" class="pull-right btn btn-primary"> Continue Shopping </a>
			<div class="myorderTab" id="orderhistory_content">
				<h1> <?php echo __('Order History', true); ?></h1>
				<div class="table-responsive">
					<table class="table table-hover datatable-common" >
						<thead>
							<tr>
								<th class="no-sort"><?php echo __('Order No', true); ?></th>
								<th> <?php echo __('Total Price', true); ?></th>
								<th> <?php echo __('Payment Type', true); ?></th>
								<th> <?php echo __('Delivery Date', true); ?></th>
								<th> <?php echo __('Order At', true); ?></th>
								<th> <?php echo __('Status', true); ?></th>
								<th class="no-sort"> <?php echo __('Details', true); ?></th>
								<th class="no-sort"> <?php echo __('Review', true); ?></th>
								<!-- <th class="no-sort"> <?php echo __('Cancel', true); ?></th> -->
							</tr>
						</thead>
						<tbody>

							<?php if(!empty($order_detail)) { 
		                    	foreach($order_detail as $key => $value){  ?>
			                    	<tr>
										<td><?php echo $value['Order']['ref_number'];?></td>
										<td><?php echo $value['Order']['order_grand_total'];?></td>
										<td><?php echo __($value['Order']['payment_type']);?></td>
										<td><?php echo $value['Order']['delivery_date'];?></td>
										<td><?php echo $value['Order']['created'];?></td>
										<td><?php echo __($value['Order']['status']);?></td>
										<td><?php
											echo $this->Html->link('<i class="fa fa-search"></i>',
																	array('controller'=>'Customers',
																		   'action'=>'orderView',
																			$value['Order']['id']),
																	array('class'=>'buttonEdit',
																			'escape'=>false));?>
										</td>
										<td><?php
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
											}	?>
										</td>
										<!-- <td> <?php
											if($value['Order']['status'] == 'Pending') {
												if (empty($value['Order']['cancel_reason'])) { ?>
													<a href="javascript:void(0);" onclick = "cancelOrder(<?php echo $value['Order']['id'];?>);" data-toggle="modal"
													   data-target="#cancelPopup"><?php echo __('Cancel', true); ?>
													</a> <?php
												} else {
													echo 'Request sent';
												}
											} ?>
										</td> -->

									</tr><?php
								}
		                    } ?>

						</tbody>
					</table>
				</div>
			</div>
			<div class="myorderTab" id="profile_content" style="display:none;">
				<h1> <?php echo __('Profile', true); ?></h1>
				<div class="row"> <?php
	                   echo $this->Form->create('Customer', array('class' => 'login-form','type'=>'file')); ?>
	                <div class="col-md-5">
	                	<div class="row">
	                		<div class="col-md-11">
		                		<div class="cardDetailHead"> <?php echo __('Basic Details', true); ?></div>
		                		<div class="form-group clearfix">
		                			<div class="col-md-12">
				                		<?php
					                        if(!empty($this->request->data['Customer']['image'])) { ?>
					                            <img class="img-responsive customer_image"  src="<?php echo $cdn.'/Customers/'.$this->request->data['Customer']['image']; ?>" > <?php 
					                        } else {
					                                echo "No Image Found";
					                        }
					                        echo $this->Form->input("Customer.image",
					                                 				array("label"=>false,
							                                              "type"=>"file",
							                                              "class"=>"form-control textbox margin-t-15",
							                                               ));

							                echo $this->Form->input('Customer.org_logo',
							                            array('class' => 'form-control',
							                            	  'type' => 'hidden',
							                                  'label' => false,
							                                  'value' => $this->request->data['Customer']['image']));
						                ?>
						            </div>
					            </div>
					            <div class="form-group profile-box clearfix">
									<label class="control-label col-md-12 text-left"> <?php echo __('Name', true); ?></label>
									<div class="col-md-12">
										<div class="formLabel"><?php
			                    					echo $this->Form->input('Customer.first_name',
			                    										array('class'=>'form-control',
			                    											  'autocomplete' => 'off',
			                    											  'readonly' => true,
			                                                                  'label' => false,
			                    											  'div' => false)); ?> </div>
										<span class="edit"><i class="fa fa-edit"></i></span><?php
			                            echo $this->Form->input('Customer.first_name',
			                    										array('class'=>'form-control textbox',
			                    											  'autocomplete' => 'off',
			                                                                  'label' => false,
			                    											  'div' => false)); ?>
									<span class="lableclose"><i class="fa fa-times-circle"></i></span>
									</div>
								</div>

								<div class="form-group profile-box clearfix">
									<label class="control-label col-md-12 text-left"> <?php echo __('Email', true); ?></label>
									<div class="col-md-12">
										<div class="formLabel"><?php
			                    					echo $this->Form->input('Customer.customer_email',
			                    										array('class'=>'form-control',
			                    											  'autocomplete' => 'off',
			                    											  'readonly' => true,
			                                                                  'label' => false,
			                    											  'div' => false)); ?></div>
										<span class="edit"><i class="fa fa-edit"></i></span> <?php
			                    					echo $this->Form->input('Customer.customer_email',
			                    										array('class'=>'form-control textbox',
			                    											  'autocomplete' => 'off',
			                                                                  'label' => false,
			                    											  'div' => false)); ?>
										<span class="lableclose"><i class="fa fa-times-circle"></i></span>
									</div>
								</div>

								<div class="form-group profile-box clearfix">
									<label class="control-label col-md-12 text-left"> <?php echo __('Phone Number', true); ?></label>
									<div class="col-md-12">
										<div class="formLabel"><?php
			                    					echo $this->Form->input('Customer.customer_phone',
			                    										array('class'=>'form-control',
			                    											  'autocomplete' => 'off',
			                    											  'readonly' => true,
			                                                                  'label' => false,
			                    											  'div' => false)); ?></div>
										<span class="edit"><i class="fa fa-edit"></i></span> <?php
			                    					echo $this->Form->input('Customer.customer_phone',
			                    										array('class'=>'form-control textbox',
			                    											  'autocomplete' => 'off',
			                                                                  'label' => false,
			                    											  'div' => false)); ?>
										<span class="lableclose"><i class="fa fa-times-circle"></i></span>
									</div>
								</div>
			                    <div class="form-group profile-box clearfix">
									<label class="control-label col-md-12 text-left"> <?php echo __('Do You Wanna Newsletter', true); ?></label>
									<div class="col-md-12">
										
										<label class="radio-inline"> <?php 
			                                    $option1 = array('Yes'  => __('Yes'));
			                                    $option2 = array('No'   => __('No'));
			                                   	echo $this->Form->radio('Customer.news_letter_option',$option1,
			                           							array('checked'=>$option1,
			                           								'label'=>false,
			                           								'legend'=>false,                        
			                           								'hiddenField'=>false)); ?>
			                            </label>
										<label class="radio-inline"><?php
			                                	echo $this->Form->radio('Customer.news_letter_option',$option2,
			                           							array('checked'=>$option2,
			                           								'label'=>false,
			                           								'legend'=>false,
			                           								'hiddenField'=>false)); ?>
			                            </label>
										
									</div>
								</div>
							</div>
						</div>
	                </div>					
					<div class="col-md-7 profile-right">
						
						<div class="paymentWrapper cardProfile clearfix">
							<div class="cardDetailHead"> <?php echo __('Saved Card Details'); ?>
								<span class="pull-right">
									<a href="javascript:void(0);" data-target="#addpayment" data-toggle="modal" class="addnewAdrr">
										<i class="fa fa-plus"></i>&nbsp; <?php echo __('Add Card', true); ?>
									</a>
								</span>
							</div><?php 
							if(!empty($Stripe_detail)){
								foreach ($Stripe_detail as $key => $value) {?>

									<div class="col-md-6 col-xs-12" id="<?php echo "card".$value['StripeCustomer']['id'];?>">

										<label class="editpayment" >
											<input type="radio" value="" name="">
											<div class="card_info">
												<span class="editAdd contain truncate">

													<img style="height:24px;" alt="cod_icon" title="cod_icon" src="<?php echo $siteUrl.'/	frontend/images/debit_card.png'; ?>">
													<?php echo $value['StripeCustomer']['customer_name'] ;?>													
												</span>
												<p class="margin-t-20">XXXX XXXX XXXX <?php echo $value['StripeCustomer']['card_number'] ;?> </p>
											</div>
											<a class="delete_card" href="javascript:void(0)" onclick="deletecard(<?php echo $value['StripeCustomer']['id']; ?>)">x</a>
										</label>
									</div>
									<?php
								}

							} ?>
							
							
						</div>
					</div>
					<div class="col-md-12 text-center">
	                    <?php echo $this->Form->button(__('Submit'),array('class'=>'btn btn-primary'));  ?>
	                    <?php echo $this->Form->end();?>
					</div>
						
				</div>
			</div>
			<div class="myorderTab" id="password_change_content" style="display:none;">
				<h1> <?php echo __('Password', true); ?></h1><?php
				echo $this->Form->create('Customer', array('class' => 'form-horizontal col-md-8','controller'=>'Customers','action'=>'changePassword')); ?>
					<div class="cardDetailHead"> <?php echo __('Change Password', true); ?></div>
				<label class="error passerror"></label>
					<div class="form-group margin-t-25">
						<label class="control-label col-md-4"> <?php echo __('Current Password', true); ?></label>
						<div class="col-md-8"><?php
							echo $this->Form->input('User.oldpassword',
								array('class'=>'form-control',
									'autocomplete' => 'off',
									'type'=>'password',
									'onBlur'=>'checking()',
									'label' => false,
									'div' => false)); ?>

						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4"> <?php echo __('New Password', true); ?></label>
						<div class="col-md-8"><?php
							echo $this->Form->input('User.newpassword',
								array('class'=>'form-control',
									'autocomplete' => 'off',
									'type'=>'password',
									'label' => false,
									'div' => false)); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4"> <?php echo __('Confirm Password', true); ?></label>
						<div class="col-md-8"><?php
							echo $this->Form->input('User.confirmpassword',
								array('class'=>'form-control',
									'autocomplete' => 'off',
									'type'=>'password',
									'label' => false,
									'div' => false)); ?>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-8 col-md-offset-4"> <?php
							echo $this->Form->button(__('Update'), array('class'=>'btn btn-primary')); ?>
						</div>					
					</div>
				<?php echo $this->Form->end();?>
				
			</div>
			<div class="myorderTab" id="address_content" style="display:none;">
				<h1> <?php echo __('Address Book', true); ?><a class="pull-right btn btn-primary" href="javascript:void(0);" data-target="#addBookAddress" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp; <?php echo __('Add new'); ?></a></h1>
				<div class="table-responsive">
					<table class="table table-hover datatable-common">
						<thead>
							<tr>     
								<th class="text-left"> <?php echo __('Address Title', true); ?></th>
								<th class="text-left"> <?php echo __('Street Address', true); ?></th>
								<th> <?php echo __('Zip code', true); ?></th>
								<th> <?php echo __('Status', true); ?></th>
								<th class="no-sort"> <?php echo __('Action', true); ?></th>
							</tr>
						</thead>
						<tbody><?php 
	                    if (!empty($addressBook)) {
		                    foreach($addressBook as $key => $value) { ?>
								<tr id="record<?php echo  $value['CustomerAddressBook']['id'];?>">
									<td class="text-left"><?php echo $value['CustomerAddressBook']['address_title']; ?></td>
									<td class="text-left"><?php echo $value['CustomerAddressBook']['address']; ?></td>
									<td><?php echo $value['Location']['zip_code']; ?></td>
		                            <td align="center"> <?php 
		                                    if($value['CustomerAddressBook']['status'] == 0) {?>
		                                        <a title="Deactive" class="buttonStatus red_bck" href="javascript:void(0);" 
		                                        onclick="statusChange(<?php echo $value['CustomerAddressBook']['id'];?>,'customeraddress');">
		                                    <i class="fa fa-times"></i><!-- deactive --></a>
		                                    <?php } else {
		                                    ?>
		                                        <a title="active" class="buttonStatus" href="javascript:void(0);" 
		                                        onclick="statusChange(<?php echo $value['CustomerAddressBook']['id'];?>,'customeraddress');">
		                                    <i class="fa fa-check"></i></a>
		                                    <?php }?>
		                            </td>
									<td align="center">
										<a href="javascript:void(0);"  id="edit" 
		                                            onclick="customerAddressBookEdit(<?php echo $value['CustomerAddressBook']['id'];?>)"><i class="fa fa-edit"></i></a> / 
										<a href="javascript:void(0);" onclick="customerdelete(<?php echo $value['CustomerAddressBook']['id'];?>,'customeraddress')"><i class="fa fa-trash"></i></a>
									</td>
								</tr> <?php 
	                        }
	                    }  ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="reviewPopup">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title"> <?php echo __('Review', true); ?></h4>
			</div>
			<div class="modal-body">
				
	            <div class="form-group clearfix">
					<label class="col-sm-4 control-label text-right" > <?php echo __('Rating', true); ?></label><?php 
					echo $this->Form->create('review',array('class'=>"form-horizontal"));?>
					<div class="col-sm-7 margin-t-5">
						<div class="stars inline-block"><?php 
							$option1 = array('1'  => '1');
		                    $option2 = array('2'   => '2');
		                    $option3 = array('3'   => '3');
		                    $option4 = array('4'   => '4');
		                    $option5 = array('5'   => '5');
		                    
		                    echo $this->Form->radio('rating',$option1,
		                                    array('label' => array('class' => 'star-1'),
		                                      
		                                      'legend'=>false,
		                                      'class'=>'star-1',                        
		                                      'hiddenField'=>false));
							echo $this->Form->radio('rating',$option2,
		                                    array('label' => array('class' => 'star-2'),
		                                      
		                                      'legend'=>false,
		                                      'class'=>'star-2', 
		                                      'hiddenField'=>false));
							echo $this->Form->radio('rating',$option3,
		                                    array('label' => array('class' => 'star-3'),
		                                      
		                                      'legend'=>false,
		                                      'class'=>'star-3', 
		                                      'checked' =>'checked',
		                                      'hiddenField'=>false));
							echo $this->Form->radio('rating',$option4,
		                                    array('label' => array('class' => 'star-4'),
		                                      
		                                      'legend'=>false,
		                                      'class'=>'star-4', 
		                                      'hiddenField'=>false));
							echo $this->Form->radio('rating',$option5,
		                                    array('label' => array('class' => 'star-5'),
		                                      
		                                      'legend'=>false,
		                                      'class'=>'star-5', 
		                                      'hiddenField'=>false));
		                     echo $this->Form->hidden('id');?>

		                     <span></span>
						</div>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label col-sm-4 text-right"> <?php echo __('Message', true); ?></label> 
					<div class="col-sm-7 margin-t-5"><?php
					 echo $this->Form->input('message',
                          array('class'=>'form-control',
                              'label'=>false));?>
					</div>
				</div>
				<div class="form-group clearfix">
                    <div class="col-sm-offset-4 col-sm-7">
                        <?php echo $this->Form->button(__('<i class="fa fa-check"></i>Submit'),array('class'=>'btn purple'));  ?>
                    </div>
                </div>
				
				<?php echo $this->Form->end();?>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="cancelPopup">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title"> <?php echo __('Cancel Order', true); ?></h4>
			</div>
			<div class="modal-body"> <?php 
				echo $this->Form->create('Order',array('class'=>"form-horizontal"));?>

					<div class="form-group clearfix">
						<label class="control-label col-sm-4 text-right"> <?php echo __('Cancel Reason', true); ?></label> 
						<div class="col-sm-7 margin-t-5"><?php
						 	echo $this->Form->input('cancel_reason',
				                          array('class'=>'form-control',
				                              'label'=>false));
				        	echo $this->Form->hidden('id'); ?>
						</div>
					</div>
					<div class="form-group clearfix">
	                    <div class="col-sm-offset-4 col-sm-7">
	                        <?php echo $this->Form->button(__('<i class="fa fa-check"></i>Submit'),array('class'=>'btn purple'));  ?>
	                    </div>
	                </div> <?php 
				echo $this->Form->end();?>

			</div>
		</div>
	</div>
</div>	

<div class="modal fade" id="addBookAddress">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title"> <?php echo __('Add Address', true); ?></h4>
			</div> <?php
            echo $this->Form->create("CustomerAddressBook",
                                        array("id"=>'AddCustomerAddressBook',
                                              "url"=>array("controller"=>'Customers','action'=>'addAddressBook')));?>
				<div class="modal-body"> 
					<label  class="error checkAdderorr"></label>
					<div class="form-group clearfix">
						<label class="control-label col-md-4"> <?php echo __('Address Title', true); ?></label>
						<div class="col-md-7"><?php
											echo $this->Form->input('address_title',
													array('class'=>'form-control',
															'label'=>false)); ?>
						</div>
					</div>
					<div class="form-group clearfix">
						<label class="control-label col-md-4"> <?php echo __('Street Address', true); ?></label>
						<div class="col-md-7"><?php
											echo $this->Form->input('address',
													array('class'=>'form-control',
															'type' => 'text',
															'label'=>false)); ?>
						</div>
					</div>
					<div class="form-group clearfix">
						<label class="control-label col-md-4"> <?php echo __('Address Phone', true); ?></label>
						<div class="col-md-7"><?php
											echo $this->Form->input('address_phone',
													array('class'=>'form-control',
															'label'=>false)); ?>
						</div>
					</div>
					<div class="form-group clearfix">
						<label class="control-label col-md-4"> <?php echo __('Apt/Suite/Building', true); ?></label>
						<div class="col-md-7"><?php
											echo $this->Form->input('landmark',
													array('class'=>'form-control',
															'label'=>false)); ?>
						</div>
					</div>
				
                    <div class="form-group clearfix">
						<label class="control-label col-md-4"> <?php echo __('State', true); ?></label>
						<div class="col-md-7"><?php
											echo $this->Form->input('state_id',
												array('type'  => 'select',
													  'class' => 'form-control',
													  'options'=> array($state_list),
                                                      'onchange' => 'cityFillters();',
													  'empty' => __('Select State'),
									 				  'label'=> false)); ?>
						</div>
					</div>
                    <div class="form-group clearfix">
						<label class="control-label col-md-4"> <?php echo __('city', true); ?></label>
						<div class="col-md-7"><?php
											echo $this->Form->input('city_id',
												array('type'  => 'select',
													  'class' => 'form-control',
                                                      'onchange' => 'locationFillters();',
													  'empty' => __('Select City'),
									 				  'label'=> false)); ?>
						</div>
					</div>
                    <div class="form-group clearfix">
						<label class="control-label col-md-4"> <?php echo __('Area/zipcode', true); ?></label>
						<div class="col-md-7"><?php
										echo $this->Form->input('location_id',
												array('type'  => 'select',
													  'class' => 'form-control',
													  'empty' => __('Select Area/Zip'),
									 				  'label'=> false));  ?>
						</div>
					</div>
					<div class="form-group clearfix"> 
						<label class="control-label col-md-4">&nbsp;</label>
						<div class="col-md-7 signup-footer"> <?php 
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
		
<div class="modal fade" id="editBookAddress">

</div>
		
<div class="modal fade" id="addpayment">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title"> <?php echo __('Add New Payment', true); ?></h4>
			</div>
			<div class="modal-body"> <?php
				echo $this->Form->create('User',
							array('class'  => 'form-horizontal paymentTab',
									'name' => 'StripeForm',
									'id'   => 'UserIndexForm',
									"url"=> array("controller" => 'customers',
                              					 'action' 	   => 'customerCardAdd'))); ?>
                <div class="text-center">
					<label id="error" class="margin-b-15"></label>
				</div>

				<div class="form-group clearfix">
					<label class="control-label col-md-4"> <?php echo __('Name on Card', true); ?><span class="star">*</span> :</label>
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
					<label class="control-label col-md-4"> <?php echo __('Card Number', true); ?><span class="star">*</span>
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
												'maxlength' => 16,
												'value' => '',
												'placeholder' => 'XXXX-XXXX-XXXX-XXXX')); ?>
							<span class="input-group-addon input-group-valid"><i class="fa fa-check"></i></span>
							<span class="input-group-addon input-group-card-icon"><i class="fa fa-credit-card"></i></span>
						</div>
					</div>
				</div>

				<div class="form-group clearfix">
					<label class="control-label col-md-4"> <?php echo __('CVV', true); ?><span class="star">*</span>
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
					<label class="control-label col-md-4"> <?php echo __('Expiry Date', true); ?><span class="star">*</span> : </label>
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-6 col-xs-6">
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
							<div class="col-md-6 col-xs-6">
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
