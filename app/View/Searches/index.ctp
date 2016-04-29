<div class="groceryworks">
  <section class="container">
    <div class="features">
      <div class="clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 groceryblock"> <a href="">
          <div class="greenbg hovereffect">
            <figure> <img src='<?php echo $siteUrl.'/frontend/images/storesearch.png'; ?>' alt='Store Search' />
              <figcaption>Store Search</figcaption>
            </figure>
          </div>
          </a> </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 groceryblock"><a href="">
          <div class="redbg hovereffect">
            <figure> <img src='<?php echo $siteUrl.'/frontend/images/place-order.png'; ?>' alt='Place Order' />
              <figcaption>Place Order</figcaption>
            </figure>
          </div>
          </a></div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 groceryblock"><a href="">
          <div class="yellowbg hovereffect">
            <figure> <img src='<?php echo $siteUrl.'/frontend/images/schedule-delivery.png'; ?>' alt='Schedule Delivery' />
              <figcaption>Schedule Delivery</figcaption>
            </figure>
          </div>
          </a></div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 groceryblock"><a href="">
          <div class="bluebg hovereffect">
            <figure> <img src='<?php echo $siteUrl.'/frontend/images/order-delivered.png';?>' alt='Get Order Delivered' />
              <figcaption>Get Order Delivered</figcaption>
            </figure>
          </div>
          </a></div>
      </div>
      <div class="grocerydetail">
        <h2 class="blgrtitle"><span class="blackborder">How</span> <span class="greenborder">Grocery Works</span></h2>
        <p><span class="rightarrow"></span>Know more about your online grocery shopping and make easy shopping</p>
      </div>
    </div>
  </section>
</div>
<!--
<section id="howItWork">
	<a id="close"></a>
	<h2>How Grocery Works</h2>
	<p>Know more about your online grocery shopping and make easy shopping</p>
	<div class="clear"></div>
	<aside>
		<img alt="" src="<?php echo $siteUrl; ?>/frontend/images/search.png" />
		<span class="ico"></span>
		<h3>Store Search</h3>
	</aside>
	<aside>
		<img alt="" src="<?php echo $siteUrl; ?>/frontend/images/cart.png" />
		<span class="ico"></span>
		<h3>Place Order</h3>
	</aside>
	<aside>
		<img alt="" src="<?php echo $siteUrl; ?>/frontend/images/schedule.png" />
		<span class="ico"></span>
		<h3>Schedule Delivery</h3>
	</aside>
	<aside>
		<img alt="" src="<?php echo $siteUrl; ?>/frontend/images/delivery.png" />
		<span class="ico"></span>
		<h3>Get Order Delivered</h3>
	</aside>
	<div class="clear"></div>
	<div id="txtAni">
		<ul>
			<li>
				<img alt="" src="<?php echo $siteUrl; ?>/frontend/images/arr1.png"/>
				<p>Search here for your favourite local store</p>
			</li>
			<li>
				<img alt="" src="<?php echo $siteUrl; ?>/frontend/images/arr2.png"/>
				<p>Add the items to your cart</p>
			</li>
			<li>
				<img alt="" src="<?php echo $siteUrl; ?>/frontend/images/arr3.png"/>
				<p>Schedule the delivery</p>
			</li>
			<li>
				<img alt="" src="<?php echo $siteUrl; ?>/frontend/images/arr4.png"/>
				<p>Get it delivered to your steps</p>
			</li>
		</ul>
	</div>
	<div class="clear"></div>
				<!-- <a href="" id="tryBtn">Try Us Out</a> -->
<!--</section>
<main>
	<section id="searchBar">
		<h3>Your favorite local stores online<h3>
		<p>Enter your address to order groceries</p> <?php 

		/*echo $this->Form->create('Search') ;
			if (!empty($cityList)) {

				echo $this->Form->input('city',
							array('type'=>'select',
							 		'options'=> array($cityList),
							 		'onchange' => 'locationList();',
							 		'id' => 'city',
							 		'empty' => __('Select City'),
							 		'div' => false,
							 		'label'=> false));
			} else {
				echo $this->Form->input('city',
							array('type'=>'select',
							 		'id' => 'city',
							 		'empty' =>  __('Select City'),
							 		'div' => false,
							 		'label'=> false));
			} 

			echo $this->Form->input('area',
						array('type'=>'select',
						 		'id' => 'location',
						 		'empty' => __('Select Area / Zipcode'),
						 		'div' => false,
						 		'label'=> false));

			echo $this->Form->button(__("Let's go to shop"),
                              array('onclick' => 'return locationStore();')); ?>

			<div id="searchError" class="form-error"></div><?php
		echo $this->Form->end(); ?>

		<div class="clear"></div>
	</section>
</main>
<div id="video">
	<p>Watch our video here</p>
	<div id="vidImg"></div>
</div> */?>

<!--<footer>
	<ul>
		<li><a href="">Home</a></li>
		<li><a href="">About Us</a></li>
		<li><a href="">Blog</a></li>
		<li><a href="">Partner Portal</a></li>
		<li><a href="">Press</a></li>
		<li><a href="">Locations</a></li>
		<li><a href="">T&C </a></li>
		<li><a href="">FAQ </a></li>
	</ul>
	<div class="clear"></div>
	<a href="" id="facebook"></a>
	<a href="" id="twitter"></a>
	<a href="" id="gplus"></a>
	<a href="" id="youtube"></a>
</footer>-->

<?php echo $this->element('frontend/footer'); ?>
<script type="text/javascript">
function locationStore () {
	var city 		= $.trim($("#city").val());
	if(city == ''){
		$("#searchError").html("<?php echo __('Please select city'); ?>");
		$("#city").focus();
		return false;
	}
}

</script>