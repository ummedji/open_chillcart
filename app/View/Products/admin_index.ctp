<div class="contain">
	<div class="contain">
		<h3 class="page-title">Manage Items</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo $siteUrl.'/admin/dashboards/index';?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				
				<li>
					<a href="javascript:void(0);">Manage Items</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box grey-cascade">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-globe"></i>Managed Items
						</div>
						<div class="tools"> 
							
						</div>
					</div>
					<div class="portlet-body"> <?php

						echo $this->Form->create('Product', array(
													'enctype' => 'multipart/form-data',
													'url'=>array("controller"=>'products',
													'action'=>'importProduct',
													'admin' => false),'type'=>'file')); ?>
						<div class="row margin-b-10">
							<span class="col-md-8" id="addnewbutton_toggle">
								<div class="row">
									<span class="col-md-5"> 
										<?php echo $this->Form->input('Product.store_id',
												array('type'  => 'select',
													  'class' => 'form-control',
													  'options'=> array($stores),
													  'empty' => 'Select Store',
									 				  'label'=> false,
									 				  'div' => false));
										?>
									</span>
			               			<span class="col-md-5">
				               			<?php echo $this->form->input('excel', array('type' => 'file',
			            														'class' => 'form-control',
			            														'label' => false,
			            														'div' => false)); 
			            				?>
									</span>
			               			<span class="col-md-2"> 
			               				<?php  echo $this->Form->button('Save',array( 'Class' => 'btn btn-primary' ));
		               					echo $this->Form->end(); ?>
		               				</span>
		               			</div>
							</span>
	               			<span class="col-md-4 text-right">  <?php
	               				echo $this->Html->link('<i class="fa fa-download"></i> Download',
												array('action' => 'download','admin' => false),
												array('Class'=>'btn btn-primary',
													'escape'=>false)
												);
	               				 ?>
							</span> 
						</div>

						<?php echo $this->Form->create('Commons', array('class'=>'form-horizontal',
							'controller'=>'Commons','action'=>'multipleSelect')); ?>
						<div class="table-toolbar">
							
								<div id="send" style="display:none" class="pull-left">
									<div class="pull-right" id="addnewbutton_toggle"> <?php
										echo $this->Form->hidden("Model",array('value'=>'Product',
											'name'=>'data[name]'));
										if (!empty($products_detail)) {
											echo $this->Form->submit(__('Active'),
												array('class'=>'btn btn-success btn-sm',
													'name'=> 'actions',
													'div'=>false,
													'onclick'=>'return recorddelete(this);'
												)); ?> <?php
											echo $this->Form->submit(__('Deactive'),
												array('class'=>'btn btn-warning btn-sm',
													'name'=> 'actions',
													'div'=>false,
													'onclick'=>'return recorddelete(this);'
												)); ?> <?php
											echo $this->Form->submit(__('Delete'),
												array('Class'=>'btn btn-danger btn-sm',
													'name'=> 'actions',
													'div'=>false,
													'onclick'=>'return recorddelete(this);'
												));
										} ?>
									</div>
								</div>
								
									<div class="btn-group pull-right"><?php
										echo $this->Html->link('Add New <i class="fa fa-plus"></i>',
																array('controller'=>'Products',
																	   'action'=>'add'),
																array('class'=>'btn green',
																		'escape'=>false)
															  );
										?>
									</div>
							
						</div>
						<table class="table table-striped table-bordered table-hover checktable" id="sample_12">
							<thead>
								<tr>
									<th class="table-checkbox no-sort"><input type="checkbox" class="group-checkable test1" data-set="#sample_1 .checkboxes" /></th>
									<th>Item Name</th>
									<th>Store Name</th>
									<th>Main Category</th>
									<th>Sub Category</th>
									<th>Total Stock</th>
									<th class="no-sort">Status</th>
									<th class="no-sort">Action</th>
								</tr>
							</thead>
							<tbody><?php 
                            
                                foreach($products_detail as $key => $value){  ?>
									<tr class="odd gradeX" id="record<?php echo $value['Product']['id'];?>">
										<td> <?php
											echo $this->Form->checkbox($value['Product']['id'],
												array('class'=>'checkboxes test' ,
													'label'=>false,
													'hiddenField'=>false,
													'value'=> $value['Product']['id'])); ?> </td>
	                                    <td><?php echo $value['Product']['product_name'];?></td>
	                                    <td> <?php echo $value['Store']['store_name']; ?> </td>
										<td><?php echo $value['MainCategory']['category_name'];?></td>
										<td><?php echo $value['SubCategory']['category_name'];?></td>
										<td><?php echo $value['ProductDetail'][0]['quantity'];?></td>
										<td align="center"> <?php 
	                                            if($value['Product']['status'] == 0) {?>
	                                                <a title="Deactive" class="buttonStatus red_bck" href="javascript:void(0);" 
	                                                onclick="statusChange(<?php echo $value['Product']['id'];?>,'Product');">
	                                            <i class="fa fa-times"></i><!-- deactive --></a>
	                                            <?php } else if($value['Product']['status'] == 1){
	                                            ?>
	                                                <a title="active" class="buttonStatus" href="javascript:void(0);" 
	                                                onclick="statusChange(<?php echo $value['Product']['id'];?>,'Product');">
	                                            <i class="fa fa-check"></i></a>
	                                            <?php } else {?>
	                                                    <a title="Pending" class="buttonStatus yellow_bck" href="javascript:void(0);" 
	                                                onclick="statusChange(<?php echo $value['Product']['id'];?>,'Product');">
	                                            <i class="fa fa-exclamation"></i><!-- Pending --></a>
	                                            <?php }?>
	                                    </td>
										<td align="center">	<?php
											echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
																	array('controller'=>'Products',
																		   'action'=>'edit',
																			$value['Product']['id']),
																	array('class'=>'buttonEdit',
																			'escape'=>false));?>
	                                    <a class="buttonAction" href="javascript:void(0);"
	                                        onclick="deleteprocess(<?php echo $value['Product']['id'];?>,'Product');" ><i class="fa fa-trash-o"></i></a>
										</td>
									</tr><?php 
								}?>
							</tbody>
						</table><?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>