<div class="modal-dialog modal-md add_adress_parent" >
	<div class="modal-content">
		<div class="css-popup">
		<div class="add-new-card-popup">
		<div class="text-center mrgTB30">
		<h2 class="blgrtitle "><span class="blackborder">Edit</span> <span class="greenborder">Address</span></h2>
		</div>
		<div class="content-popup">
		<?php
        echo $this->Form->create("CustomerAddressBook",
                                    array("id"=>'EditCustomerAddressBook',
                                          "url"=>array("controller"=>'Customers','action'=>'editAddressBook')));?>
		<div class="form-group">
		<label class="sr-only"><?php echo __('Address Title', true); ?></label>
		<?php
						echo $this->Form->input('address_title',
								array('class'=>'form-control titleerorr',
									'id' => 'CustomerAddressBookAddressTitles',
										'label'=>false,'placeholder'=>"Address Title")); ?>
		<!-- <input type="email" class="form-control" id="sr-only" placeholder="Address Title"> -->
		</div>
		<div class="form-group">
		<label class="sr-only"><?php echo __('Street Address', true); ?></label>
		<?php
						echo $this->Form->input('address',
								array('class'=>'form-control',
										'id'=>'street',
										'type' => 'text',
										'label'=>false,'placeholder'=>"Street Address")); ?>
		<!-- <input type="password" class="form-control" placeholder="Street Address"> -->
		</div>

		<div class="form-group">
		<label class="sr-only"><?php echo __('Apt/Suite/Building', true); ?></label>
		<?php
						echo $this->Form->input('landmark',
								array('class'=>'form-control',
									'id'=>'build',
										'label'=>false,'placeholder'=>"Landmark")); ?>
		<!-- <input type="password" class="form-control" placeholder="Landmark"> -->
		</div>
		<div class="form-group">
		<label class="sr-only">Country</label>
		<input type="password" class="form-control" placeholder="Country">
		</div>
		

		<div class="form-group">
		<label class="sr-only"><?php echo __('State', true); ?></label>
		<?php
						echo $this->Form->input('state_id',
							array('type'  => 'select',
								  'class' => 'form-control',
								  'id' => 'CustomerAddressBookStateIds',
								  'options'=> array($state_list),
                                  'onchange' => 'cityFillter();',
								  'empty' => __('Select State'),
				 				  'label'=> false,'placeholder'=>"State")); ?>
		<!-- <input type="password" class="form-control" placeholder="State"> -->
		</div>

		<div class="form-group">
		<label class="sr-only"><?php echo __('city', true); ?></label>
		<?php
						echo $this->Form->input('city_id',
							array('type'  => 'select',
								  'class' => 'form-control',
								  'id' => 'CustomerAddressBookCityIds',
								  'options'=> array($city_list),
                                  'onchange' => 'locationFillter();',
								  'empty' => __('Select City'),
				 				  'label'=> false,'placeholder'=>"City")); ?>
		<!-- <input type="password" class="form-control" placeholder="City"> -->
		</div>

		<div class="form-group">
		<label class="sr-only"><?php echo __('Area/zipcode', true); ?></label>
		<?php
						echo $this->Form->input('location_id',
								array('type'  => 'select',
									  'class' => 'form-control',
									  'id' => 'CustomerAddressBookLocationIds',
									  'options'=> array($location_list),
									  'empty' => __('Select Area/Zip'),
					 				  'label'=> false,'placeholder'=>"Pincode"));

                         echo $this->Form->hidden('id'); ?>
		<!-- <input type="password" class="form-control" placeholder="Pincode"> -->
		</div>
		<div class="form-group">
		<label class="sr-only"><?php echo __('Address Phone', true); ?></label>
		<?php
						echo $this->Form->input('address_phone',
								array('class'=>'form-control',
									'id'=>'phone',
									'type'=>'text',
										'label'=>false,'placeholder'=>"Phone Number")); ?>
		<!-- <input type="password" class="form-control" placeholder="Phone Number"> -->
		</div>
		<?php			echo $this->Form->button(__('Submit'),
								array("label"=>false,
										"class"=>"btn btn-primary",
										'onclick' => 'return validateAddress();',
										"type"=>'submit'));  
		echo $this->Form->end(); ?>

		</div>

		</div>

		</div>
	</div>
</div>
