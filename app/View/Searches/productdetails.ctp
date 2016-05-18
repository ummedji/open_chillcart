<div class="modal-dialog modal-lg main_as_pro_popup">
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
		<div class="modal-body menuInner clearfix as_pro_popup">
			<div class="col-md-7">


<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
    <div class='carousel-outer'>
        <!-- Wrapper for slides -->
        <div class='carousel-inner'>
            
            
            <?php
            
            $j = 0;
            
				foreach ($productDetails['ProductImage'] as $key => $value) {
				$imageName = (isset($value['image_alias'])) ? $value['image_alias'] : '';
		$imageSrc = $cdn.'/stores/products/home/'.$imageName;
		$imageSrc = 'https://dnrskjoxjtgst.cloudfront.net/stores/products/home/'.$imageName;  ?>
            
            <div class='item <?php if($j == 0){ ?>active <?php } ?>'>
                <img src="<?php echo $imageSrc;?>" alt="<?php echo $productDetails['Product']['product_name']; ?>" />
            </div>
            
            <?php 
            $j++;
                                } ?>
            
        </div>

        <!-- Controls
        <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
            <span class='glyphicon glyphicon-chevron-left'></span>
        </a>
        <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
            <span class='glyphicon glyphicon-chevron-right'></span>
        </a>-->
    </div>

    <!-- Indicators -->
    <ol class='carousel-indicators mCustomScrollbar'>
        <?php
        $k = 0;
				foreach ($productDetails['ProductImage'] as $key => $value) {
				$imageName = (isset($value['image_alias'])) ? $value['image_alias'] : '';
		$imageSrc = $cdn.'/stores/products/home/'.$imageName;
		$imageSrc = 'https://dnrskjoxjtgst.cloudfront.net/stores/products/home/'.$imageName;  ?>
        
        <li data-target='#carousel-custom' data-slide-to='<?php echo $k; ?>' class='active'><img src="<?php echo $imageSrc;?>" alt="<?php echo $productDetails['Product']['product_name']; ?>" /></li>
        <?php 
        
        $k++;
                                } ?>
        
        
    </ol>
</div>
<div class="clearfix"></div>








			<!--<div class="imagdiv">
				<?php
				//foreach ($productDetails['ProductImage'] as $key => $value) {
				//$imageName = (isset($value['image_alias'])) ? $value['image_alias'] : '';
		//$imageSrc = $cdn.'/stores/products/home/'.$imageName;
		//$imageSrc = 'https://dnrskjoxjtgst.cloudfront.net/stores/products/home/'.$imageName;  ?>
				<span><img src="<?php //echo $imageSrc;?>" alt="<?php //echo $productDetails['Product']['product_name']; ?>"></span>
				<?php //} ?>
			</div> -->
			</div>
			<div class="col-md-5 detailPopCont as_popup_cont">
					<?php
					if ($productDetails['Product']['price_option'] != 'single') {  ?>
						<div class="varient_height">
							<select class="form-control margin-t-15" id="productVariant" onchange="variantDetails();"> <?php
								foreach($productDetails['ProductDetail'] as $key => $value) { ?>
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
										<div class="col-md-8 mr_top_bot">
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


					            <div class="col-sm-12 text-left form_sub">
					            	<div class="row">
					            	<button type="submit" onclick="variantCart();" class="btn btn-primary margin-t-25"><?php echo __('Add To Cart'); ?> </button>
					            	</div>
					            </div> <?php
					        } else { ?>
					        	<div class="col-sm-12 text-left form_sub">
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
								<div class="col-md-8 mr_top_bot">
									<input class="form-control text-center" id="quantity" type="text" value="">	
								</div>				
							</div> <?php
				        } ?>


				        <label class="error" id="addcart_failed" style="display:none;"> <?php echo __('Quantity Exceeded..!'); ?> 
				        </label> <?php
				        if (!empty($productDetails['Product']['product_description'])) { ?>
				            <div class="addcart_popup_head_1">
				              <h5 class="addcart_popup_head"><?php echo  __('Product Description'); ?> :</h5>
                              <p><?php echo $productDetails['Product']['product_description'];?></p>
				            </div> <?php
				        }
				        ?>
			        </div>
			        <?php
		            if ($productDetails['ProductDetail'][0]['quantity'] != 0) { ?>

			            <div class="col-sm-12 text-left form_sub">
			            	<div class="row"><button type="submit" onclick="variantCart();" class="btn btn-primary margin-t-25"><?php echo __('Add To Cart'); ?> </button></div>
			            </div> <?php

			        } else { ?>

		        		<div class="col-sm-12 text-left form_sub">
			            	<div class="row"><button type="submit" class="btn btn-primary margin-t-25 opacity_5"><?php echo __('Out of Stock'); ?> </button></div>
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