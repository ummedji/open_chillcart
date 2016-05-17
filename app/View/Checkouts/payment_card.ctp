<div class="row">
                             <form>
                             <div class="col-md-12"><div class="cardDetailHead">Cash on delivery</div></div>
                             <div class="clearfix"></div>
                                 <div class="col-md-6">
                                   <fieldset>
                                       <input type="radio" name="data[Order][paymentMethod]" value="cod" id="cod" checked="checked">
                                       <label class="editpayment" for="cod">
                                       <img style="height:24px; vertical-align: middle;" alt="cod_icon" title="cod_icon" src="https://testing.chillcart.ie/frontend/images/cod_icon.png">

                                                                               <span class="editAdd ">Cash on delivery</span>
                                       </label>
                                   </fieldset>
                                   <div class="clearfix"></div>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="col-md-12"><div class="cardDetailHead">Saved Card Details</div></div>
                                 <div class="clearfix"></div>
								 <?php

									foreach ($stripeCards as $key => $card) { ?>
										<div class="col-md-6">
										   <fieldset>
										   <input type="radio" name="data[Order][paymentMethod]" value="<?php echo $card['StripeCustomer']['id']; ?>" id="<?php echo $card['StripeCustomer']['id']; ?>" />
											<label class="editpayment" for="<?php echo $card['StripeCustomer']['id']; ?>">
				        						
				        						<div class="card_info">
				        							<span class="editAdd contain truncate">
				        								<img style="height:24px; vertical-align: middle;" alt="cod_icon" title="cod_icon" src="<?php echo $siteUrl.'/	frontend/images/debit_card.png'; ?>">
				        								<?php echo $card['StripeCustomer']['customer_name']; ?>
				        							</span>
				        							<p class="margin-t-20">XXXX XXXX XXXX <?php echo $card['StripeCustomer']['card_number']; ?> </p>	        							
				        						</div>  
				        					</label>
											</fieldset>
				        				</div>
										<div class="clearfix"></div>
				        			<?php } ?>
								 <div class="col-md-12"><a class="addbtn btn" data-target="#demo-15" data-toggle="modal"><span class="cardiconwt"></span>Add Card</a>  </div>
								 
								 
                               </form>


                            </div>
                            



<?php 

/*<div class="alert alert-success" id="cardMessage"><?php echo __('Your card has been added successfully'); ?></div>
<div class="panel panel-default">
	<div class="panel-body addressBg">
		<div class="panel-subheading">
		<h3 class="clearfix">
				<span class="pull-left"><?php echo __('Payment Details', true); ?> </span>								
			</h3>
			<div class="paymentWrapper clearfix">
				<div class="row">
					<div class="col-md-12"><div class="cardDetailHead"><?php echo __('Cash on delivery', true); ?></div></div>
					<div class="col-md-4">
						<label class="editpayment active">
							<img style="height:24px;" alt="cod_icon" title="cod_icon" src="<?php echo $siteUrl.'/frontend/images/cod_icon.png'; ?>">
    						<input type="radio" name="data[Order][paymentMethod]" value="cod" checked = "checked"/>
							<span class="editAdd "><?php echo __('Cash on delivery', true); ?></span>
    					</label> 
    				</div>
    			</div>
				<div class="row">								

    				<div class="col-md-12">
    					<div class="cardDetailHead"><?php echo __('Saved Card Details', true); ?>
    					<span class="pull-right">
							<a class="addnewAdrr" data-toggle="modal" data-target="#addpayment" href="javascript:void(0);">
								<i class="fa fa-plus"></i> &nbsp;<?php echo __('Add Card', true); ?>
							</a>
						</span>
    					</div>
    					
    				</div>
    				<?php

					foreach ($stripeCards as $key => $card) { ?>
						<div class="col-md-4 col-xs-12">
							<label class="editpayment">
        						<input type="radio" name="data[Order][paymentMethod]" value="<?php echo $card['StripeCustomer']['id']; ?>" />
        						<div class="card_info">
        							<span class="editAdd contain truncate">
        								<img style="height:24px;" alt="cod_icon" title="cod_icon" src="<?php echo $siteUrl.'/	frontend/images/debit_card.png'; ?>">
        								<?php echo $card['StripeCustomer']['customer_name']; ?>
        							</span>
        							<p class="margin-t-20">XXXX XXXX XXXX <?php echo $card['StripeCustomer']['card_number']; ?> </p>	        							
        						</div>  
        					</label>
        				</div>
        			<?php } ?>
				</div>

				
			</div>	
		</div>

		<div class="checkout-bottom checkoutbtm">
			<a onclick="checkoutpagintaion('#payment','#reviewConform');" class="btn btn-primary pull-right"><?php echo __('Continue', true); ?></a>
			<a onclick="checkoutpagintaion('#payment','#deliverAddress');" class="btn btn-default pull-left"><?php echo __('Back to Address', true); ?></a>
		</div>
	</div>
</div>

<script type="text/javascript">


setTimeout(function(){				
    $('#cardMessage').fadeOut();
},3000);

$(".paymentWrapper .editpayment").click(function() {
	$(".paymentWrapper .editpayment").removeClass('active');
	$(this).addClass('active');		
	
});

</script>
*/
?>