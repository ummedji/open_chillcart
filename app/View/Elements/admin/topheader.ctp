<div class="page-header navbar navbar-fixed-top">
	<div class="page-header-inner">
		<div class="page-logo">
			<a h href="<?php echo $siteUrl.'/admin/dashboards/index'; ?>">Grocery</a>
			<div class="menu-toggler sidebar-toggler"></div>
		</div>
		<a href="javascript:void(0);" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
		
		<div class="page-top">
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<li class="hidden-xs">
						
						<a href="<?php echo $siteUrl.'/admin/Orders/index'; ?>">
							<i class="fa fa-shopping-cart"></i>
							<div class="logoutTxt">Orders</div>
						</a>
						
					</li>
					<li class="dropdown hidden-xs">
						
						<a class="dropdown-toggle" data-close-others="true" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="true">
							<i class="fa fa-automobile"></i>
							<div class="logoutTxt">Dispatch</div>
						</a>
						<ul class="dropdown-menu">
							<li class="<?php if($controllerName == 'orders' && $actionName == 'admin_order'): ?>active<?php endif; ?>">
								<a href="<?php echo $siteUrl.'/admin/orders/order'; ?>">
									
									Manage Order
								</a>
							</li>
							<li class="<?php if($controllerName == 'drivers' && $actionName == 'admin_index'): ?>active<?php endif; ?>">
								<a href="<?php echo $siteUrl.'/admin/drivers/index'; ?>">
									
									Manage Drivers
								</a>
							</li>
						</ul>
					</li>

					
					<li class="dropdown hidden-xs">
						
						<a class="dropdown-toggle" data-close-others="true" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="true">
							<i class="fa fa-cog"></i>
							<div class="logoutTxt">Settings</div>
						</a>
						<ul class="dropdown-menu">
							<li class="<?php if($controllerName == 'sitesettings' && $actionName == 'admin_index'): ?>active<?php endif; ?>">
								<a href="<?php echo $siteUrl.'/admin/sitesettings/index'; ?>">
									
									Site Settings
								</a>
							</li>
							<li>
								<a href="<?php echo $siteUrl.'/admin/sitesettings/paymentSetting'; ?>">
									
									Payment Settings
								</a>
							</li>
						</ul>
					</li>
					<li class="dropdown hidden-xs">
						<a class="dropdown-toggle" data-close-others="true" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="true">
							<i class="fa fa-shopping-cart"></i>
							<div class="logoutTxt">Store</div>
							
						</a>
						<ul class="dropdown-menu">
							<li class="<?php if($controllerName == 'stores' && $actionName == 'admin_index'): ?>active<?php endif; ?>">
								<a href="<?php echo $siteUrl.'/admin/stores/index'; ?>">
									
									Manage Store
								</a>
							</li>
							<li class="<?php if($controllerName == 'products' && $actionName == 'admin_index'): ?>active<?php endif; ?>">
								<a href="<?php echo $siteUrl.'/admin/products/index'; ?>">
									
									Manage Item
								</a>
							</li>
							<li>
								<a href="<?php echo $siteUrl.'/admin/Storeoffers/index'; ?>">
									
									Store Offer
								</a>
							</li>
							<li>
								<a href="<?php echo $siteUrl.'/admin/deals/index'; ?>">
									
									Store Deals
								</a>
							</li>
							<li>
								<a href="<?php echo $siteUrl.'/admin/Reviews/list'; ?>">
									
									Store Reviews
								</a>
							</li>
						</ul>
					</li>

					<li>
						<a href="<?php echo $siteUrl.'/admin/users/adminLogout'; ?>">
							<i class="fa fa-sign-out"></i>
							<div class="logoutTxt">Logout</div>
						</a>
					</li>
					

				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
	</div>
</div>