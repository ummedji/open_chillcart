
<div class="page-content-wrapper">
	<div class="page-content">
		<h3 class="page-title">Add Offer</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo $siteUrl.'/store/dashboards/index';?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/store/Storeoffers/index';?>">Store Offer</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">Add Offer</a>
				</li>
			</ul>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PORTLET-->
				<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-user"></i> Add Offer
						</div>
						<div class="tools">
							
						</div>
					</div>
					<div class="portlet-body form"><?php 
								echo $this->Form->create('Storeoffer',array('class'=>"form-horizontal"));
									?>			
							<div class="form-body">
                                <div class="form-group">
									<label class="col-md-3 control-label">Offer Percentge(%) <span class="star">*</span></label>
									<div class="col-md-6 col-lg-4"><?php
                            					echo $this->Form->input('Storeoffer.offer_percentage',
                            										array('class'=>'form-control',
                            											  'autocomplete' => 'off',
                            											   'type' => 'text',
                                                                          'label' => false,
                            											  'div' => false)); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Offer Price <span class="star">*</span></label>
									<div class="col-md-6 col-lg-4"><?php
                            					echo $this->Form->input('Storeoffer.offer_price',
                            										array('class'=>'form-control',
                            											  'autocomplete' => 'off',
                            											  'type' => 'text',
                                                                          'label' => false,
                            											  'div' => false)); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Date Range <span class="star">*</span></label>
									<div class="col-md-6 col-lg-4">
										<div class="input-group input-medium date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
											<?php
                            					echo $this->Form->input('Storeoffer.from_date',
                            										array('class'=>'form-control',
                            											  'autocomplete' => 'off',
                                                                          'label' => false,
                                                                          'readonly' => true,
                            											  'div' => false)); ?>
											<span class="input-group-addon"> to </span>
											<?php
                            					echo $this->Form->input('Storeoffer.to_date',
                            										array('class'=>'form-control',
                            											  'autocomplete' => 'off',
                                                                          'label' => false,
                                                                          'readonly' => true,
                            											  'div' => false)); ?>
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
