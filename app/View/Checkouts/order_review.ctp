<div class="panel panel-default myorderTab">
	<div class="panel-body addressBg">
		<div class="panel-subheading">
			<h3> <?php echo __('Review & Confirm', true); ?></h3>
		</div>
		 <?php

			$storeCount = 0;
			foreach ($shopCart as $key => $value) {

				$nextValue = $key+1;

				if ($value['ShoppingCart']['store_id'] != $storeMain) {

					$storeSubtotal = $serialNo = 0;
					$storeMain = $value['ShoppingCart']['store_id'];
					echo __('Store Name'); ?> :  <?php echo $value['Store']['store_name']; ?>
					<div class="table-responsive">
						<table class="table table-hover table-bordered">
							<thead>
								<tr>
									<th> <?php echo __('S.No', true); ?></th>
									<!-- <th class="text-left"> <?php echo __('Store Name', true); ?></th> -->
									<th> <?php echo __('Item Image', true); ?>	</th>
									<th class="text-left"> <?php echo __('Item Name', true); ?></th>
									<th> <?php echo __('Qty', true); ?></th>
									<th> <?php echo __('Price', true); ?></th>
									<th> <?php echo __('Total Price', true); ?></th>
								</tr>
							</thead>
							<tbody><?php
				}
									
								$subtotal 		+= $value['ShoppingCart']['product_total_price'];
								$storeSubtotal	+= $value['ShoppingCart']['product_total_price']; ?>
								<tr>
									<td><?php echo $serialNo +=1; ?></td>
									<!-- <td class="text-left"><?php echo $value['Store']['store_name']; ?></td> -->
									<td>
										<?php $imageSrc = $siteUrl.'/stores/'.$value['ShoppingCart']['store_id'].'/products/carts/'.$value['ProductDetail']['Product']['ProductImage'][0]['image_alias']; ?>

										<img class="orderimge img-thumbnail"  title="fruit" alt="fruit" src="<?php echo $imageSrc; ?>" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/images/no-imge.jpg"; ?>'"></td>
									<td class="text-left"><?php echo $value['ShoppingCart']['product_name']; ?></td>
									<td><?php echo $value['ShoppingCart']['product_quantity']; ?></td>
									<td><?php echo html_entity_decode($this->Number->currency($value['ShoppingCart']['product_price'], $siteCurrency)); ?></td>
									<td><?php echo html_entity_decode($this->Number->currency($value['ShoppingCart']['product_total_price'], $siteCurrency)); ?></td>
								</tr> <?php


					if (!isset($shopCart[$nextValue]['ShoppingCart']['store_id']) || 
				  						$shopCart[$nextValue]['ShoppingCart']['store_id'] != $storeMain) { ?>


								<tr class="toatlprice">
									
									<td colspan="5" class="text-right"> <?php echo __('Sub Total', true); ?></td>						
									<td> <?php
										echo html_entity_decode($this->Number->currency($storeSubtotal, $siteCurrency)); ?></td>
								</tr> <?php

								if (isset($deliveryDetails[$storeCount]['delivery_charge'])) { ?>
									<tr class="grandprice">
										<td colspan="5" class="text-right"> <?php
											//echo $deliveryDetails[$storeCount]['store_name'].' Delivery Fee ';
											echo __('Delivery Charge'); ?></td> 
										<td>  <?php
											if ($deliveryDetails[$storeCount]['delivery_charge'] != 0) {
												$subtotal 		+= $deliveryDetails[$storeCount]['delivery_charge'];
												$storeSubtotal 	+= $deliveryDetails[$storeCount]['delivery_charge'];
											}
											echo ($deliveryDetails[$storeCount]['delivery_charge'] != 0) ? 
													html_entity_decode($this->Number->currency($deliveryDetails[$storeCount]['delivery_charge'], $siteCurrency)) :
													__('Free Delivery'); ?></td>
									</tr> <?php
								}

								if ($offerDetails[$storeCount]['storeOffer'] != 0) { ?>
									<tr class="grandprice">
										<td colspan="5" class="text-right"><?php //echo $offerDetails[$storeCount]['store_name']; ?> 	<?php echo __('Offer'); ?> (<?php echo $offerDetails[$storeCount]['offerPercentage'].'%'; ?>) </td>
										
										<td> <?php
											if ($offerDetails[$storeCount]['storeOffer'] != 0) {
												$subtotal 		-= $offerDetails[$storeCount]['storeOffer'];
												$storeSubtotal	-= $offerDetails[$storeCount]['storeOffer'];
											}
											echo html_entity_decode($this->Number->currency($offerDetails[$storeCount]['storeOffer'], $siteCurrency)); ?></td>
									</tr> <?php
								}


								if ($taxDetails[$storeCount]['tax'] != 0) { ?>
									<tr class="grandprice">
										<td colspan="5" class="text-right"><?php 
											//echo $taxDetails[$storeCount]['store_name']; ?> 
											<?php echo __('Tax'); ?> </td>
										<td> <?php
											if ($taxDetails[$storeCount]['tax'] != 0) {
												$subtotal 		+= $taxDetails[$storeCount]['tax'];
												$storeSubtotal	+= $taxDetails[$storeCount]['tax'];
											}
											echo html_entity_decode($this->Number->currency($taxDetails[$storeCount]['tax'], $siteCurrency)); ?></td>
									</tr> <?php
								}  ?>

								<tr class="grandprice">
									<td colspan="5" class="text-right"> <?php echo __('Total', true); ?></td>
									<td> <?php
										echo html_entity_decode($this->Number->currency($storeSubtotal, $siteCurrency)); ?></td>
								</tr>
							</tbody>
						</table>
					</div> <?php
					$storeCount +=1;
				}
			} ?>

			
			<div class="grand_outer">
				<span class="grand_left"> <?php echo __('Grand Total', true); ?></span>
				<span class="grand_right"> <?php
				echo html_entity_decode($this->Number->currency($subtotal, $siteCurrency)); ?></span>
			</div>
			
		
		<div class="checkout-bottom checkoutbtm"> <?php
			echo $this->Form->button('Continue',
		                              array('class'=>'btn btn-primary pull-right')); ?>
			<a onclick="checkoutpagintaion('#reviewConform','#payment');" class="btn btn-default pull-left" > <?php echo __('Back to Payment', true); ?></a>
		</div>
	</div>
</div>