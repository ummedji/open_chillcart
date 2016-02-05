<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header menuCartHeader clearfix">
			<button type="button" class="close" data-dismiss="modal">
				<span aria-hidden="true">&times;</span>
			</button>
			<h4>
				<?php
					if(!empty($productDetails['Deal']['id']) && $productDetails['Deal']['status'] != 0) {
						echo $productDetails['Product']['product_name'].' + '.$productDetails['Deal']['SubProduct']['product_name'];
					} else {
						echo $productDetails['Product']['product_name'];
					}
				?>	
			</h4>
		</div>
		
		<div class="modal-body menuInner clearfix">

			<div class="col-md-8"> 

				 <?php $imageOne = $siteUrl.'/stores/'.$productDetails['Product']['store_id'].'/products/original/'.$productDetails['ProductImage'][0]['image_alias']; ?>
				 
				<div id="sync1" class="owl-carousel">
					<!-- <div class="item"><img src="<?php echo $imageOne;?>" alt="detailImage" title="detailImage"></div> -->

					<?php					
					foreach ($productDetails['ProductImage'] as $key => $value) { 
						$imageSrc = $siteUrl.'/stores/'.$productDetails['Product']['store_id'].'/products/original/'.$value['image_alias']; ?>
						<div class="item" >
							<img src="<?php echo $imageSrc;?>" alt="<?php echo $productDetails['Product']['product_name']; ?>" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/images/no-imge.jpg"; ?>'">
						</div> <?php
					} ?> 					
				</div>
				<div class="col-md-10 col-md-offset-1">
					<div id="sync2" class="owl-carousel">
		                <?php
						foreach ($productDetails['ProductImage'] as $key => $value) { 
							$imageSrc = $siteUrl.'/stores/'.$productDetails['Product']['store_id'].'/products/original/'.$value['image_alias']; ?>
							<div class="item" >
								<img src="<?php echo $imageSrc;?>" alt="<?php echo $productDetails['Product']['product_name']; ?>" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/images/no-imge.jpg"; ?>'">
							</div> <?php
						} ?>               
		            </div>
		        </div>

				
			</div>


			<div class="col-md-4 detailPopCont">

					<?php
					if ($productDetails['Product']['price_option'] != 'single') {  ?>
						<div class="varient_height">
							<select class="form-control margin-t-15" id="productVariant" onchange="variantDetails();"> <?php
								foreach ($productDetails['ProductDetail'] as $key => $value) { ?>
									<option value="<?php echo $value['id']; ?>"><?php echo $value['sub_name']; ?></option> <?php
								} ?>
							</select>
						</div>
						
						<div id="productVariantDetails"> 
							<div class="detailPopCont_top">
								<div class="price_height">
									<?php

									if (!empty($productDetails['ProductDetail'][0]['compare_price'])) { ?>

										<h5 class="addcart_popup_head"><?php echo __('Original Price'); ?> :</h5><h2><?php
											echo '<s>'. html_entity_decode($this->Number->currency($productDetails['ProductDetail'][0]['orginal_price'], $siteCurrency)).'</s>'; ?></h2>
										<h5 class="addcart_popup_head"><?php echo __('Compare Price'); ?> :</h5><h2><?php
											echo html_entity_decode($this->Number->currency($productDetails['ProductDetail'][0]['compare_price'], $siteCurrency)); ?></h2> <?php
									} else { ?>
										<h5 class="addcart_popup_head"><?php echo __('Original Price'); ?> :</h5><h2><?php
											echo html_entity_decode($this->Number->currency($productDetails['ProductDetail'][0]['orginal_price'], $siteCurrency)); ?></h2> <?php

									}?>
								</div>
								<?php
								if ($productDetails['ProductDetail'][0]['quantity'] != 0) { ?>
									
									<div class="row">
										<div class="col-md-8">
											<input class="form-control text-center" id="quantity" type="text" value="">	
										</div>							
									</div>
									<?php
						        }  ?>


								<label class="error" id="addcart_failed" style="display:none;"> <?php echo __('Quantity Exceeded..!'); ?>  </label>
								<?php
								if (!empty($productDetails['Product']['product_description'])) { ?>
						            <h5 class="addcart_popup_head"><?php echo  __('Product Description'); ?> :</h5>
						            <p><?php echo $productDetails['Product']['product_description'];?></p> <?php
						        }?>

						    </div>

					        <?php
				            if ($productDetails['ProductDetail'][0]['quantity'] != 0) { ?>


					            <div class="col-sm-12 text-center">
					            	<button type="submit" onclick="variantCart();" class="btn btn-primary margin-t-25"><?php echo __('Add To Cart'); ?> </button>
					            </div> <?php
					        } else { ?>
					        	<div class="col-sm-12 text-center">
					            	<button type="submit" class="btn btn-primary margin-t-25 opacity_5"><?php echo __('Out of Stock'); ?> </button>
					            </div>
					        	<?php
					        } ?>
					        
			            </div> <?php


					} else {	
						echo $this->Form->input('',
				                            array('class' => 'form-control',
				                            	  'type'  => 'hidden',
				                            	  'id' => 'productVariant',
				                            	  'value' => $productDetails['ProductDetail'][0]['id'],
				                                  'label' => false)); ?>
					<div class="varient_height">
						&nbsp;
					</div>				                                  
					<div class="detailPopCont_top">				                                  
	                    
				        <div class="price_height">
					        <?php
					        if (!empty($productDetails['ProductDetail'][0]['compare_price'])) { ?>

								<h5 class="addcart_popup_head"><?php echo __('Original Price'); ?> :</h5> <h2><?php
									echo '<s>'. html_entity_decode($this->Number->currency($productDetails['ProductDetail'][0]['orginal_price'], $siteCurrency)).'</s>'; ?></h2>
								<h5 class="addcart_popup_head"><?php echo __('Compare Price'); ?> :</h5> <h2><?php
									echo html_entity_decode($this->Number->currency($productDetails['ProductDetail'][0]['compare_price'], $siteCurrency)); ?></h2> <?php
							} else { ?>
								<h5 class="addcart_popup_head"><?php echo __('Original Price'); ?> :</h5> <h2><?php
									echo html_entity_decode($this->Number->currency($productDetails['ProductDetail'][0]['orginal_price'], $siteCurrency)); ?></h2> <?php

							}?>
						</div>
						<?php
						if ($productDetails['ProductDetail'][0]['quantity'] != 0) { ?>
							<div class="row">
								<div class="col-md-8">
									<input class="form-control text-center" id="quantity" type="text" value="">	
								</div>				
							</div> <?php
				        } ?>


				        <label class="error" id="addcart_failed" style="display:none;"> <?php echo __('Quantity Exceeded..!'); ?> 
				        </label> <?php
				        if (!empty($productDetails['Product']['product_description'])) { ?>
				            <h5 class="addcart_popup_head"><?php echo  __('Product Description'); ?> :</h5>
				            <p><?php echo $productDetails['Product']['product_description'];?></p> <?php
				        }
				        ?>
			        </div>
			        <?php
		            if ($productDetails['ProductDetail'][0]['quantity'] != 0) { ?>

			            <div class="col-sm-12 text-center">
			            	<button type="submit" onclick="variantCart();" class="btn btn-primary margin-t-25"><?php echo __('Add To Cart'); ?> </button>
			            </div> <?php

			        } else { ?>

		        		<div class="col-sm-12 text-center">
			            	<button type="submit" class="btn btn-primary margin-t-25 opacity_5"><?php echo __('Out of Stock'); ?> </button>
			            </div>
			            
			        	<?php

			        }

				} ?>
			</div>
		</div>
	</div>
