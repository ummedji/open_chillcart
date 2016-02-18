
<div class="page-content-wrapper">
	<div class="page-content">
		<h3 class="page-title">Add Category</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo $siteUrl.'/store/dashboards/index';?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/store/Categories/index';?>">Manage Category</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">Add Category</a>
				</li>
			</ul>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-user"></i> Add category
						</div>
						<div class="tools"></div>
					</div>
					<div class="portlet-body form"><?php 
								echo $this->Form->create('Category',array('class'=>"form-horizontal"));
									?>			
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Category Name <span class="star">*</span></label>
									<div class="col-md-6 col-lg-4"><?php
													echo $this->Form->input('category_name',
															array('class'=>'form-control',
																	'label'=>false)); ?>
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
					</div><?php echo $this->Form->end();?>
				</div>
			</div>
		</div>
	</div>
</div>
