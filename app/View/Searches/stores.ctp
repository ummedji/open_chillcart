<div class="container">
	<div class="searchshopContent">
	<?php if ($orderSuccess == 'success') {?>
		<div class="modal fade" id="thanksmsg"> 
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header menuCartHeader clearfix">
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
						</button>
							<h2> <?php echo __('Thank You'); ?></h2>
					</div>
					<div class="modal-body menuInner clearfix">
						<div class="alert alert-success">
							<h1 class="no-border no-margin no-padding"><?php 
								echo __('Your Order Placed Successfully', true); ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?> 

		<h1> <?php echo __('Select store to start shopping...!', true); ?> </h1>
		
		<ul class="products search_stores"> <?php
			foreach ($storeList as $key => $value) { ?>

				<li class="product">
				    <div class="product__inner">
				        <figure class="product__image" >
				        	<a href="<?php echo $siteUrl.'/shop/'.$value['Store']['seo_url'].'/'.$value['Store']['id']; ?>">
				            <!-- <span class="discount_image"><span>17% OFF</span></span> -->
				            
								<img alt="<?php echo $value['Store']['store_name']; ?>" src="https://s3.amazonaws.com/<?php echo $siteBucket.'/storelogos/'.$value['Store']['store_logo']; ?>" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/frontend/images/no_store.jpg"; ?>'">

				            <figcaption>
				                <div class="product-addon">
				                    <span class="yith-wcqv-button" href="<?php echo $siteUrl.'/shop/'.$value['Store']['seo_url'].'/'.$value['Store']['id']; ?>"><span></span><i class="fa fa-check"></i></span>
				                </div>
				            </figcaption>
				          </a>
				        </figure>
				        <div class="product__detail">
				            <div class="top-section">
				                <h2 class="product__detail-title"><a href="javascript:void(0);"><?php echo $value['Store']['store_name']; ?></a></h2>
				               	<div class="product__detail-category">
				               		<a rel="tag" href="javascript:void(0);"> <?php 

				               		if ($value['Store']['minimum_order'] != 0) {
				               			echo __('Min Order').' - '. $this->Number->currency($value['Store']['minimum_order'], $siteCurrency);
				               		} ?> </a> <?php

									$ratio = $value['Store']['rating'] * 20;?>
									<span class="review_rating_outer">
										<span class="review_rating_grey"></span>
										<span class="review_rating_green" style="width:<?php echo $ratio;?>%;"></span>
									</span>
				               	</div>

				                <div class="clear"></div>				               
				            </div>				            
				        </div>
				    </div>
			   	</li>
				 <?php
			} ?>
		</ul>


		<div class="page-header page-header-with-icon">
			<i class="fa fa-or"><?php echo __('Or', true); ?></i>
			<h2>
				<a class="btn btn-default btn-md bold" onclick="changeLocation();">
					<i class="fa fa-map-marker"></i> <?php echo __('Change Location', true); ?></a>
			</h2>

		</div>
		
		<h2 class="text-center">
			
		</h2>
		
	</div>
</div>	