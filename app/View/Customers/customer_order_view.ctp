<div class="container searchshopContent">
	<div class="col-md-12">
		<div class="myorderTab">
			<h1 class="clearfix"> <?php echo __('Order Details Page', true); ?> 
				<span class="pull-right text-right">
					<span id='sidebar'>
						<a class="btn btn-warning" href="<?php echo $siteUrl.'/customer/Customers/pdf/'.$order_detail['Order']['id'];?>" target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp; <span class="hidden-xs hidden-sm"> <?php echo __('Download in PDF', true); ?></span> </a>
						<a class="btn btn-info" href="javascript:void(0);" onclick="documentPrints();"><i class="fa fa-print"></i>&nbsp; <span class="hidden-xs hidden-sm"> <?php echo __('Print Page', true); ?></span> </a>				
					</span>
					<a class="btn btn-default" href="<?php echo $siteUrl.'/customer/Customers/myaccount'; ?>"><i class="fa fa-angle-double-left"></i>&nbsp; <span class="hidden-xs hidden-sm"> <?php echo __('Back to Order History', true); ?></span></a>
				</span>
				
			</h1> 
			<div class="orderTop clearfix">
				<div class="orderId"><span> <?php echo __('Order ID'); ?> :</span> <?php 
				echo $order_detail['Order']['ref_number'];?></div>
				<div class="orderviewDate"><span> <?php echo __('Order Date', true); ?> :</span><?php 
				echo $order_detail['Order']['created'];?>
				</div>
			</div>
			<div class="orderInfo clearfix">
				<div class="cardDetailHead"> <?php echo __('Order Info', true); ?></div>
				<ul class="col-md-6">
					
					<li><span class="col-md-4 col-sm-4 col-xs-12"> <?php echo __('Customer Email', true); ?></span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i> <?php 
				echo $order_detail['Order']['customer_email'];?></span></li>
					<li><span class="col-md-4 col-sm-4 col-xs-12"> <?php echo __('Phone Number', true); ?></span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i> <?php 
				echo $order_detail['Order']['customer_phone'];?></span></li>
				    
					 <?php

					if ($order_detail['Order']['driver_id']) { ?>

						 <li><span class="col-md-4 col-sm-4 col-xs-12"> <?php echo __('Driver Name/ Phone', true); ?></span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i> <?php 
					  		echo $order_detail['Driver']['driver_name']. ' / '.$order_detail['Driver']['driver_phone'];	?></span></li> <?php 
					} 
					if ($order_detail['Order']['order_description']) { ?>

						 <li><span class="col-md-4 col-sm-4 col-xs-12"> <?php echo __('Order Description', true); ?> </span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i> <?php 
					  		echo $order_detail['Order']['order_description']; ?></span></li> <?php 
					} 

					?>

					<li><span class="col-md-4 col-sm-4 col-xs-12"><?php echo __($order_detail['Order']['order_type']).' Date'; ?> </span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i> <?php
                echo $order_detail['Order']['delivery_date'];?></span></li>


					<li><span class="col-md-4 col-sm-4 col-xs-12"><?php echo __($order_detail['Order']['order_type']). ' '. __('Time'); ?> </span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i> <?php
                echo $order_detail['Order']['delivery_time_slot'];?></span></li>

					<li><span class="col-md-4 col-sm-4 col-xs-12"> <?php echo __('Order Type', true); ?> </span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i> <?php
							echo __($order_detail['Order']['order_type']); ?></span></li>

	                <li><span class="col-md-4 col-sm-4 col-xs-12"> <?php echo __('Address', true); ?></span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i> <?php
						$address  = $order_detail['Order']['address'].', ';
						$address .= ($order_detail['Order']['landmark']) ? $order_detail['Order']['landmark'] : '';
						$address .= $order_detail['Order']['location_name'].', '.$order_detail['Order']['city_name'].', '.
							 $order_detail['Order']['state_name'].'.'; 

						echo $address; ?></span>
					</li>

				</ul>
				<ul class="col-md-6">
					 <?php

					if ($order_detail['Order']['delivered_time']) { ?>

						<li><span class="col-md-4 col-sm-4 col-xs-12"> <?php echo __('Delivery Time', true); ?></span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i> <?php 
							echo $order_detail['Order']['delivered_time'];?></span></li> <?php
					} ?>
					
					<li><span class="col-md-4 col-sm-4 col-xs-12"> <?php echo __('Payment Method', true); ?></span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i> <?php 
				echo __($order_detail['Order']['payment_type']); ?></span></li>
					<li><span class="col-md-4 col-sm-4 col-xs-12"> <?php echo __('Payment Status', true); ?></span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i> <?php
				if($order_detail['Order']['payment_method'] == "unpaid"){
					echo __('Not Paid');
				} else {
					echo __($order_detail['Order']['payment_method']);
				} ?></span></li>

				<li><span class="col-md-4 col-sm-4 col-xs-12"> <?php echo __('Store', true); ?></span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i> <?php
				echo $order_detail['ShoppingCart'][0]['Store']['store_name'];?></span></li>

				<li><span class="col-md-4 col-sm-4 col-xs-12"> <?php echo __('Order Status', true); ?></span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i>  <?php 
				echo __($order_detail['Order']['status']); ?></span></li>

					<li><span class="col-md-4 col-sm-4 col-xs-12"> <?php echo __('Customer Name', true); ?></span> <span class="col-md-8 col-sm-8 col-xs-12 site-color"><i>:</i> <?php 
				echo $order_detail['Order']['customer_name'];?></span></li>				
					

				</ul>
			</div>
			<div class="table-responsive">          
				<table class="table table-bordered">
					<thead>
						<tr>
							<th> <?php echo __('S.No', true); ?></th>
							<th><?php echo __('Item Image', true); ?></th>
							<th class="text-left"> <?php echo __('Item Name', true); ?></th>
							<th> <?php echo __('Qty', true); ?></th>
							<th> <?php echo __('Price', true); ?></th>
							<th> <?php echo __('Total Price', true); ?></th>
						</tr>
					</thead>
					<tbody><?php 
					if (!empty($order_detail)) {
						$count = 1;
						foreach ($orderreview_detail as $key => $value) {?>
							<tr>
								<td><?php echo $count;?></td>
								<td>
									<img class="img-thumbnail" alt="<?php echo $value['product_name']; ?>" src="https://s3.amazonaws.com/<?php echo $siteBucket; ?>/stores/products/carts/<?php echo $value['ShoppingCart']['product_image']; ?>" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/images/noimage.jpg"; ?>'">
								</td>


								<td  class="text-left"> <?php 
									echo $value['ShoppingCart']['product_name'];
									if (!empty($value['ShoppingCart']['product_description'])) { ?>
										<div class="margin-t-5"><?php echo $value['ShoppingCart']['product_description']; ?></div> <?php
									} ?>
								</td>
								<td><?php echo $value['ShoppingCart']['product_quantity'];?></td>
								<td><?php echo html_entity_decode($this->Number->currency( $value['ShoppingCart']['product_price'], $siteCurrency));?></td>
								<td class="price"><?php
										echo html_entity_decode($this->Number->currency($value['ShoppingCart']['product_total_price'], $siteCurrency)); ?>
									</td>
								
							</tr><?php
							$count++;
						} ?>
						<tr class="grandprice">
							<td class="text-right" colspan="5"> <?php echo __('Subtotal', true); ?></td>
							<td class="price"><?php
								echo html_entity_decode($this->Number->currency($order_detail['Order']['order_sub_total'], $siteCurrency)); ?>
							</td>
						</tr> <?php 

						if ($order_detail['Order']['offer_amount'] != 0) {?>
							<tr class="grandprice">
								<td class="text-right" colspan="5"> <?php echo __('Offer', true); ?></td>
								<td class="price"><?php
									echo html_entity_decode($this->Number->currency($order_detail['Order']['offer_amount'], $siteCurrency)); ?>
								</td>
							</tr> <?php
						}

						if ($order_detail['Order']['tax_amount'] != 0) {?>
							<tr class="grandprice">
								<td class="text-right" colspan="5"> <?php echo __('Tax', true); ?></td>
								<td class="price"><?php
									echo html_entity_decode($this->Number->currency($order_detail['Order']['tax_amount'], $siteCurrency)); ?>
								</td>
									
							</tr><?php 
						}

						if ($order_detail['Order']['delivery_charge'] != 0) {?>
							<tr class="grandprice">
								<td class="text-right" colspan="5"> <?php echo __('Delivery Charge', true); ?></td>
								<td class="price"><?php
									echo html_entity_decode($this->Number->currency($order_detail['Order']['delivery_charge'], $siteCurrency)); ?>
								</td>
							</tr> <?php 
						} ?>

						<tr class="grandprice">
							<td class="text-right" colspan="5"> <?php echo __('Total', true); ?></td>
							<td class="price"><?php
								echo html_entity_decode($this->Number->currency($order_detail['Order']['order_grand_total'], $siteCurrency)); ?>
							</td>
						</tr> <?php 
					} ?>						
					</tbody>
				</table> <?php
				if ($order_detail['Order']['status'] == 'Delivered') {

					if (file_exists(WWW_ROOT.'/OrderProof/Order_signature'.$order_detail['Order']['id'].'.png')) { ?>

						<center><img src="<?php echo $siteUrl; ?>/OrderProof/Order_signature<?php echo $order_detail['Order']['id']; ?>.png"></center> <?php
					}
					
				} ?>
			</div>
		</div>
	</div>
	
</div>			
