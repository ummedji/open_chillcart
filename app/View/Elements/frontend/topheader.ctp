<?php $controllerName = $actionName = "";
    if(isset($this->request->params['controller']) && $this->request->params['controller'] != "")
    	$controllerName = $this->request->params['controller'];
     if(isset($this->request->params['action']) && $this->request->params['action'] != "")
        $actionName = $this->request->params['action'];
      ?>
 <?php
 if ($this->request->params['controller'] == 'searches' && $this->request->params['action'] == 'index') {
 	//echo '<div class="header indexheader">';
 } else if ($this->request->params['controller'] == 'searches' &&
 		$this->request->params['action'] == 'storeitems') {
 	echo '<div class="header detailheader">';
 } else {
 	echo '<div class="header detailheader">';
 } ?>
<header>
<!-- NEW TEMPLATE START -->
		<div class="navbar navbar-inverse navbar-fixed-top navtop">
		<div class="container">
		  <div class="navbar-header"> <a href="index.html"><img title="CHILLCART" src="<?php echo $siteUrl.'/frontend/images/site-logo.png'; ?>"/></a><button class="nav-add navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> </div>
		  <div class="navbar-collapse collapse in">
        <div class="main-menu">
			<ul class="nav navbar-nav pull-right">
			<?php if(!empty($loggedCheck) && ($loggedCheck['role_id'] == 4)){ ?>
			<li><a href="<?php echo $siteUrl.'/customer/customers/myaccount'; ?>"> <?php echo __('My Account', true); ?></a> </li>
		    <li> <a href="<?php echo $siteUrl.'/customer/users/userLogout'; ?>"> <?php echo __('Logout', true); ?></a> </li> 
			<?php } else { ?>
			<li><a href="<?php echo $siteUrl.'/signup'; ?>"> <?php echo __('Sign Up', true); ?></a></li>
			<li><a href="<?php echo $siteUrl.'/customerlogin'; ?>"> <?php echo __('Login', true); ?></a></li>
			<?php } ?>
			<?php if ($this->request->params['controller'] == 'searches' &&
			($this->request->params['action'] == 'index' || $this->request->params['action'] == 'stores' || $this->request->params['action'] == 'storeitems')) { ?>
			  <li><a href="">How it Works?</a></li>
			  <li><a href=""><span class="carticon"></span><span class="cartTotal">0.00</span><span class="droparrow"></span></a></li>
			 <?php } ?>
			</ul>
		  </div>
		  </div>
		  </div>
		</div>
		</div>
</header>

<!-- NEW TEMPLATE END -->
	<?php /*
	<div class="container-fluid">
		<nav class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle visible-sm visible-xs" data-toggle="collapse" data-target="#example-navbar-collapse">
					<img class="img-responsive-sm" src="<?php echo $siteUrl.'/frontend/images/menu.png'; ?>">
				</button>
				<a class="navbar-brand" href="<?php echo $siteUrl.'/searches'; ?>">
					<img src="<?php echo $siteUrl.'/siteicons/logo.png'; ?>">
				</a>

				<?php
					if ($this->request->params['controller'] == 'searches' &&
						$this->request->params['action'] == 'storeitems') {
				?>
					<div class="title-categories">
						<img alt="categories" src="<?php echo $siteUrl.'/frontend/images/categories.png'; ?>" title="categories"><br> <span>Categories</span>
					</div>
					<div class="title-filter">
						<img alt="filter" src="<?php echo $siteUrl.'/frontend/images/filter.png'; ?>" title="filter"><br> <span>Filter</span>
					</div>
				<?php
					}
				?>				
			</div>
			
			<?php if ($this->request->params['controller'] == 'searches' && $this->request->params['action'] == 'storeitems') { ?>
			<ul class="search_bar nav navbar-nav text-center-xs text-center-sm <?php echo ($this->request->params['controller'] == 'searches' && $this->request->params['action'] == 'storeitems') ? '' : 'navbar-right'; ?> "> 
				<li class="dropdown menuDropdown">
					<a href="javascript:void(0);" class="dropdown-toggle shopMenu" data-toggle="dropdown">
						<div class="visible-xs"><?php echo __('Shopping in', true); ?> <?php echo $storeCity[$cityId]. ' ';
						echo (!empty($areaId)) ? $storeArea[$areaId] : '';  ?> </div>
						<span class="mobileStore"><?php echo $storeDetails['Store']['store_name']; ?> <span class="caret"></span></span>
					</a>
					<div class="dropdown-menu shopMenuDropdown">
						<a class="menuclose_mobile" href="javascript:void(0);">x</a>
						<span class="caret"></span>
						<div class="detailshopList col-md-12">
							<h4 class="current-store-area"> <?php echo __('Shopping in', true); ?> - <span> <?php
							echo $storeCity[$cityId]. ' ';
							echo (!empty($areaId)) ? $storeArea[$areaId] : ''; ?> </span> 
							<a class="pointer" onclick="changeLocation();"> <?php echo __('Change area', true); ?></a></h4>
							<h3> <?php echo __('Choose a store to shop from', true); ?></h3>
							<ul class="products search_stores">
							<?php
							foreach ($storeList as $key => $value) { ?>
								<li class="product col-sm-2">
									<div class="product__inner">
										<figure class="product__image" >
												<a href="<?php echo $siteUrl.'/shop/'.$value['Store']['seo_url'].'/'.$value['Store']['id'];  ?>">
											   <!--  <span class="discount_image"><span>17% OFF</span></span> -->

											   <img alt="<?php echo $value['Store']['store_name']; ?>" src="<?php echo $cdn.'/storelogos/'.$value['Store']['store_logo']; ?>" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/frontend/images/no_store.jpg"; ?>'">
											   
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
				<li class="searchMenuFormList">
					<div class="searchMenuForm">
						<input type="search" onkeypress="productSearch(event);" id="searchKey" class="searchInput" placeholder="<?php echo __("I'm looking for...", true); ?>" >
						<a href="javascript:;" class="searchMenuFormClick" onclick="searchProducts();"><?php echo __('Submit', true); ?></a>
					</div>
				</li>
			</ul>
			<?php // searchFilterResults
			} ?>
			<div class="collapse navbar-collapse" id="example-navbar-collapse"> <?php

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

						if ($this->request->params['controller'] == 'searches' &&
							$this->request->params['action'] == 'index') { ?>

							<li><a href="" id="howWork"><?php echo __('How does it work'); ?></a></li>
							<li><a href=""><?php echo __('Get your store listed'); ?></a></li> <?php
						}
						
						if(!empty($loggedCheck) && ($loggedCheck['role_id'] == 4)){ ?>

							<li> <a href="<?php echo $siteUrl.'/customer/customers/myaccount'; ?>"> <?php echo __('My Account', true); ?></a> </li>
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
</header>
</div>
*/?>