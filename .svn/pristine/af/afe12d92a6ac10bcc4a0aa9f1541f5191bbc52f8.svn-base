<div class="contain">
	<div class="contain">
		<h3 class="page-title">Edit Voucher</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo $siteUrl.'/admin/dashboards/index';?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/admin/Vouchers/index';?>">Manage Voucher</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">Edit Voucher</a>
				</li>
			</ul>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PORTLET-->
				<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-user"></i> Edit Voucher
						</div>
						<div class="tools">
							
						</div>
					</div>
					<div class="portlet-body form">
						<form action="#" id="form-username1" class="form-horizontal" method="POST">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Voucher Code <span class="star">*</span></label>
									<div class="col-md-6 col-lg-4"><?php
                    					echo $this->Form->input('Voucher.voucher_code',
                    										array('class'=>'form-control',
                    											  'autocomplete' => 'off',
                                                                  'label' => false,
                    											  'div' => false)); 
                                        echo $this->Form->hidden('Voucher.id');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Type Of Use <span class="star">*</span></label>
									<div class="col-md-6 col-lg-4">
										<div class="radio-list">
											<label class="radio-inline"><?php 
                                        $option1 = array('single'  => 'single');
                                        $option2 = array('multiple'   => 'multiple');
                                       	echo $this->Form->radio('Voucher.type_offer',$option1,
                                       							array('checked'=>$option1,
                                       								'label'=>false,
                                       								'legend'=>false,                                             	                           
                                       								'hiddenField'=>false)); ?>
                                            </label>
											<label class="radio-inline"><?php
                                            echo $this->Form->radio('Voucher.type_offer',$option2,
                                       							array('checked'=>$option1,
                                       								'label'=>false,
                                       								'legend'=>false,                                             	                           
                                       								'hiddenField'=>false)); ?>
                                             </label>
										</div>
									</div>
								</div>	
								<div class="form-group">
									<label class="col-md-3 control-label">Type of Offer <span class="star">*</span></label>
									<div class="col-md-8 col-lg-8">
										<div class="radio-list">
											<label class="radio-inline"><?php 
                                        $option1 = array('price'  => 'price');
                                        $option2 = array('percentage'   => 'percentage');
                                       	echo $this->Form->radio('Voucher.offer_mode',$option1,
                                       							array('checked'=>$option1,
                                       								'label'=>false,
                                       								'legend'=>false,                                             	                           
                                       								'hiddenField'=>false)); ?>
                                            </label>
											<label class="radio-inline"><?php
                                    	echo $this->Form->radio('Voucher.offer_mode',$option2,
                                       							array('checked'=>$option2,
                                       								'label'=>false,
                                       								'legend'=>false,
                                       								'hiddenField'=>false)); ?>
                                             </label>
                                            <div class="row">
	                                            <div class="col-md-4">
													<?php
		                    							echo $this->Form->input('Voucher.offer_value',
		                    										array('class'=>'form-control',
		                    											  'autocomplete' => 'off',
		                                                                  'label' => false,
		                    											  'div' => false)); 
		                    						?>
	                    						</div>
                    						</div>
										</div>
									</div>
								</div>	
								<div class="form-group">
									<label class="control-label col-md-3">Date Range <span class="star">*</span></label>
									<div class="col-md-6 col-lg-4">
										<div class="input-group input-medium date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
											<?php
                    					echo $this->Form->input('Voucher.from_date',
                    										array('class'=>'form-control',
                    											  'autocomplete' => 'off',
                                                                  'label' => false,
                    											  'div' => false)); ?>
											<span class="input-group-addon"> to </span><?php
                    					echo $this->Form->input('Voucher.to_date',
                    										array('class'=>'form-control',
                    											  'autocomplete' => 'off',
                                                                  'label' => false,
                    											  'div' => false)); 
                                       ?>
										</div>
										<!-- /input-group -->
									</div>
								</div>
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9"><?php
										echo $this->Form->button(__('<i class="fa fa-check"></i>Submit'),array('class'=>'btn purple')); 
										echo $this->Html->link('Cancel',
														array('action' => 'index'),
														array('Class'=>'btn default')); ?>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- END PORTLET-->
			</div>
		</div>
	</div>
</div>