<div class="page-content-wrapper">
	<div class="page-content">
		<h3 class="page-title">Edit Store</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo $siteUrl.'/store/dashboards/index';?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				
				<li>
					<a href="javascript:void(0);">Edit Store</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i> Edit Store
						</div>
					</div>

					<div class="portlet-body form sitePaddinner">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#contact" data-toggle="tab">Contact info</a></li>
							<li><a href="#shop" data-toggle="tab">Store info</a></li>
							<li><a href="#delivery" data-toggle="tab">Delivery info</a></li>
							<li><a href="#order" data-toggle="tab">Order info</a></li>
							<li><a href="#comission" data-toggle="tab">Comission</a></li>
							<li><a href="#invoice" data-toggle="tab">Invoice Period</a></li>
							<li><a href="#MetaTags" data-toggle="tab">Meta Tags</a></li>
						</ul> <?php
						echo $this->Form->create('Store',array('class'=>'form-horizontal',
																'type' => 'file')); ?>
							<div class="tab-content"> 
								<div class="tab-pane fade active in" id="contact">
									<div id="contactError"></div>
									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Contact Name <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('contact_name',
										                            array('class' => 'form-control',
										                                  'label' => false)); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Contact Phone <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('contact_phone',
										                            array('class' => 'form-control',
										                                  'label' => false)); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Contact Email <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('contact_email',
										                            array('class' => 'form-control',
										                                  'label' => false)); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Street <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('street_address',
										                            array('class' => 'form-control',
										                                  'label' => false)); ?>
											</div>
										</div>	
										<div class="form-group">
											<label class="col-md-3 control-label">State <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('store_state',
															array('type'=>'select',
															 		'class'=>'form-control',
															 		'options'=> array($states),
															 		'onchange' => 'citiesList();',
															 		'empty' => 'Select State',
															 		'label'=> false)); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">City <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('store_city',
															array('type'=>'select',
															 		'class'=>'form-control',
															 		'options'=> array($cities),
															 		'onchange' => 'locationList();',
															 		'empty' => 'Select City',
															 		'label'=> false)); ?>
											</div>
										</div>	
										<div class="form-group">
											<label class="col-md-3 control-label">Location <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('store_zip',
															array('type'=>'select',
															 		'class'=>'form-control',
															 		'options'=> array($locations),
															 		'empty' => 'Select Location',
															 		'label'=> false)); ?>
											</div>
										</div>							
									</div>
								</div>
								<div class="tab-pane fade" id="shop">
									<div id="shopError"></div>
									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Store Name <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('store_name',
										                            array('class' => 'form-control',
										                                  'label' => false)); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Store Phone <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('store_phone',
										                            array('class' => 'form-control',
										                                  'label' => false)); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Store Logo</label> 
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('store_logo',
										                            array('type'  => 'file',
										                            	   'div'  => false,
										                                  'label' => false));
										        echo $this->Form->input('org_logo',
							                            array('class' => 'form-control',
							                            	  'type' => 'hidden',
							                                  'label' => false,
							                                  'value' => $this->request->data['Store']['store_logo'])); ?>
										        <img class="img-responsive img_fields" src="https://s3.amazonaws.com/s3test56b888c6be37d/storelogos/<?php echo $this->request->data['Store']['store_logo']; ?>" alt="">
											</div>
										</div>
										<div class="form-group profile-box clearfix">
											<label class="control-label col-lg-3 col-md-4 col-sm-5">Do You Wanna dispatch</label>
											<div class="col-lg-5 col-md-6 col-sm-6">
												<div class="radio-list">
													<label class="radio-inline"> <?php 
						                                    $option1 = array('Yes'  => 'Yes');
						                                    $option2 = array('No'   => 'No');
						                                   	echo $this->Form->radio('dispatch',$option1,
						                           							array('checked'=>$option1,
						                           								'label'=>false,
						                           								'legend'=>false,    
						                           								'checked' =>true,
						                           								'hiddenField'=>false)); ?>
						                            </label>
													<label class="radio-inline"><?php
						                                	echo $this->Form->radio('dispatch',$option2,
						                           							array('checked'=>$option2,
						                           								'label'=>false,
						                           								'legend'=>false,
						                           								'hiddenField'=>false)); ?>
						                            </label>
												</div>
											</div>
										</div>



										<div class="form-group profile-box clearfix">
											<label class="control-label col-lg-3 col-md-4 col-sm-5">Collection</label>
											<div class="col-lg-5 col-md-6 col-sm-6">
												<div class="radio-list">
													<label class="radio-inline"> <?php
					                                   	echo $this->Form->radio('collection',$option1,
					                           							array('checked'=>$option1,
					                           								'label'=>false,
					                           								'legend'=>false,    
					                           								'checked' =>true,
					                           								'hiddenField'=>false)); ?>
						                            </label>
													<label class="radio-inline"><?php
					                                	echo $this->Form->radio('collection',$option2,
					                           							array('checked'=>$option2,
					                           								'label'=>false,
					                           								'legend'=>false,
					                           								'hiddenField'=>false)); ?>
						                            </label>
												</div>
											</div>
										</div>

										<div class="form-group profile-box clearfix">
											<label class="control-label col-lg-3 col-md-4 col-sm-5">Delivery</label>
											<div class="col-lg-5 col-md-6 col-sm-6">
												<div class="radio-list">
													<label class="radio-inline"> <?php
					                                   	echo $this->Form->radio('delivery',$option1,
					                           							array('checked'=>$option1,
					                           								'label'=>false,
					                           								'legend'=>false,    
					                           								'checked' =>true,
					                           								'hiddenField'=>false)); ?>
						                            </label>
													<label class="radio-inline"><?php
					                                	echo $this->Form->radio('delivery',$option2,
					                           							array('checked'=>$option2,
					                           								'label'=>false,
					                           								'legend'=>false,
					                           								'hiddenField'=>false)); ?>
						                            </label>
												</div>
											</div>
										</div>




										<div class="form-group">
											<label class="col-md-3 control-label">About Store </label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('store_description',
										                            array('class' => 'form-control',
										                            	  'type'  => 'textarea',
										                                  'label' => false)); ?>
											</div>
										</div>	
										<div class="form-group">
											<label class="col-md-3 control-label">Email <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('User.username',
										                            array('class' => 'form-control',
										                                  'label' => false)); ?>
											</div>
										</div>						
									</div>
								</div>
								<div class="tab-pane fade" id="order">
									<div id="orderError"></div>
									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Email Order <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4">
												<div class="radio-list">
													<label class="radio-inline"> <?php  
			                                          $option1 = array('Yes'  => 'Yes');
			                                          $option2 = array('No'   => 'No'); 
                    
			                                          echo $this->Form->radio('email_order',$option1,
			                                          							array('checked'=>$option1,
			                                          								'label'=>false,
			                                          								'legend'=>false,
			                                          								'checked' => 'checked',
			                                          								'hiddenField'=>false)); ?> 
		                                            </label>
		                                            <label class="radio-inline">  <?php 
			                                           echo $this->Form->radio('email_order',$option2,
			                                           							array('checked'=>$option2,
			                                           								'label'=>false,
			                                           								'legend'=>false,
			                                           								'hiddenField'=>false)); ?>  
					                                </label>
												</div>
											</div>
										</div>
										<div id="emailOption" class="form-group">
											<label class="col-md-3 control-label">Order Email <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('order_email',
										                            array('class' => 'form-control',
										                                  'label' => false)); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">SMS Option<span class="star">*</span></label>
											<div class="col-md-6 col-lg-4">
												<div class="radio-list">
													<label class="radio-inline"> <?php  
			                                          $option1 = array('Yes'  => 'Yes');
			                                          $option2 = array('No'   => 'No'); 
                    
			                                          echo $this->Form->radio('sms_option',$option1,
			                                          							array('checked'=>$option1,
			                                          								'label'=>false,
			                                          								'legend'=>false,
			                                          								'checked' => 'checked',
			                                          								'hiddenField'=>false)); ?> 
		                                            </label>
		                                            <label class="radio-inline">  <?php 
			                                           echo $this->Form->radio('sms_option',$option2,
			                                           							array('checked'=>$option2,
			                                           								'label'=>false,
			                                           								'legend'=>false,
			                                           								'hiddenField'=>false)); ?>  
					                                </label>
												</div>
											</div>
										</div>
										<div id="smsOption" class="form-group">
											<label class="col-md-3 control-label"> Phone Number <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('sms_phone',
										                            array('class' => 'form-control',
										                                  'label' => false)); ?>
											</div>
										</div>							
									</div>
								</div>
								<div class="tab-pane fade" id="delivery">
									<div id="deliveryError"></div>
									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Delivery <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4">
												<div class="radio-list">
													<label class="radio-inline"> <?php

			                                          echo $this->Form->radio('delivery_option',$option1,
			                                          							array('checked'=>$option1,
			                                          								'label'=>false,
			                                          								'legend'=>false,
			                                          								'checked' => 'checked',
			                                          								'hiddenField'=>false)); ?> 
		                                            </label>
		                                            <label class="radio-inline">  <?php 
			                                           echo $this->Form->radio('delivery_option',$option2,
			                                           							array('checked'=>$option2,
			                                           								'label'=>false,
			                                           								'legend'=>false,
			                                           								'hiddenField'=>false)); ?>  
					                                </label>
												</div>
											</div>
										</div>
										<div id="deliveryOption">
											<div class="form-group">
												<label class="col-md-3 control-label">Delivery Location <span class="star">*</span></label>
												<div class="col-md-6 col-lg-4"> <?php
													echo $this->Form->input('DeliveryLocation.location_id',
																array('type'	 => 'select',
																 	  'class'	 => 'form-control',
																 	  'multiple' => true,
																 	  'selected' => $selected,
																 	  'label'	 => false)); ?>
												</div>
											</div>		
											<div class="form-group">
												<label class="col-md-3 control-label">Minimum Order <span class="star">*</span></label>
												<div class="col-md-6 col-lg-4"> <?php
													echo $this->Form->input('minimum_order',
											                            array('class' => 'form-control',
											                            	  'type'  => 'text',
											                                  'label' => false)); ?>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-md-3 control-label">Tax <span class="star">*</span></label>
												<div class="col-md-6 col-lg-4"> <?php
													echo $this->Form->input('tax',
											                            array('class' => 'form-control',
											                            	  'type'  => 'text',
											                                  'label' => false)); ?>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-md-3 control-label">Delivery Options <span class="star">*</span></label>
												<div class="col-md-8 col-lg-8 checktable">
													<div class="clearfix margin-b-20">
														<div class="col-md-1 itemHead">
															<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
														</div>
														<div class="col-md-6 itemHead">Delivery Timing</div>
														<div class="col-md-3 itemHead">Delivery Charge</div>
													</div> <?php

													$checked = 0;

													foreach ($timeslots as $key => $value) {
														foreach ($this->request->data['DeliveryTimeSlot'] as $keys => $values) {

															if ($values['slot_id'] == $value['TimeSlot']['id']) {
																$checked = 1;
																break;
															} 
														}

														if ($checked == 1) { 
															$checked = 0; 
															//echo "<pre>"; print_r($values); ?>

															<div class="clearfix margin-b-5 ">
																<div class="col-md-1 itemCont"> <?php
																	echo $this->Form->checkbox(
																					$value['DeliveryTimeSlot']['slot_id'],
								                                            array('class'=>'group-checkable',
								                                                  'name'=>'data[DeliveryTimeSlot]['.$key.'][slot_id]',
								                                                  'label'=>false,
								                                                  'hiddenField'=>false,
								                                                  'id'=>'test',
								                                                  'checked' => true,
								                                                  'value'=> $value['TimeSlot']['id'])); ?>
																</div>
																<div class="col-md-6 itemCont"><?php echo $value['TimeSlot']['time_from']. ' to '.$value['TimeSlot']['time_to']; ?></div>
																<div class="col-md-3 itemCont"> <?php
																	echo $this->Form->input('DeliveryTimeSlot.delivery_charge',
														                            array('class' => 'form-control',
														                            	  'name'  => 'data[DeliveryTimeSlot]['.$key.'][delivery_charge]',
														                                  'label' => false,
														                                  'type' => 'text',
														                                  'value' => $values['delivery_charge'])); ?>
																</div>
															</div> <?php



														} else { ?>
													
															<div class="clearfix margin-b-5">
																<div class="col-md-1 itemCont"> <?php
																	echo $this->Form->checkbox($value['DeliveryTimeSlot']['slot_id'],
								                                            array('class'=>'group-checkable',
								                                                  'name'=>'data[DeliveryTimeSlot]['.$key.'][slot_id]',
								                                                  'label'=>false,
								                                                  'hiddenField'=>false,
								                                                  'id'=>'test',
								                                                  'value'=> $value['TimeSlot']['id'])); ?>
																</div>
																<div class="col-md-6 itemCont"><?php echo $value['TimeSlot']['time_from']. ' to '.$value['TimeSlot']['time_to']; ?></div>
																<div class="col-md-3 itemCont"> <?php
																	echo $this->Form->input('DeliveryTimeSlot.delivery_charge',
														                            array('class' => 'form-control',
														                            	  'name'  => 'data[DeliveryTimeSlot]['.$key.'][delivery_charge]',
														                                  'label' => false,
														                                  'type' => 'text')); ?>
																</div>
															</div> <?php
														}
													} ?>
													
												</div>
											</div>
										</div>	
									</div>
								</div>
								<div class="tab-pane fade" id="comission">
									<div id="comissionError"></div>
									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Store Commission</label>
											<div class="col-md-6 col-lg-4"> <?php
												echo $this->Form->input('commission',
										                            array('class' => 'form-control',
										                                  'label' => false,
										                                  'type' => 'text')); ?>
											</div>
										</div>	
									</div>
								</div>
								<div class="tab-pane fade" id="invoice">
									<div class="row contain">
										<div class="col-md-offset-3 col-md-6 col-lg-4"> 
											<label id="invoiceError" class="error"></label>
										</div>
									</div>

									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Invoice Period</label>
											<div class="col-md-6 col-lg-4"><?php

												$invoiceTimes = array('15day'  => '15day',
																	  '30day' => '30day');

												echo $this->Form->input('invoice_period',
															array('type'=>'select',
															 		'class'=>'form-control',
															 		'options'=> array($invoiceTimes),
															 		'label'=> false)); ?>
											</div>
										</div>	
									</div>
								</div>
								<div class="tab-pane fade" id="MetaTags">
									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Meta Titles</label>
											<div class="col-md-6 col-lg-4"><?php

												echo $this->Form->input('meta_title',
										                            array('class' => 'form-control',
										                                  'label' => false)); ?>
											</div>
										</div>	
									</div>

									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Meta Keywords</label>
											<div class="col-md-6 col-lg-4"><?php

												echo $this->Form->input('meta_keywords',
										                            array('class' => 'form-control',
										                                  'label' => false)); ?>
											</div>
										</div>	
									</div>
									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Meta Discriptions</label>
											<div class="col-md-6 col-lg-4"><?php

												echo $this->Form->input('meta_description',
										                            array('class' => 'form-control',
										                                  'label' => false)); ?>
											</div>
										</div>	
									</div>
								</div>
							</div>
							<div class="form-actions">
							  	<div class="row">
								  	<div class="col-xs-5 col-xs-offset-3"> <?php
								  		echo $this->Form->hidden('id');
										echo $this->Form->hidden('User.id');
										echo $this->Form->hidden('Store.id');
										echo $this->Form->button('<i class="fa fa-check"></i> Submit',
				                              						array('class'=>'btn purple',
				                              							'onclick' => 'return validateStoreEdit();')); ?>
								  	</div>
							  	</div>  
							</div> <?php
						echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>