</div>

<script>
	  var sync1 = $("#sync1");
	  var sync2 = $("#sync2");

	  sync1.owlCarousel({
	    singleItem : true,
	    slideSpeed : 1000,
	    navigation: true,
	    pagination:false,
	    navigationText: ["",""],
	    afterAction : syncPosition,
	    responsiveRefreshRate : 200,
	  });

	  sync2.owlCarousel({
	    items : 3,
	    itemsDesktop      : [1199,3],
	    itemsDesktopSmall     : [979,2],
	    itemsTablet       : [768,1],
	    itemsMobile       : [479,1],
	    pagination:false,
	    responsiveRefreshRate : 100,
	    afterInit : function(el){
	      el.find(".owl-item").eq(0).addClass("synced");
	    }
	  });

	  function syncPosition(el){
	    var current = this.currentItem;
	    $("#sync2")
	      .find(".owl-item")
	      .removeClass("synced")
	      .eq(current)
	      .addClass("synced")
	    if($("#sync2").data("owlCarousel") !== undefined){
	      center(current)
	    }

	  }

	  $("#sync2").on("click", ".owl-item", function(e){
	    e.preventDefault();
	    var number = $(this).data("owlItem");
	    sync1.trigger("owl.goTo",number);
	  });

	  function center(number){
	    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;

	    var num = number;
	    var found = false;
	    for(var i in sync2visible){
	      if(num === sync2visible[i]){
	        var found = true;
	      }
	    }

	    if(found===false){
	      if(num>sync2visible[sync2visible.length-1]){
	        sync2.trigger("owl.goTo", num - sync2visible.length+2)
	      }else{
	        if(num - 1 === -1){
	          num = 0;
	        }
	        sync2.trigger("owl.goTo", num);
	      }
	    } else if(num === sync2visible[sync2visible.length-1]){
	      sync2.trigger("owl.goTo", sync2visible[1])
	    } else if(num === sync2visible[0]){
	      sync2.trigger("owl.goTo", num-1)
	    }
	  }

</script>