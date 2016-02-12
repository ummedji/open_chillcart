<div class="contain">
	<div class="contain">
		<h3 class="page-title">EditDeal</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo $siteUrl.'/admin/dashboards/index'; ?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/admin/deals/index'; ?>">Deal</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">EditDeal</a>
				</li>
			</ul>
		</div>
			
		<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i> Edit Deal
							</div>
							<div class="tools">
								
							</div>
						</div>
						<div class="portlet-body form"> <?php
							echo $this->Form->create('Deal', array('class' => 'form-horizontal')); ?>
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Store<span class="star">*</span></label>
										<div class="col-md-6 col-lg-4"> <?php
											echo $this->Form->input('store_id',
													array('type'  	=> 'select',
														  'class' 	=> 'form-control',
														  'options'	=> array($stores),
														  'empty' 	=> 'Select Store',
										 				  'label' 	=> false,
										 				  'onchange' => 'productList();')); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Deals Name <span class="star">*</span></label>
										<div class="col-md-6 col-lg-4"> <?php
											echo $this->Form->input('deal_name',
														array('class' => 'form-control',
															  'label' => false)); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Product Name <span class="star">*</span></label>
										<div class="col-md-6 col-lg-4"> <?php
											echo $this->Form->input('main_product',
													array('type'  => 'select',
														  'class' => 'form-control',
														  'empty' => 'Select Product', 
														  'options'	=> array($products),                    
										 				  'label' => false)); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Product for Deal <span class="star">*</span></label>
										<div class="col-md-6 col-lg-4"> <?php
											echo $this->Form->input('sub_product',
													array('type'  => 'select',
														  'class' => 'form-control',
														  'empty' => 'Select Product',  
														  'options'	=> array($subproducts),                   
										 				  'label' => false));
										 	echo $this->Form->hidden('id'); ?>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9"> <?php
								  			echo $this->Form->button('<i class="fa fa-check"></i> Submit',
					                              				array('class'=>'btn purple')); ?> <?php
					                        echo $this->Html->link('Cancel',
																array('action' => 'index'),
																array('Class'=>'btn default')); ?>
										</div>
									</div>
								</div> <?php
							echo $this->Form->end(); ?>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
	</div>
</div>