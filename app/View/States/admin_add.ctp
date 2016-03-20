<div class="contain">
	<div class="contain">
		<h3 class="page-title">Add State</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo $siteUrl.'/admin/dashboards/index';?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/admin/states/index';?>">Manage State</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">Add State</a>
				</li>
			</ul>
		</div>
		
		<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i> Add State
							</div>
							<div class="tools">
								
							</div>
						</div>
							<div class="portlet-body form"><?php 
								echo $this->Form->create('State',array('class'=>"form-horizontal"));
									?>			
									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Country Select <span class="star">*</span></label>
											<div class="col-md-6 col-lg-4"><?php
												echo $this->Form->input('country_id',
														array('type'  => 'select',
															  'class' => 'form-control',
															  'options'=> array($country_list),
															  'empty' => 'SelectCountry',
											 				  'label'=> false)); ?>
											 </div>
										</div>
											<div class="form-group">
												<label class="col-md-3 control-label">State Name <span class="star">*</span></label>
												<div class="col-md-6 col-lg-4"><?php
													echo $this->Form->input('state_name',
															array('class'=>'form-control',
																	'label'=>false)); ?>
												</div>
											</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9"> <?php
												echo $this->Form->button(__('<i class="fa fa-check"></i>Save'),
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
