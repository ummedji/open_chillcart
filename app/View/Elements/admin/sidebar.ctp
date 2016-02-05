<?php
    $controllerName = $actionName = "";
    
    if(isset($this->request->params['controller']) && $this->request->params['controller'] != "")
    	$controllerName = $this->request->params['controller'];
                                                            
     if(isset($this->request->params['action']) && $this->request->params['action'] != "")
        $actionName = $this->request->params['action'];

    //exit();
?> 


<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu" data-auto-scroll="true" data-slide-speed="200">
			<li class="<?php if($controllerName == 'dashboards' && $actionName == 'admin_index'): ?>start active<?php endif; ?>">
				<a href="<?php echo $siteUrl.'/admin/dashboards/index'; ?>">
					<i class="fa fa-tachometer"></i>
					<span class="title">Dashboard</span>
					<span class="selected"></span>
				</a>
			</li>


			<!-- <li class="<?php if($controllerName == 'users' && $actionName == 'changepassword'): ?>start active<?php endif; ?>">
                    <a href="<?php echo $siteUrl.'/admin/users/changePassword'; ?>">  
                        <i class="icon-home"></i>
                        <span class="title"><?php echo __("Dashboard", true); ?></span>
                        <span class="selected"></span>
                    </a>
                </li> -->


			<li class="<?php if($controllerName == 'users' && $actionName == 'admin_changePassword'): ?>start active<?php endif; ?>">
				<a href="javascript:void(0);">
					<i class="fa fa-male"></i>
					<span class="title">Admin</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li class="<?php if($controllerName == 'users' && $actionName == 'admin_changepassword'): ?>active<?php endif; ?>">
						<a href="<?php echo $siteUrl.'/admin/users/changePassword'; ?>">  
	                        <i class="fa fa-key"></i> Change Password
	                    </a>
					</li>
				</ul>
			</li>
			<li>
				<a href="javascript:void(0);">
					<i class="fa fa-cog"></i>
					<span class="title">Settings</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li class="<?php if($controllerName == 'sitesettings' && $actionName == 'admin_index'): ?>active<?php endif; ?>">
						<a href="<?php echo $siteUrl.'/admin/sitesettings/index'; ?>">
							<i class="fa fa-file-text-o"></i>
							Site Settings
						</a>
					</li>
					<li>
						<a href="<?php echo $siteUrl.'/admin/sitesettings/paymentSetting'; ?>">
							<i class="fa fa-money"></i>
							Payment Settings
						</a>
					</li>
					<li>
						<a href="<?php echo $siteUrl.'/admin/sitesettings/translation'; ?>">
							<i class="fa fa-money"></i>
							Translation Settings
						</a>
					</li>
				</ul>
			</li>


			<li class="<?php if($controllerName == 'stores' && $actionName == 'admin_index'): ?>start active<?php endif; ?>">
				<a href="javascript:void(0);">
					<i class="fa fa-shopping-cart"></i>
					<span class="title">Store</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li class="<?php if($controllerName == 'stores' && $actionName == 'admin_index'): ?>active<?php endif; ?>">
						<a href="<?php echo $siteUrl.'/admin/stores/index'; ?>">
							<i class="fa fa-wrench"></i>
							Manage Store
						</a>
					</li>
					<li class="<?php if($controllerName == 'products' && $actionName == 'admin_index'): ?>active<?php endif; ?>">
						<a href="<?php echo $siteUrl.'/admin/products/index'; ?>">
							<i class="fa fa-wrench"></i>
							Manage Item
						</a>
					</li>
					<li>
						<a href="<?php echo $siteUrl.'/admin/Storeoffers/index'; ?>">
							<i class="fa fa-user"></i>
							Store Offer
						</a>
					</li>
					<li>
						<a href="<?php echo $siteUrl.'/admin/deals/index'; ?>">
							<i class="fa fa-user"></i>
							Store Deals
						</a>
					</li>
					<li>
						<a href="<?php echo $siteUrl.'/admin/Reviews/list'; ?>">
							<i class="fa fa-user"></i>
							Store Reviews
						</a>
					</li>
				</ul>
			</li>
			
			<li>
				<a href="<?php echo $siteUrl.'/admin/Orders/index'; ?>">
					<i class="fa fa-shopping-cart"></i>
					<span class="title">Orders</span>
				</a>
			</li>

			<li>
				<a href="<?php echo $siteUrl.'/admin/Orders/collectionOrders'; ?>">
					<i class="fa fa-shopping-cart"></i>
					<span class="title">Collection Orders</span>
				</a>
			</li>

			<li class="<?php if($controllerName == 'orders' && $actionName == 'admin_order'): ?>start active<?php endif; ?>">
				<a href="javascript:void(0);">
					<i class="fa fa-automobile"></i>
					<span class="title">Dispatch</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li class="<?php if($controllerName == 'orders' && $actionName == 'admin_order'): ?>active<?php endif; ?>">
						<a href="<?php echo $siteUrl.'/admin/orders/order'; ?>">
							<i class="fa fa-wrench"></i>
							Manage Order
						</a>
					</li>
					<li class="<?php if($controllerName == 'drivers' && $actionName == 'admin_index'): ?>active<?php endif; ?>">
						<a href="<?php echo $siteUrl.'/admin/drivers/index'; ?>">
							<i class="fa fa-wrench"></i>
							Manage Drivers
						</a>
					</li>
				</ul>
			</li>

			<li>
				<a href="<?php echo $siteUrl.'/admin/Categories/index'; ?>">
					<i class="fa fa-bars"></i>
					<span class="title">Category</span>
				</a>
			</li>

			<li>
				<a href="<?php echo $siteUrl.'/admin/Categories/subCatIndex'; ?>">
					<i class="fa fa-sitemap"></i>
					<span class="title">Sub Category</span>
				</a>
			</li>
			<!-- <li>
				<a href="<?php echo $siteUrl.'/admin/Brands/index'; ?>">
					<i class="fa fa-tachometer"></i>
					<span class="title">Brands</span>
				</a>
			</li> -->
			<li>
				<a href="javascript:void(0);">
					<i class="fa fa-briefcase"></i>
					<span class="title">Management</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="<?php echo $siteUrl.'/admin/Newsletters/index'; ?>">
							<i class="fa fa-envelope-o"></i> Newsletter
						</a>
					</li>
					<!--<li>
						<a href="<?php echo $siteUrl.'/admin/Vouchers/index'; ?>">
							<i class="fa fa-gift"></i> Voucher
						</a>
					</li>-->
				</ul>
			</li>
			<li class="<?php if($controllerName == 'states' || $controllerName == 'states' || $controllerName == 'cities' || $controllerName == 'locations'): ?>start active<?php endif; ?>">
				<a href="javascript:void(0);">
					<i class="fa fa-map-marker"></i>
					<span class="title">Location</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li class="<?php if($controllerName == 'countries'): ?>active<?php endif; ?>">
						<a href="<?php echo $siteUrl.'/admin/countries/index'; ?>">
							<i class="fa fa-map-o"></i> Country
						</a>
					</li>
					<li class="<?php if($controllerName == 'states'): ?>active<?php endif; ?>">
						<a href="<?php echo $siteUrl.'/admin/states/index'; ?>">
							<i class="fa fa-map-o"></i> State
						</a>
					</li>
					<li class="<?php if($controllerName == 'cities'): ?>active<?php endif; ?>">
						<a href="<?php echo $siteUrl.'/admin/cities/index'; ?>">
							<i class="fa fa-map-o"></i> City
						</a>
					</li>
					<li class="<?php if($controllerName == 'locations'): ?>active<?php endif; ?>">
						<a href="<?php echo $siteUrl.'/admin/locations/index'; ?>">
							<i class="fa fa-street-view"></i> Area / Zipcode
						</a>
					</li>
				</ul>
			</li>
			


			
			<li>
				<a href="<?php echo $siteUrl.'/admin/Customers/index'; ?>">
					<i class="fa fa-shopping-cart"></i>
					<span class="title">Customer</span>
				</a>
			</li>
			
			<li>
				<a href="<?php echo $siteUrl.'/admin/Invoices/index'; ?>">
					<i class="fa fa-file-o"></i>
					<span class="title">Invoice</span>
				</a>
			</li>
			<li>
				<a href="<?php echo $siteUrl.'/admin/Orders/reportIndex'; ?>">
					<i class="fa fa-file-text-o"></i>
					<span class="title">Report</span>
				</a>
			</li>
		</ul>
	</div>
</div>