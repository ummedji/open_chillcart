<div class="contain">
	<div class="contain">
		<h3 class="page-title">Order</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo $siteUrl.'/admin/Dashboards/index'; ?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/admin/Orders/index'; ?>">Order</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">Order Details <?php echo $order_detail['Order']['ref_number'];?></a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<!-- Begin: life time stats -->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-basket font-green-sharp"></i>
							<span class="caption-subject font-green-sharp bold uppercase">
							Order: <?php echo $order_detail['Order']['ref_number'];?></span>
							<span class="caption-helper">
							<?php echo $order_detail['Order']['created'];?></span>
						</div>
						<div class="actions">
							<a href="<?php echo ($page) ? $siteUrl.'/admin/Orders/order' : $siteUrl.'/admin/Orders/index'; ?>" class="btn btn-default btn-circle">
							<i class="fa fa-angle-left"></i>
							<span class="hidden-480">
							Back </span>
							</a>									
						</div>
					</div>
					<div class="portlet-body">
						<div class="row">
							<div class="col-md-6 order_detail_left">
								<div class="table-scrollable">
									<table class="table table-striped table-bordered table-hover">
										<tbody><tr>
											<td valign="top" align="right"><label>Store Name &amp; Address</label></td>
											<td width="60%">
												<div class="address-detail">
													<div class="resName"> <?php
														echo $order_detail['ShoppingCart'][0]['Store']['store_name'];?>
													</div> <?php
													echo $order_detail['ShoppingCart'][0]['Store']['street_address'].', '.
														 	$location[$order_detail['ShoppingCart'][0]['Store']['store_zip']].', '.
														 	$cities[$order_detail['ShoppingCart'][0]['Store']['store_city']].', '.
														 	$states[$order_detail['ShoppingCart'][0]['Store']['store_state']].'.'; ?>
												</div>
											</td>
										</tr>
										<tr>
											<td valign="top" align="right"><label>Customer Address </label></td>
											<td width="60%">
												<div class="address-detail"> <?php 
													echo $order_detail['Order']['address'].', '.
														 $order_detail['Order']['landmark'].', '.
														 $order_detail['Order']['location_name'].', '.
														 $order_detail['Order']['city_name'].', '.
														 $order_detail['Order']['state_name'].'.';

												?></div>	
											</td>
										</tr>
										<tr>
											<td valign="top" align="right"><label><?php
													echo $orders_list['Order']['order_type'].' Date'; ?></label></td>
											<td width="60%">
												<div class="address-detail">
												<?php echo $order_detail['Order']['delivery_date'];?></div>	
											</td>
										</tr>
										<tr>
											<td valign="top" align="right"><label>Customer Name </label></td>
											<td width="60%">
												<div class="address-detail">
												<?php echo $order_detail['Order']['customer_name'];?></div>	
											</td>
										</tr>
										<tr>
											<td valign="top" align="right"><label>E-mail Address</label></td>
											<td width="60%">
												<div class="address-detail">
												<?php echo $order_detail['Order']['customer_email'];?></div>	
											</td>
										</tr>							
									</tbody></table>
								</div>
							</div>
							<div class="col-md-5 pull-right order_detail_right">
								<div class="table-scrollable">
									<table class="table table-striped table-bordered table-hover">
										<tbody><tr>
											<td valign="top" align="right"><label>Phone no</label></td>
											<td>
												<div class="address-detail">
												<?php echo $order_detail['Order']['customer_phone'];?></div></div>	
											</td>
										</tr>
										<tr>
											<td valign="top" align="right"><label>Payment type</label></td>
											<td>
												<div class="address-detail">	
												<?php echo $order_detail['Order']['payment_type'];?></div>
											</td>						     				
										</tr>
										<tr>
											<td valign="top" align="right"><label>Payment Status</label></td>
											<td>
												<div class="address-detail">
													<?php if($order_detail['Order']['payment_method'] == 'unpaid'){
															echo 'Not Paid';
													} else {
														echo $order_detail['Order']['payment_method'];
													}?></div>
											</td>
										</tr>
										<tr>
											<td valign="top" align="right"><label>Order Status</label></td>
											<td>
												<div class="address-detail"> <?php
												echo $order_detail['Order']['status'];?></div>	
											</td>
										</tr> 
										<tr>
											<td valign="top" align="right"><label> <?php
												echo $order_detail['Order']['order_type'].' Slot'; ?></label></td>
											<td>
												<div class="address-detail">
													<?php echo $order_detail['Order']['delivery_time_slot'];?></div>
											</td>
										</tr>

										<tr>
											<td valign="top" align="right"><label> Order Type </label></td>
											<td>
												<div class="address-detail">
													<?php echo $order_detail['Order']['order_type'];?></div>
											</td>
										</tr>

										<?php

										if ($order_detail['Order']['order_description']) {  ?>
											<tr>
												<td valign="top" align="right"><label>Instructions</label></td>
												<td>
													<div class="address-detail">
														<?php echo $order_detail['Order']['order_description'];?></div>	
												</td>
											</tr> <?php 
										} 

										if ($order_detail['Driver']['driver_name']) {  ?>
											<tr>
												<td valign="top" align="right"><label>Driver name / Phone</label></td>
												<td>
													<div class="address-detail"> <?php 
														echo $order_detail['Driver']['driver_name'].' / '.
															$order_detail['Driver']['driver_phone']; ?></div>	
												</td>
											</tr> <?php
										} ?>
									</tbody></table>
								</div>
							</div>
							<div class="clear_both"></div>
							<div class="order_detail_bottom col-sm-12">
								<div class="table-scrollable">
									<table border="1" class="table table-hover table-striped table-bordered no-margin">
										<thead>
										<tr>
											<th>S.No</th>
											<th>Menu Name</th>
											<th class="text-center">Quantity</th>
											<th>Price</th>
											<th>Total Price </th>
										</tr>
							
										</thead>
										<tbody><?php 
										if(!empty($order_detail)){
											$count = 1;
											foreach($order_detail['ShoppingCart'] as $key => $value) {//echo "<pre>";print_r($value) ?>
												<tr>
													<td><?php echo $count;?></td>
													<td>
														<span class="col-md-12 no-padding">
															<div class="pull-left">
																<img class="tabel_img margin-r-10" alt="<?php echo $value['product_name']; ?>" src="<?php echo $cdn; ?>/stores/products/carts/<?php echo $value['product_image']; ?>" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/images/noimage.jpg"; ?>'"> 
															</div><?php
															echo $value['product_name']; ?>
															<br><?php
															if (!empty($value['product_description'])) { ?>
																<span class="table-addon colorgray"><?php echo $value['product_description']; ?></span> <?php
															} ?> 

														</span> 
													</td>
													<td class="price text-center"><?php
													echo $value['product_quantity']; ?>
													</td>
													<td class="price"><?php
													echo html_entity_decode($this->Number->currency($value['product_price'], $siteCurrency)); ?>
													</td>
													<td class="price"><?php
														echo html_entity_decode($this->Number->currency($value['product_total_price'], $siteCurrency)); ?>
													</td>

												</tr><?php $count++;
											}?>
										<tr>
											<td align="right" colspan="4">Subtotal</td>
											<td class="price"><?php
												echo html_entity_decode($this->Number->currency($order_detail['Order']['order_sub_total'], $siteCurrency)); ?>
											</td>
										</tr><?php 

									if ($order_detail['Order']['offer_amount'] != 0) {?>
										<tr class="grandprice">
											<td class="text-right" colspan="4">Offer</td>
											<td class="price"><?php
												echo html_entity_decode($this->Number->currency($order_detail['Order']['offer_amount'], $siteCurrency)); ?>
											</td>
										</tr> <?php
									}?>
									<?php if ($order_detail['Order']['tax_amount'] != 0) {?>
										<tr>
											<td align="right" colspan="4">Tax</td>
											<td class="price"><?php
												echo html_entity_decode($this->Number->currency($order_detail['Order']['tax_amount'], $siteCurrency)); ?>
											</td>
												
										</tr><?php } ?>
									<?php if ($order_detail['Order']['delivery_charge'] != 0) {?>
										<tr>
											<td align="right" colspan="4">Delivery Charge</td>
											<td class="price"><?php
												echo html_entity_decode($this->Number->currency($order_detail['Order']['delivery_charge'], $siteCurrency)); ?>
											</td>
										</tr>
									<?php } ?>																
										<tr>
											<td align="right" colspan="4">Total</td>
											<td class="price"><?php
												echo html_entity_decode($this->Number->currency($order_detail['Order']['order_grand_total'], $siteCurrency)); ?>
											</td>
												

										</tr><?php 
										} else {
											echo "No Record Found";
											}?>
										</tbody>
									</table>
								</div>
							</div>
						</div> 
					</div>
				</div>
				<!-- End: life time stats -->
			</div>
		</div>
	</div>
</div>
