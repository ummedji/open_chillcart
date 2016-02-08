<div class="contain">
	<div class="contain">
		<h3 class="page-title">State</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="index.html">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">Location</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">Manage State</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box grey-cascade">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-globe"></i>Managed State
						</div>
						<div class="tools">
							
						</div>
					</div>
					<div class="portlet-body">
						<div class="table-toolbar">
							<div class="row">
								<div class="col-md-12">
									<div class="btn-group pull-right">
										<?php 
										echo $this->Html->link('Add New <i class="fa fa-plus"></i>',
																array('controller'=>'States',
																	   'action'=>'add'),
																array('class'=>'btn green',
																		'escape'=>false)
															  );
										?>
									</div>
								</div>
							</div>
						</div>
						<table class="table table-striped table-bordered table-hover" id="sample_12">
							<thead>
								<tr>
									<th class="table-checkbox"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/></th>
									<th>State Name</th>
									<th>Added Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody><?php 
															
								foreach ($state_list as $key => $value) {?>
								<tr class="odd gradeX">
									<td><input type="checkbox" class="checkboxes" 
													value="<?php echo $value['State']['id'];?>"/></td>
									<td><?php
									echo $this->Html->link($value['State']['state_name'],
																array('controller'=>'States',
																	   'action'=>'citylist',
																	   $value['State']['id'])
															  );?></td>
									<td><?php echo $value['State']['updated'];?></td>
									<td align="center"><a class="buttonStatus" href="javascript:void(0);"><i class="fa fa-check"></i></a></td>
									<td align="center"><?php
										echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
																array('controller'=>'states',
																	   'action'=>'edit',
																		$value['State']['id']),
																array('class'=>'buttonEdit',
																		'escape'=>false)
															  );
										echo $this->Form->postLink(
														$this->Html->tag('i', '<i class="fa fa-trash-o"></i>', 
														array('class'   => 'buttonAction')),
														array('action'  =>'delete', $value['State']['id']),
														array('escape'  =>false,
					        								  'confirm' => 'Are you sure?'));
									 ?>
									</td>
								</tr><?php 
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>