<?php
 $controllerName = $actionName = "";
    
    if(isset($this->request->params['controller']) && $this->request->params['controller'] != "")
    	$controllerName = $this->request->params['controller'];
                                                            
     if(isset($this->request->params['action']) && $this->request->params['action'] != "")
        $actionName = $this->request->params['action'];
         ?>
 <?php

 if ($this->request->params['controller'] == 'searches' &&
 		$this->request->params['action'] == 'index') {

 	echo '<div class="header indexheader">';

 } else if ($this->request->params['controller'] == 'searches' &&
 		$this->request->params['action'] == 'storeitems') {
 	echo '<div class="header detailheader">';
 } else {
 	echo '<div class="header detailheader">';
 } ?>
	<div class="container-fluid">
		<nav class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
					<img class="img-responsive-sm" style="width: 36px;" src="<?php echo $siteUrl.'webroot/webroot/frontend/images/menu.png'; ?>">
				</button>
				<a class="navbar-brand" href="<?php echo $siteUrl.'/searches'; ?>">
					<img src="<?php echo $siteUrl.'/siteicons/logo.png'; ?>">
				</a>

				<?php
					if ($this->request->params['controller'] == 'searches' &&
						$this->request->params['action'] == 'storeitems') {
				?>
					
						<div class="title-categories pull-right">
							<i class="fa fa-filter"></i>
							<h2>
								<span class="hidden-xs"> <?php echo __('Categories', true); ?> <i class="fa fa-angle-down"></i></span>						
							</h2>
						</div>
				<?php
					}
				?>
				
			</div>

			
			<?php if ($this->request->params['controller'] == 'searches' && 
						$this->request->params['action'] == 'storeitems') { ?>
			<ul class="search_bar nav navbar-nav text-center-xs text-center-sm <?php echo ($this->request->params['controller'] == 'searches' && 
							$this->request->params['action'] == 'storeitems') ? '' : 'navbar-right'; ?> "> 
			
				<li class="dropdown menuDropdown">
					<a href="javascript:void(0);" class="dropdown-toggle shopMenu" data-toggle="dropdown"><?php echo $storeDetails['Store']['store_name']; ?> <span class="caret"></span></a>
					<div class="dropdown-menu shopMenuDropdown">
						<a class="menuclose_mobile" href="javascript:void(0);">x</a>
						<span class="caret"></span>
						<div class="detailshopList col-md-12">

							<h4 class="current-store-area"> <?php echo __('Shopping in', true); ?> - <span> <?php
							echo $storeCity[$cityId]. ' '. $storeArea[$areaId]; ?> </span> 
							<a class="pointer" onclick="changeLocation();"> <?php echo __('Change area', true); ?></a></h4>
							<h3> <?php echo __('Choose a store to shop from', true); ?></h3>
							<ul class="products search_stores">
							<?php

							foreach ($storeList as $key => $value) { ?>
								<li class="product">
								    <div class="product__inner">
								        <figure class="product__image" >
									        	<a href="<?php echo $siteUrl.'/shop/'.$value['Store']['seo_url'].'/'.$value['Store']['id'];  ?>">
									           <!--  <span class="discount_image"><span>17% OFF</span></span> -->
									            <?php
					
												if (file_exists(WWW_ROOT.'/storelogos/'.$value['Store']['store_logo'])) { ?>

													<img alt="<?php echo $value['Store']['store_name']; ?>" src="<?php echo $siteUrl.'/storelogos/'.$value['Store']['store_logo']; ?>"><?php
												} else { ?>
													<img alt="<?php echo $value['Store']['store_name']; ?>" src="<?php echo $siteUrl.'/webroot/frontend/images/no_store.jpg'; ?>" title="<?php echo $value['Store']['store_name']; ?>"> <?php
												} ?>

									            <figcaption>
									                <div class="product-addon">
									                    <span class="yith-wcqv-button" href="<?php echo $siteUrl.'/shop/'.$value['Store']['seo_url'].'/'.$value['Store']['id'];  ?>"><span></span><i class="fa fa-check"></i></span>
									                </div>
									            </figcaption>
									        </a>
								        </figure>
								        <div class="product__detail">
								            <div class="top-section">
								                <h2 class="product__detail-title"><a href="javascript:void(0);"><?php echo $value['Store']['store_name']; ?></a></h2>
								               	<div class="product__detail-category">
								               		<a rel="tag" href="javascript:void(0);"><?php
								               			if ($value['Store']['minimum_order'] != 0) {
		               										echo __('Min Order').' - '.$this->Number->currency($value['Store']['minimum_order'], $siteCurrency);
		               									} ?>
		               								</a> <?php
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
						</div>
					</div>
				</li>	
				<li>
					<form class="searchMenuForm">
						<input type="search" class="searchInput searchFilterResults" placeholder="<?php echo __("I'm looking for...", true); ?>" >
						<button class="searchMenuFormClick" type="submit"><?php echo __('Submit', true); ?></button>
					</form>
				</li>

			</ul>
			<?php
			} ?>
			<div class="collapse navbar-collapse" id="example-navbar-collapse">
				 <?php

					if ($controllerName != 'checkouts') { ?>

						<ul class="nav navbar-nav navbar-right">
							<?php
								if ($this->request->params['controller'] == 'searches' &&
									$this->request->params['action'] == 'storeitems') {
							?>
							<li>								
								<a class="cartDropdown" href="javascript:void(0);"><i class="fa fa-shopping-cart"></i>
									<?php echo $siteCurrency; ?>
									<span class="cartTotal">0</span><span class="caret"></span></a>

								<div class="cart_notification hidden-xs hidden-sm" style="display:none;">
									<?php echo __('1 Item added to cart successfully.', true); ?>
								</div>
								<div class="cart_failedNotification hidden-xs hidden-sm" style="display:none;">
									<?php echo __('Quantity Exceeded..!', true); ?>
								</div>
							</li>
						<?php

							}


							if ($this->request->params['controller'] == 'searches' &&
								$this->request->params['action'] == 'stores') { ?>
								<li> <a class="changeLocation pointer" onclick="changeLocation();">
									<i class="fa fa-map-marker"></i> <?php echo __('Change Location', true); ?></a></li> <?php
							}
							
							if(!empty($loggedCheck) && ($loggedCheck['role_id'] == 4)){ ?>

		                        <li> <a href="<?php echo $siteUrl.'/customer/customers/myaccount'; ?>"> <?php echo __('Myaccount', true); ?></a> </li>
		                        <li> <a href="<?php echo $siteUrl.'/customer/users/userLogout'; ?>"> <?php echo __('Logout', true); ?></a> </li> <?php 
		                    } else {?>
		                        <li> <a href="<?php echo $siteUrl.'/signup'; ?>"> <?php echo __('Sign Up', true); ?></a></li>
							   	<li> <a href="<?php echo $siteUrl.'/customerlogin'; ?>"> <?php echo __('Login', true); ?></a> </li> <?php 
							} ?>	
							
						</ul> <?php
					} ?>
			</div>
		</nav>
	</div>
</div>