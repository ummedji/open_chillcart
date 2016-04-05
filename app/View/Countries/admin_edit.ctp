<div class="contain">
	<div class="contain">
		<h3 class="page-title">Edit Country</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo $siteUrl.'/admin/dashboards/index';?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/admin/countries/index';?>">Manage Country</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">Edit Country</a>
				</li>
			</ul>
		</div>
		
		<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i> Edit Country
							</div>
							<div class="tools">
								
							</div>
						</div>
							<div class="portlet-body form"><?php 
								echo $this->Form->create('Country',array('class'=>"form-horizontal"));
									?>			
									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Country Name <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"><?php
												echo $this->Form->input('country_name',
																	array('class'=>'form-control',
																		  'label'=>false)); ?>
											 </div>
										</div>
										<div class="form-group">
												<label class="col-md-3 control-label">ISO<span class="star">*</span></label>
												<div class="col-md-6 col-lg-4"><?php
													echo $this->Form->input('iso',
															array('class'=>'form-control',
																	'label'=>false)); ?>
												</div>
										</div>
										<div class="form-group">
												<label class="col-md-3 control-label">Phone Code <span class="star">*</span></label>
												<div class="col-md-6 col-lg-4"><?php
													echo $this->Form->input('phone_code',
															array('class'=>'form-control',
																	'label'=>false)); ?>
												</div>
										</div>
										<div class="form-group">
												<label class="col-md-3 control-label">Currency Name<span class="star">*</span></label>
												<div class="col-md-6 col-lg-4"><?php
													echo $this->Form->input('currency_name',
															array('class'=>'form-control',
																	'label'=>false)); ?>
												</div>
										</div>
										<div class="form-group">
												<label class="col-md-3 control-label">Currency Code<span class="star">*</span></label>
												<div class="col-md-6 col-lg-4"><?php
													echo $this->Form->input('currency_code',
															array('class'=>'form-control',
																	'label'=>false)); ?>
												</div>
										</div>
										<div class="form-group">
												<label class="col-md-3 control-label">Currency Symbol<span class="star">*</span></label>
												<div class="col-md-6 col-lg-4"><?php
													echo $this->Form->input('currency_symbol',
															array('class'=>'form-control',
																	'label'=>false));
													echo $this->Form->hidden('id');?>
												</div>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9"> <?php
												echo $this->Form->button(__('Save'),
																array('class'=>'btn purple')); ?> <?php
												echo $this->Html->link('Cancel',
																array('action' => 'index'),
																array('Class'=>'btn default'));
												 ?>
											</div>
										</div>
									</div>														
						</div><?php 
								echo $this->Form->end();?>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
	</div>
</div>
