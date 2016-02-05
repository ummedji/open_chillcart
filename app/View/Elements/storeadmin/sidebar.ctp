<div class="page-container">
		<div class="page-sidebar-wrapper">
			<div class="page-sidebar navbar-collapse collapse">
				<!-- BEGIN SIDEBAR MENU -->
				<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-auto-scroll="true" data-slide-speed="200">
				<li class="start">
				<a href="<?php echo $siteUrl.'/store/dashboards/index';?>">
						<i class="fa fa-tachometer"></i>
						<span class="title">Dashboard</span>
						<span class="selected"></span>
					</a>
				</li>
				<li>
					<a href="javascript:void(0);">
						<i class="fa fa-male"></i>
						<span class="title">Admin</span>
						<span class="arrow"></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="<?php echo $siteUrl.'/store/users/changePassword';?>">
								<i class="fa fa-key"></i> Change Password
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/store/Stores/edit';?>">
						<i class="fa fa-cog"></i>
						<span class="title">Settings</span>
					</a>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/store/Categories/index'; ?>">
						<i class="fa fa-bars"></i>
						<span class="title">Category</span>
					</a>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/store/Categories/subCatIndex'; ?>">
						<i class="fa fa-user"></i>
						<span class="title">Sub Category</span>
					</a>
				</li>
				<!-- <li>
					<a href="<?php echo $siteUrl.'/store/Brands/index';?>">
						<i class="fa fa-user"></i>
						<span class="title">Brands</span>
					</a>
				</li> -->
				<li>
					<a href="<?php echo $siteUrl.'/store/Products/index';?>">
						<i class="fa fa-briefcase"></i>
						<span class="title">Manage Items</span>						
					</a>					
				</li><?php 
				if($loggedUser['Store']['dispatch'] == 'Yes'){?>				
				<li>
					<a href="javascript:void(0);">
						<i class="fa fa-automobile"></i>
						<span class="title">Dispatch</span>
						<span class="arrow"></span>
					</a>
					<ul class="sub-menu">
					<li class="<?php if($controllerName == 'orders' && $actionName == 'admin_order'): ?>			active<?php endif; ?>">
						<a href="<?php echo $siteUrl.'/store/orders/order'; ?>">
							<i class="fa fa-wrench"></i>
							Manage Order
						</a>
					</li>
					<li class="<?php if($controllerName == 'drivers' && $actionName == 'admin_index'): ?>			active<?php endif; ?>">
						<a href="<?php echo $siteUrl.'/store/drivers/index'; ?>">
							<i class="fa fa-wrench"></i>
							Manage Drivers
						</a>
					</li>
				</ul>
				</li><?php }?>
				<li>
					<a href="<?php echo $siteUrl.'/store/Orders/orderIndex';?>">
						<i class="fa fa-shopping-cart"></i>
						<span class="title">Order</span>
					</a>
				</li>
					<li><?php
						if($loggedUser['Store']['collection'] == 'Yes'){?>
						<a href="<?php echo $siteUrl.'/store/Orders/collectionOrder';?>">
							<i class="fa fa-shopping-cart"></i>
							<span class="title">Collection Order</span>
						</a><?php }?>
					</li>
				<li>
					<a href="<?php echo $siteUrl.'/store/Invoices/index';?>">
						<i class="fa fa-file-o"></i>
						<span class="title">Invoice</span>
					</a>
				</li>
				<li>
				<a href="<?php echo $siteUrl.'/store/Orders/index'; ?>">
						<i class="fa fa-file-text-o"></i>
						<span class="title">Report</span>
					</a>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/store/deals/index';?>">
						<i class="fa fa-file-text-o"></i>
						<span class="title">Deals</span>
					</a>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/store/Storeoffers/index';?>">
						<i class="fa fa-file-text-o"></i>
						<span class="title">Offers</span>
					</a>
				</li>
			</ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
</div>