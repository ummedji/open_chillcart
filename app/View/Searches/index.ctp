
<div id="banner">
  <div class="container">
    <div class="bannerdesc text-center ">
      <div class="bannertext">
        <div class="watchvideo"> <a href="#" data-toggle="modal" data-target="#demo-3"><img src="<?php echo $siteUrl.'/frontend/images/video-bg-img.png'; ?>"/>
          <div class="videotext">
            <p>WATCH VIDEO</p>
          </div></a>
        </div>
        <div class="bannercaption">
          <h1>Your Favorite Local Stores Online</h1>
          <p>Enter Your Address To Order Groceries</p>
        </div>
      </div>
    </div>
  </div>
  <div class="bannerform">
    <div class="container">
      <div class="clearfix">
  
  <?php 

		echo $this->Form->create('Search') ;
			if (!empty($cityList)) {

				echo $this->Form->input('city',	
							array('type'=>'select',
							 		'options'=> array($cityList),
							 		'onchange' => 'locationList();',
							 		'id' => 'city',
							 		'empty' => __('Select City'),
							 		'div' => 'form-group',
							 		'label'=> false,
									'class'=>'form-control'));
			} else {
				echo $this->Form->input('city',
							array('type'=>'select',
							 		'id' => 'city',
							 		'empty' =>  __('Select City'),
							 		'div' => 'form-group',
							 		'label'=> false,
									'class'=>'form-control'));
			} 

			echo $this->Form->input('area',
						array('type'=>'select',
						 		'id' => 'location',
						 		'empty' => __('Select Area / Zipcode'),
						 		'div' => 'form-group mrnone',
							 		'label'=> false,
									'class'=>'form-control'));

			echo $this->Form->button(__("Let's go to shop"),
                              array('onclick' => 'return locationStore();','class'=>'btn btn-green btn-success')); ?>
  </div>
	</div>
	</div>
</div>
<div class="groceryworks" id="how_it_work">
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
<div class="container cmpnylogo">
  <div class="mrgTB30">
    <div class="text-center">
      <h2 class="blgrtitle"><span class="blackborder">OUR</span> <span class="greenborder">GROCERY STORE</span></h2>
    </div>
    <div class="clearfix grocerystorelogo as_logo_slide">
	<?php
	foreach($groceryStore as $key => $value) { ?>
	<div class="pull-left"><a href="<?php echo $siteUrl.'/shop/'.$value['Stores']['seo_url'].'/'.$value['Stores']['id'];  ?>"><img alt="<?php echo $value['Stores']['store_name']; ?>" src="<?php echo $cdn.'/storelogos/'.$value['Stores']['store_logo']; ?>" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/frontend/images/no_store.jpg"; ?>'"> </a></div>
	<?php } ?>
      
    </div>
  </div>
</div>
<div class="highlight-info">
  <div class="padding_slide1">
    <div class="container">
      <div class="text-center">
        <h2 class="whigrtitle"><span class="whiborder">SOME</span> <span class="greenborder">MILESTONES</span></h2>
      </div>
      <div class="clearfix">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 milestoneorders"><div class="clearfix mrgT100">
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 servblock">
            <div class="text-center">
              <p class="storenum bg-green"><a href=""><span id="count-orders"></span><span>+</span></a><span class="middleborder"></span>
              </p>
              <p class="ordertext">Orders</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-lg-offset-4 col-md-offset-4 servblock">
            <div class="text-center">
              <p class="storenum bg-blue"><a href=""><span id="count-stores"></span><span>+</span></a><span class="middleborder"></span></p>
              <p class="ordertext">Stores</p>
            </div>
          </div>
        </div></div>
      </div>
    </div>
  </div>
</div>
<div class="signupinfo ">
  <div class="padding_slide2">
    <div class="container">
      <div class="text-center">
        <h2 class="blgrtitle "><span class="blackborder">Sign Up</span> <span class="greenborder">Special Promotions</span></h2>
      </div>
      <p class="text-center mrgTB20">Get exclusive deals that you wont find anywhere else straight to your inbox!</p>
      <div class="clearfix">
        <div class="form-group">
          <label class="sr-only">Your Email Here</label>
          <input type="text" class="form-control emailicon2" id="email" placeholder="Email">
		  <div id="restext"></div>
        </div>
        <div class="text-center">
          <button type="button" onclick="ajaxpromotionalSignup()" class="btn btn-success ">Send</button>
        </div>
      </div>
    </div>
  </div>
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
