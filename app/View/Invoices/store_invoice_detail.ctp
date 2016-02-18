
<div class="contain">
	<div class="contain">
		<h3 class="page-title">
			Invoice 
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo $siteUrl.'/store/dashboards/index';?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo $siteUrl.'/store/invoices/index';?>">Invoice Manage</a>
				</li>
			</ul>
			<div class="page-toolbar">
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="portlet light">
			<div class="portlet-body">
				<div class="invoice">
					<div class="row invoice-logo">
						<div class="col-xs-6 invoice-logo-space">
							<img alt="" class="img-responsive" src="../images/walmart.png">
						</div>
						<div class="col-xs-6">
							<p><?php
								echo $invoice_detail['Invoice']['ref_id'];?>								
							</p>				
							
						</div>						
					</div>
					Cretated :<?php 
									 echo $invoice_detail['Invoice']['created']; 
							?></br>
							
					Period :<?php 
								 echo $invoice_detail['Invoice']['start_date'].' to '.
								 $invoice_detail['Invoice']['end_date']; 
							?>
					<hr>
					<div class="row">
						<div class="col-md-4 col-xs-12">
							<h3>Client:</h3>
							<ul class="list-unstyled">
								<li>
									 <?php 
									 echo $order_detail[0]['Store']['contact_name']; ?>
								</li>
								<li>
									 <?php 
									 echo $order_detail[0]['Store']['store_name']; ?>
								</li>
								<li>
									 <?php 
									 echo $area_list['Location']['area_name'].','.
									 $area_list['City']['city_name'].'-'.
									 $area_list['Location']['zip_code'].','.
									 $area_list['State']['state_name'].','.
									 $state_list['Country']['country_name']; ?>
								</li>
								
							</ul>
						</div>
						<div class="col-md-4 col-xs-12">
							<h3>About:</h3>
							<ul class="list-unstyled">
								<li>
									 ChillCart Ltd.
								</li>
								
							</ul>
						</div>
						<div class="col-md-4 col-xs-12 invoice-payment">
							<h3>Payment Details:</h3>
							<ul class="list-unstyled">
								<li>
									<strong>V.A.T Reg #:</strong> <?php
									echo $site_detail['Sitesetting']['vat_no'];
									?>
								</li>
								
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<table class="table table-striped table-hover">
							<thead>
							<tr>
								<th>
									 Invoice breakdown
								</th>
								<th>
									 Order Count
								</th>
								<th>
									 Amount
								</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>
									Total value for

								</td>
								<td><?php 
									echo $invoice_detail['Invoice']['total_order'];
								?>
									
								</td>
								<td><?php
									
									echo html_entity_decode($this->Number->currency($invoice_detail['Invoice']['subtotal'], $siteCurrency));
								?>									 
								</td>								
								
							</tr>
							<tr>
								<td>
									Customers paid cash for
									
								</td>
								<td><?php 
									echo $invoice_detail['Invoice']['cod_count'];

								?>
									
								</td>
								
								<td ><?php
									echo html_entity_decode($this->Number->currency($invoice_detail['Invoice']['cod_price'], $siteCurrency)); ?>
								</td>
								
							</tr>	
							<tr>
								<td>
									Customers prepaid online with card for 
									
								</td>
								<td><?php 
									echo $invoice_detail['Invoice']['card_count'];
								?>
									
								<td><?php
									
										echo html_entity_decode($this->Number->currency($invoice_detail['Invoice']['card_price'], $siteCurrency));
								?>									 
								</td>
								
							</tr>							
							</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						
						<div class="col-xs-8 invoice-block">
							<ul class="list-unstyled amounts" >
								<li>
									<strong>subtotal :</strong><?php
									

									echo html_entity_decode($this->Number->currency($invoice_detail['Invoice']['subtotal'], $siteCurrency));
								?>	 
								</li>
								<li>
									<strong>Customers paid VAT (<?php echo $site_detail['Sitesetting']['vat_percent'];?>%):</strong><?php
									
									echo html_entity_decode($this->Number->currency($invoice_detail['Invoice']['tax'], $siteCurrency));
								?>	 
								</li>
								<li>
									<strong>Total Commission with Card fee (
										<?php echo $site_detail['Sitesetting']['card_fee'];?>%):</strong> <?php
									
									echo html_entity_decode($this->Number->currency($invoice_detail['Invoice']['card_tax'], $siteCurrency));
								?>	
								</li>
								<li>
									<strong>Grand Total :</strong><?php
									
									echo html_entity_decode($this->Number->currency($invoice_detail['Invoice']['grand_total'], $siteCurrency));
								?>	
								</li>
							</ul>
							<br>
							<a onClick="javascript:window.print();" class="btn btn-lg blue hidden-print margin-bottom-5">
							Print <i class="fa fa-print"></i>
							</a>
							
						</div>
						<div class="portlet-body">
						<div class="table-toolbar">
						</div>
						<table class="table table-striped table-bordered table-hover" id="">
					<thead>
						<tr>
							<th>S_no</th>
							<th>order  Id</th>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Total</th>
							
						</tr>
					</thead>
					<tbody><?php 
					
					$count = 1;
					foreach($order_detail as $key=>$value){

						foreach($value['ShoppingCart'] as $key1 => $value1){?>
						<tr class="odd gradeX">
							<td><?php echo $count;?></td>
							<td><?php echo $value['Order']['ref_number'];?></td>
							<td><?php echo $value1['product_name'];?></td>
							<td><?php echo $value1['product_quantity'];?></td>
							<td><?php 
								echo html_entity_decode($this->Number->currency($value1
								['product_price'], $siteCurrency));?></td>
							<td><?php 
								echo html_entity_decode($this->Number->currency($value1['product_total_price'], $siteCurrency));?>
							</td>	
						</tr><?php 
						$count ++;
					}
					}?>
					</tbody>
				</table>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
