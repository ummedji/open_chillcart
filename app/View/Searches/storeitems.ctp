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
					</li>
					<li><a href="#Deal"><span>&rarr;</span>
						<?php echo __('Deals', true); ?> </a></li>
				</ul>
				<h1> <?php echo __('Categories', true); ?></h1>
				<ul class="maincategory"> <?php
					foreach ($mainCategoryList as $key => $value) {

						//echo "<pre>"; print_r($value);

						?>
						<li>
							<a class="mainMenu"><?php
								echo $value['Category']['category_name']; ?></a><?php
							echo $this->Form->hidden('check' ,array('value'=>$value['Category']['id'].'_'.$storeId,
								'class'=>'remove_'.$value['Category']['id']));?>
							<ul class="subcategories">
								<li><a href="#<?php echo $value['Category']['category_name']; ?>"><span>&rarr;</span> All <?php
										echo $value['Category']['category_name']; ?></a></li><?php

								foreach ($value['ChildGroup'] as $keys => $values) {

									//echo "<pre>"; print_r($values);

									if (in_array($values['id'], $subCategoryList)) { ?>

										<li><a href="#<?php echo $values['category_name']; ?>"><span>&rarr;</span>
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
	
	<div class="rightSideBar"> <?php



		if (!empty($dealProduct)) { ?>

			<div class="products-category" id="Deal" >
				<header class="products-header">
					<h4 class="category-name">
						<span> <?php echo __('Deal Products', true); ?></span>
					</h4>					
				</header>


				<ul class="products">
					<?php foreach ($dealProduct as $key => $value) {//echo "<pre>";print_r($value);die();
						//echo "<pre>"; print_r($value); 
						$imageSrc = $siteUrl.'/stores/'.$value['MainProduct']['store_id'].'/products/home/'.$value['MainProduct']['ProductImage'][0]['image_alias'];

						$imageSrcSub = $siteUrl.'/stores/'.$value['SubProduct']['store_id'].'/products/scrollimg/'.$value['SubProduct']['ProductImage'][0]['image_alias']; ?>

					    <li class="product searchresulttoshow">

					      	<div class="product__inner">
						        <figure class="product__image relative" onclick="productDetails(<?php echo $value['MainProduct']['id']; ?>);">
						            <!-- <span class="onsale"></span> -->

									<span class="ribn-red onsale"><span><?php echo $value['Deal']['deal_name']; ?></span></span>

						            <img src="<?php echo $imageSrc; ?>" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/images/no-imge.jpg"; ?>'" alt="<?php echo $value['MainProduct']['product_name']; ?>" title="<?php echo $value['MainProduct']['product_name']; ?>" >
						            <figcaption>
						               <div class="product-addon">
						                  <a href="javascript:void(0);" class="yith-wcqv-button"><span></span><i class="fa fa-plus"></i></a>
						               </div>
						            </figcaption>
						            <span class="free_section">
										<h5>Free</h5>
										<img width="50" class="image-lazy image-loaded" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/images/no-imge.jpg"; ?>'" src="<?php echo $imageSrcSub; ?>" alt="<?php echo $value['SubProduct']['product_name']; ?>" title="<?php echo $value['SubProduct']['product_name']; ?>">
									</span>
						        </figure>
					         	<div class="product__detail">
						            <div class="top-section">
						                <h2 class="product__detail-title"><a href="javascript:void(0);"><?php echo $value['MainProduct']['product_name'].'+'.$value['SubProduct']['product_name']; ?></a></h2>
						               	<div class="product__detail-category">
						               		<a href="javascript:void(0);" rel="tag"><?php echo $value['MainProduct']['ProductDetail'][0]['sub_name']; ?></a>
						               	</div>			               

					                  	<?php if ($value['MainProduct']['ProductDetail'][1]['sub_name']) { ?>
											<div class="show-on-hover">
												<?php  foreach ($value['MainProduct']['ProductDetail'] as $keyVal => $val) {
													if ($keyVal != 0) { ?>
													<div class="yith-wcwl-add-to-wishlist">
														<div  style="display:block">
															<a href="javascript:void(0);" rel="nofollow" class="add_to_wishlist">
																
																<?php															

																	echo '<p class="contain"> '.$val['sub_name']. ' : ';

																	if ($val['compare_price'] != 0) {
																		echo '<s>'. html_entity_decode($this->Number->currency($val['orginal_price'], $siteCurrency)).'</s> ';
																		echo '<span class="margin-l-5">'.html_entity_decode($this->Number->currency($val['compare_price'], $siteCurrency)).'</span>';
																	} else {
																		echo html_entity_decode($this->Number->currency($val['orginal_price'], $siteCurrency));
																	}

																	echo '</p>';

																?>
															</a>
														</div>

													</div>
													<?php }
												} ?>

												
											</div> 
										<?php } ?>

						                <div class="clear"></div>
						               
						            </div>
						            <div class="bottom-section">
						                <span class="price product__detail-price">
						                	<?php
												if ($value['MainProduct']['ProductDetail'][0]['compare_price'] != 0) {
													echo '<del><span class="amount">'. html_entity_decode($this->Number->currency($value['MainProduct']['ProductDetail'][0]['orginal_price'], $siteCurrency)).'</span></del>';
													echo '<ins class="margin-l-5"><span class="amount">'.html_entity_decode($this->Number->currency($value['MainProduct']['ProductDetail'][0]['compare_price'], $siteCurrency)).'</span></ins>';
												} else {
													echo html_entity_decode($this->Number->currency($value['MainProduct']['ProductDetail'][0]['orginal_price'], $siteCurrency));
												} ?>
						               		
				               			</span>
						                <div class="product__detail-action">
						                  	<a href="javascript:void(0);" rel="nofollow" class="button add_to_cart_button " > <?php
						                  	
						                  		if ($value['MainProduct']['price_option'] == 'single') {
							                  		if($value['MainProduct']['ProductDetail'][0]['quantity'] != 0) { ?>
							                  			<span onclick="addToCart(<?php echo $value['MainProduct']['ProductDetail'][0]['id']; ?>);" ><b class="hidden-xs"><?php echo __('Add'); ?></b> <i class="fa fa-plus"></i></span> <?php
							                  		} else { ?>
							                  			<span href="javascript:void(0);" >
									   						<b class="hidden-xs"><?php echo __('Out of Stock'); ?></b> <i class=""></i></span> <?php
							                  		}
							                  	} else { ?>
													<span onclick="productDetails(<?php echo $value['MainProduct']['id']; ?>);" ><b class="hidden-xs"><?php echo __('Add'); ?></b> <i class="fa fa-plus"></i></span>
													<?php

												} ?>

							                  	<i class="fa fa-plus"></i>
						                  	</a>
						                  
						                </div>
						            </div>
						        </div>
					      	</div>
					    </li>
					<?php } ?>
				</ul>
				
			</div> <?php
		} ?>
		<div id="filtterByCategory">

		</div>


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

