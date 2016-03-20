<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"> </script>
<div class="contain">
	<div class="contain">
		<h3 class="page-title">Manage Order</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><i class="fa fa-home"></i><a href="index.html">Home</a><i class="fa fa-angle-right"></i></li>
				<li><a href="#">Order</a><i class="fa fa-angle-right"></i></li>
				<li><a href="#">Manage Order</a></li>
			</ul>
		</div>
		<div class="alert alert-success" id="orderMessage" style="display:none;"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box grey-cascade">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-globe"></i>Manage Order
						</div>
						<div class="tools">									
						</div>
					</div>
					<div class="portlet-body">
						<div class="table-toolbar">
							<!--<div class="row">
								<div class="col-md-12">
									<div class="btn-group pull-right">
										<a href="addnewUser.html" id="sample_editable_1_new" class="btn green">
											Add New <i class="fa fa-plus"></i>
										</a>
									</div>
								</div>
							</div>-->
						</div>
						<table class="table table-striped table-bordered table-hover checktable1" id="sample_12">
							<thead>
								<tr>
									<th class="no-sort">S.No</th>
									<th>Date & Time</th>
									<th class="maxcolumn no-sort" width="25%">Order Information</th>
									<th>Restaurant Name</th>
									<th>Price</th>
									<th>Driver Name/ID </th>
									<th class="no-sort">Status</th>
									<th class="no-sort">Action</th>
								</tr>
							</thead>
							<tbody><?php 
	                            if (!empty($orderList)) {
	                            	$count = 1;
	                                foreach($orderList as $key => $value) {  ?>
										<tr id="orderList_<?php echo $value['Order']['id']; ?>" class="odd gradeX">
											<td> <?php echo $count ;?></td>
											<td> <?php echo $value['Order']['created'];?></td>
											<td> <?php    
												echo $this->Html->link($value['Order']['ref_number'],
																	array('action' => 'orderView',
																			$value['Order']['id'],
																			'dispatch'),
																	array('class' => 'no-padding blue bold'));  ?>
												<br/> <?php

												$restaurantAddress = $value['Store']['street_address'].', '.
																	$location[$value['Store']['store_zip']].', '.
																	$city[$value['Store']['store_city']].', '.
																	$states[$value['Store']['store_state']];

												$customerAddress = $value['Order']['address']. ', '.
																	$value['Order']['location_name']. ', '.
																	$value['Order']['city_name']. ', '.
																	$value['Order']['state_name']; ?>

												<span class="address orange-location"><?php
													echo stripslashes($restaurantAddress); ?></span></br></br>
												<span class="address blue-location"><?php 
													echo stripslashes($customerAddress); ?></span>
											</td>



											<td> <?php echo $value['Store']['store_name']; ?>  </td>
											<td> <?php 
												echo html_entity_decode($this->Number->currency($value['Order']['order_grand_total'], $siteCurrency)); ?></td>

											<td id="driver<?php echo $value['Order']['id']; ?>"> <?php
												if ($value['Driver']['driver_name']): ?>
													<span class="tddriver"> <?php 
														echo $value['Driver']['driver_name']; ?> 
													</span> <?php
												else:
													?> <span class="tdnotassign"> <?php echo 'Not Yet Assigned'; ?> </span> <?php
												endif; ?>
											</td>

											<td align="center" class="order_status">
												<span id="status<?php echo $value['Order']['id']; ?>" class="padding-b-5 col-sm-12"><?php echo $value['Order']['status']; ?></span> 
												<span class="padding-b-5 col-sm-12">
												<?php

													echo 'Others'; ?>
												</span>
												<div class="col-sm-12">	<?php

													echo $this->Form->input('orderStatus_'.$value['Order']['id'],
														array('type'=>'select',
															 'class'=>'form-control',
															 'options'=> array($status),
															 'onchange' => "orderStatus(".$value['Order']['id'].");",
															 'label'=> false,
															 'empty' => 'Select',
															 'value' => $value['Order']['status'])); ?>
												</div>

												<div class="contain" id="reason_<?php echo $value['Order']['id']; ?>"></div> 
											</td>

											<td align="center"><?php
												/*echo $this->Html->link('<i class="fa fa-search"></i>',
																		array('controller'=>'Orders',
																			   'action'=>'orderView',
																				$value['Order']['id']),
																		array('class'=>'buttonEdit',
																				'escape'=>false));*/ ?>

												<!-- <a class="buttonAction" href="javascript:void(0);"
		                                        onclick="deleteOrder(<?php echo $value['Order']['id'];?>);" ><i class="fa fa-trash-o"></i></a> -->


												<a id="icon<?php echo $value['Order']['id'];?>" class=" <?php echo (!$value['Driver']['id']) ? 'buttonEdit' : ''; ?>" href="<?php echo $siteUrl;?>/Drivers/availDrivers/<?php echo $value['Order']['id']; ?>"> <?php  echo (!$value['Driver']['id']) ? '<i class="fa fa-car"></i>' : ''; ?></a>

												<span id="orderDisclaim<?php echo $value['Order']['id'] ?>"> <?php 
													if ($value['Order']['status'] != 'Accepted' && $value['Order']['status'] != 'Delivered') { ?>
						                                <a class="view_Order buttonEdit" href="javascript:void(0);" onclick="return disclaimOrder(<?php echo $value['Order']['id']; ?>);"> <i class="fa fa-ban"></i> </a> <?php
						                            } ?>
						                        </span>

												<a class="track_order buttonEdit " href="javascript:void(0);" data-target="#trackid" class=""  data-toggle="modal" onclick="return viewTrack(<?php echo $value['Order']['id'];?>);"><i class="fa fa-search"></i></a>

						                        
											</td>
										</tr><?php $count++;
									}
	                            } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="trackid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				<h4 class="modal-title center" id="myModalLabel">Map</h4>
			</div>
			<div class="modal-body" >
				<div id="trackingDistance"> </div>
				<input type="hidden" id="trackOrderId" value=""/>
				<div id="initialmap">
					<?php 
	                  //echo $this->GoogleMap->map(); 
	                ?>
				</div>
				<div id="TrackingMap"></div>
			</div>
		</div>
	</div>
</div>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	trackings();
	updateOrderMap();
});

</script>