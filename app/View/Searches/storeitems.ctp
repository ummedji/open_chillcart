<div class="mobile_cart">
	<div class="">
		<span class="pull-left">
			<div class="mobile_cart_price" href="javascript:void(0);" >
				
				<?php echo $siteCurrency; ?><span class="cartTotal">0</span>

				<div class="cart_notification" style="display:none;">
					<?php echo __('1 Item added to cart successfully.', true); ?>
				</div>
				<div class="cart_failedNotification" style="display:none;">
					<?php echo __('Quantity Exceeded..!', true); ?>
				</div>
			</div>
		</span>
		<span class="pull-right viewCart_mobile">
			<a class="checkout_arrow view relative" href="javascript:void(0);" ><i class="fa fa-shopping-cart white"></i><span class="price_count" id="cartCount">0</span></a>			
		</span>
	</div>	
</div>


<div class="menuWrapper">
			
	<div class="category_mobile">
		<div class="leftsideBar">
			<div class="leftsideBar_scroller">
				<a class="close_category" href="javascript:void(0);">X</a>
				<h1> <?php echo __('List'); ?> </h1>
				<ul>
					<li><a href="javascript:void(0);" onclick="offerDetails(<?php echo $storeId; ?>);"><span>&rarr;</span>
						<?php echo __('Offer', true); ?> </a>
					</li> <?php
					if (!empty($dealProduct)) { ?>
						<li><a href="javascript:void(0);" onclick="dealsProduct(<?php echo $storeId;?>);"><span>&rarr;</span>
							<?php echo __('Deals', true); ?> </a>
						</li> <?php 
					} ?>
				</ul>
				<h1> <?php echo __('Categories', true); ?></h1>
				<ul class="maincategory"> <?php
					foreach ($mainCategoryList as $key => $value) { ?>
						<li>
							<a href="javascript:void(0);" class="mainMenu"><?php
								echo $value['Category']['category_name']; ?></a><?php
							echo $this->Form->hidden('check' ,array('value'=>$value['Category']['id'].'_'.$storeId,
								'class'=>'remove_'.$value['Category']['id']));?>
							<ul class="subcategories">
								<li>
									<a href="javascript:void(0);" onclick="categoriesProduct(<?php echo $value['Category']['id'].',0,'.$storeId;?>);"> <span>&rarr;</span> All <?php
									echo $value['Category']['category_name']; ?> </a> <?php

								foreach ($value['ChildGroup'] as $keys => $values) {
									if (in_array($values['id'], $subCategoryList)) { ?>

										<li>
											<a href="javascript:void(0);" onclick="categoriesProduct(<?php echo $values['parent_id'].','.$values['id'].','.$storeId;?>);">
											<span>&rarr;</span>
												<?php echo $values['category_name'];?></a></li> <?php
									}

								} ?>
							</ul>
						</li> <?php
					} ?>
										
				</ul>
			</div>
		</div>
	</div>
	
	<div class="rightSideBar">
		<div id="filtterByCategory"></div>
		<div id="cart-sidebar">
			<a class="mobile_cart_close" href="javascript:void(0);"><i class="fa fa-chevron-left"></i></a>
			<div class="cart-sidebar-overlay"></div>
			<header>
				<div class="btn-cart-toggle">
					<span class="fa fa-angle-double-left"></span>
				</div>
			</header>
			<section>
				<div class="cart-wrapper" id="cartdetailswrapper">
					
				</div>
			</section>
		</div>
		<div class="modal fade" id="addCartPop"> </div>
	</div>

</div>

