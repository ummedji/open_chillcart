<div class="contain">
	<div class="contain">
		<h3 class="page-title">Report</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="index.html">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">Report</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box grey-cascade">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-globe"></i>Report
						</div>
						<div class="tools">
							
						</div>
					</div>
					<div class="portlet-body">
						<div class="table-toolbar">
						</div>
						<table class="table table-striped table-bordered table-hover checktable" id="sample_12">
							<thead>
								<tr>
									<th class="no-sort">S.No</th>
									<th>Order Id</th>
									<th>Customer Name</th>
									<th>Price</th>
									<th>Payment Type</th>
									<th>Ordered Date</th>
									<th>Delivered Date</th>
									<th>Driver Name / Phone</th>
									<th class="no-sort">Track</th>
								</tr>
							</thead>
							<tbody><?php 
							
										$count = 1;
								foreach ($order_list as $key => $value) {
									//echo "<pre>";print_r($order_list);exit();?>
								<tr class="odd gradeX">
									<td><?php echo $count;?></td>
									<td><?php
									echo $this->Html->link($value['Order']['ref_number'],
																array('controller'=>'Orders',
																	   'action'=>'reportOrderView',
																	   $value['Order']['id'])
															  );?></td>
									<td><?php echo $value['Order']['customer_name'];?></td>
									<td><?php echo $value['Order']['order_grand_total'];?></td>
									<td><?php echo $value['Order']['payment_type'];?></td>
									<td><?php echo $value['Order']['created'];?></td>
									<td><?php echo $value['Order']['delivery_date']; ?></td>
									<td><?php echo $value['Driver']['driver_name'].' / '.$value['Driver']['driver_phone']; ?></td>
									<td> 
										<a class="buttonAssign" href="javascript:void(0);"  onclick="return trackOrder(<?php echo $value['Order']['id']; ?>);"><i class="fa fa-search"></i></a>
								</tr><?php $count ++;
								}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reportpopup" class="modal fade" >
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Track Order</h4>
      </div>
      <div id="trackingContent" class="modal-body"> 
    </div>
</div>
</div>
</div>


