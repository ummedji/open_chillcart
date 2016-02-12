<!-- BEGIN CONTENT -->
<div class="contain">
	<div class="contain">			
		<h3 class="page-title">Dashboard</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="javascript:void(0);">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="javascript:void(0);">Dashboard</a>
				</li>
			</ul>
			<!--<div class="page-toolbar">
				<div id="dashboard-report-range" class="tooltips btn btn-fit-height btn-sm green-haze btn-dashboard-daterange" data-container="body" data-placement="left" data-original-title="Change dashboard date range">
					<i class="icon-calendar"></i>
					&nbsp;&nbsp; <i class="fa fa-angle-down"></i>
				</div>
			</div>-->
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a class="dashboard-stat dashboard-stat-light blue-soft" href="#">
				<div class="visual">
					<i class="fa fa-comments"></i>
				</div>
				<div class="details">
					<div class="number"><?php 
					echo $dasboard_value['order_count'].
					'('.$this->Number->currency($dasboard_value['order_price'], $siteCurrency).')';
					?>

						 
					</div>
					<div class="desc">
						 Total Orders
					</div>
				</div>
				</a>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a class="dashboard-stat dashboard-stat-light red-soft" href="#">
				<div class="visual">
					<i class="fa fa-trophy"></i>
				</div>
				<div class="details">
					<div class="number">
						 12,5M$
					</div>
					<div class="desc">
						 Total Commission
					</div>
				</div>
				</a>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a class="dashboard-stat dashboard-stat-light green-soft" href="#">
				<div class="visual">
					<i class="fa fa-shopping-cart"></i>
				</div>
				<div class="details">
					<div class="number">
						 549
					</div>
					<div class="desc">
						 Total Turnover
					</div>
				</div>
				</a>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a class="dashboard-stat dashboard-stat-light purple-soft" href="#">
				<div class="visual">
					<i class="fa fa-globe"></i>
				</div>
				<div class="details">
					<div class="number"><?php
					echo $dasboard_value['store_count'];
					?>
						 
					</div>
					<div class="desc">
						 Total Stores
					</div>
				</div>
				</a>
			</div>
		</div>
	</div>
</div>