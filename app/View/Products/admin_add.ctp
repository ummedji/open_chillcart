<div class="contain">
	<div class="contain">
		<h3 class="page-title">Add Item</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo $siteUrl.'/admin/dashboards/index';?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/admin/products/index';?>">Manage Item</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="javascript:void(0);">Add Item</a>
				</li>
			</ul>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PORTLET-->
				<div class="portlet box blue-hoki">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-user"></i> Add Item
						</div>
						<div class="tools">
							
						</div>
					</div>
					<div class="portlet-body form"><?php 
						echo $this->Form->create('Product',array('class' =>"form-horizontal",
																 'type'  => 'file')); ?>			
							<div class="form-body">

								<div class="form-group">
									<label class="col-md-3 control-label">Store<span class="star">*</span></label>
									<div class="col-md-6 col-lg-4"> <?php
										echo $this->Form->input('Product.store_id',
												array('type'  => 'select',
													  'class' => 'form-control',
													  'options'=> array($stores),
													  'onchange' => 'batchCodeCheck();',
													  'empty' => 'Select Store',                     
									 				  'label'=> false)); ?>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Item Name <span class="star">*</span></label>
									<div class="col-md-6 col-lg-4"><?php
										echo $this->Form->input('Product.product_name',
															array('class' => 'form-control',
																  'label' => false));
										echo $this->Form->input('Batch', 
															array('id' => 'batchCodes',
																'type' => 'hidden')); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Category Name <span class="star">*</span></label>
									<div class="col-md-6 col-lg-4"><?php
										echo $this->Form->input('Product.category_id',
												array('type'  => 'select',
													  'class' => 'form-control',
													  'options'=> array($category_list),
                                                      'onchange' => 'subcatList();',
													  'empty' => 'Select Category',                     
									 				  'label'=> false)); ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Sub Category Name <span class="star">*</span></label>
									<div class="col-md-6 col-lg-4"><?php
										echo $this->Form->input('Product.sub_category_id',
												array('type'  => 'select',
													  'class' => 'form-control',
													  'options'=> array(),
                                                      'empty' => 'Select SubCategory',                      
									 				  'label'=> false)); ?>
									</div>
								</div>
								<!-- <div class="form-group">
									<label class="col-md-3 control-label">Brands</label>
									<div class="col-md-6 col-lg-4"><?php
										echo $this->Form->input('Product.brand_id',
												array('type'  => 'select',
													  'class' => 'form-control',
													  'options'=> array($brand_list),
													  'empty' => 'Select Brand',
									 				  'label'=> false)); ?>
									</div>
								</div> -->
								<div class="form-group">
									<label class="col-md-3 control-label">Price Option <span class="star">*</span></label>
									<div class="col-md-6 col-lg-4">
										<div class="radio-list">                                        
											<label class="radio-inline"> <?php 
                                                $option1 = array('single'  => 'single');
                                                $option2 = array('multiple'   => 'multiple');
	                                           	echo $this->Form->radio('Product.price_option',$option1,
	                                           							array('checked'=>$option1,
	                                           								'label'=>false,
	                                           								'legend'=>false,
                                             	                            'checked' => 'checked',
	                                           								'hiddenField'=>false)); ?>
                                            </label>
											<label class="radio-inline"><?php
                                            	echo $this->Form->radio('Product.price_option',$option2,
	                                           							array('checked'=>$option2,
	                                           								'label'=>false,
	                                           								'legend'=>false,
	                                           								'hiddenField'=>false)); ?>
                                             </label>
										</div>
									</div>
								</div>
								<div class="form-group"  id="single">
									<label class="col-md-3 control-label">Price <span class="star">*</span></label>
									<div class="col-md-8 col-lg-8">
										<div class="row">
											<div class="col-lg-7">
												<div class="row">
													<div class="col-md-6"><?php
														echo $this->Form->input('ProductDetail.sub_name',
																array('class'=>'form-control',
		                                                              'placeholder'=>'Product Name',
		                                                              'type' => 'text',
																	  'label'=>false)); ?>
													</div>
													<div class="col-md-3"><?php
														echo $this->Form->input('ProductDetail.orginal_price',
																array('class'=>'form-control singleValidate',
		                                                              'placeholder'=>'Price',
		                                                              'data-attr'=>'original price',
		                                                              'type' => 'text',
																	  'label'=>false)); ?>
													</div>
													<div class="col-md-3"><?php
														echo $this->Form->input('ProductDetail.compare_price',
																array('class'=>'form-control singleValidate',
		                                                                'placeholder'=>'Sale',
		                                                                'type' => 'text',
		                                                                'data-attr'=>'compare price',
		                                                                'onkeyup'=>'valueCheck();',
																		'label'=>false)); ?>
													</div>
												</div>
											</div>
											<div class="col-lg-5">
												<div class="row">
		          	                                <div class="col-md-6"><?php
														echo $this->Form->input('ProductDetail.quantity',
																array('class'=>'form-control singleValidate',
		                                                              'placeholder'=>'Quantity',
		                                                              'data-attr'=>'quantity',
		                                                              'type' => 'text',
																	  'label'=>false)); ?>
													</div>
		                                            <div class="col-md-6"><?php
														echo $this->Form->input('ProductDetail.product_code',
																array('class'=>'form-control singleValidate',
		                                                                'placeholder'=>'Batchcode',
		                                                                'data-attr'=>'batch code',
																		'label'=>false)); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group" id="multiple">
									<label class="col-md-3 control-label">&nbsp;</label>
									<div class="col-md-8 col-lg-8">
										<div class="row addPriceTop">
											<div class="col-lg-7">
												<div class="row">
													<div class="col-md-6"><?php
														echo $this->Form->input('ProductDetail.sub_name',
																array('class'=>'form-control multipleValidate',
	                                                                    'placeholder'=>'Product Name',
	                                                                    'data-attr'=>'product name',
	                                                                    'name' => 'data[ProductDetail][0][sub_name]',
																		'label'=>false)); ?>
													</div>
													<div class="col-md-3"><?php
														echo $this->Form->input('ProductDetail.orginal_price',
																array('class'=>'form-control multipleValidate',
		                                                                 'placeholder'=>'Price',
		                                                                 'type' => 'text',
		                                                                 'data-attr'=>'original price',
		                                                                 'name' => 'data[ProductDetail][0][orginal_price]',
																		 'label'=>false)); ?>
													</div>
													<div class="col-md-3"><?php
														echo $this->Form->input('ProductDetail.compare_price',
																	array('class'=>'form-control multipleValidate',
		                                                                    'placeholder'=>'Sale',
		                                                                    'type' => 'text',
		                                                                    'data-attr'=>'compare price',
		                                                                    'name' => 'data[ProductDetail][0][compare_price]',
																			'label'=>false)); ?>
													</div>
												</div>
											</div>
											<div class="col-lg-5">
												<div class="row">

													<div class="col-md-5"><?php
														echo $this->Form->input('ProductDetail.quantity',
																array('class'=>'form-control multipleValidate',
	                                                                    'placeholder'=>'Quantity',
	                                                                    'type' => 'text',
	                                                                    'data-attr'=>'quantity',
	                                                                    'name' => 'data[ProductDetail][0][quantity]',
																		'label'=>false)); ?>
													</div>
													<div class="col-md-5"><?php
														echo $this->Form->input('ProductDetail.product_code',
															array('class'=>'form-control multipleValidate',
																'placeholder'=>'Batchcode',
																'data-attr'=>'batch code',
																'name' => 'data[ProductDetail][0][product_code]',
																'label'=>false)); ?>
													</div>
												</div>
											</div>
										</div>
										<div id="moreOption"></div>
										<a class="addPrice btn green" href="javascript:void(0);" onclick="multipleOption();"><i class="fa fa-plus"></i> Add Price</a>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Image <span class="star"></span></label>
									<div class="col-md-6 col-lg-4"><?php
                                         echo $this->Form->input("Product.product_image", 
                                         				array("label"=>false,
				                                                //"onchange"=>"showimage(event)",
				                                                "type"=>"file",
				                                                "name"=>"data[ProductImage][]")); ?>
				                        <div id="multipleImage"></div>
				                        <a onclick="multipleimage();" href="javascript:void(0);" class="addPrice btn green margin-t-15"><i class="fa fa-plus"></i> Add Image</a>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Description <span class="star"></span></label>
									<div class="col-md-6 col-lg-4"><?php
										echo $this->Form->input('Product.product_description',
														array('class'=>'form-control',
																'label'=>false)); ?>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9"><?php
											echo $this->Form->button(__('<i class="fa fa-check"></i>Save'),
															array('class'=>'btn purple',
																  'onclick'=>'return optionValidate();')); ?> <?php
											echo $this->Html->link('Cancel',
															array('action' => 'index'),
															array('Class'=>'btn default')); ?>
										</div>
									</div>
								</div>
							</div><?php
						echo $this->Form->end(); ?>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
		</div>
	</div>
</div>