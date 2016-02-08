<div class="container bannerrelative">
	<div class="main-content clearfix">
		<div class="grocery-box col-md-10 col-lg-8 col-sm-12 col-md-offset-1 col-lg-offset-2">
			<div class="storeImg"></div>
			<h1><?php echo __('Your local farmers markets delivered to your door.', true); ?></h1>
			<p> <?php echo __('Shop online direct from your local farmers markets for the freshest food you can buy. Fresh Nation shops different farmers markets every day so selections differ by day too.', true); ?></p>
			<?php echo $this->Form->create('Search', array('class' => 'shop-form')) ; ?>
				<div class="col-md-5 col-sm-5 shop-select"> <?php
					if (!empty($cityList)) {

						echo $this->Form->input('city',
									array('type'=>'select',
									 		'class'=>'selectpicker',
									 		'options'=> array($cityList),
									 		'onchange' => 'locationList();',
									 		'id' => 'city',
									 		'empty' => __('Select City'),
									 		'label'=> false));
					} else {
						echo $this->Form->input('city',
									array('type'=>'select',
									 		'class'=>'selectpicker',
									 		'id' => 'city',
									 		'empty' =>  __('Select City'),
									 		'label'=> false));
					} ?>
				</div>

				<div class="col-md-4 col-sm-5 shop-select"> <?php
					echo $this->Form->input('area',
								array('type'=>'select',
								 		'class'=>'selectpicker',
								 		'id' => 'location',
								 		'empty' => __('Select Area / Zipcode'),
								 		'label'=> false)); ?>
				</div>
				<div class="col-md-3 col-sm-2 shop-button"> <?php
					echo $this->Form->button(__('Submit'),
		                              array('class'=>'btn indexbutton',
		                              		'onclick' => 'return locationStore();')); ?>
				</div> 
				<div id="searchError" class="form-error"></div><?php
			echo $this->Form->end(); ?>
			<div class="pincode"> <?php echo __('For Example : City &rarr; Chennai , Area &rarr;MMDA.', true); ?></div>
		</div>
	</div>
</div>

<div class="hiw_section" id="hiw_section">
		<div class="container">
			
			<div class="page-header page-header-with-icon">
			   <i class="fa fa-gears"></i>
			   <h2>  <?php echo __('How Grocery Works', true); ?>
			      		      
			      <small>  <?php echo __('Know more about your online grocery shopping and make easy shopping', true); ?></small>			      
			   </h2>
			</div>			

			<div class="row panels">
			   <div class="col-sm-3 panel-item">
			      <a class="panel panel-image" href="javascript:void(0);">
			         <div class="panel-icon">
			            <i class="fa fa-search icon"></i>
			         </div>
			         <div class="panel-heading">
			         	<img class="img-responsive-sm" src="<?php echo $siteUrl.'/webroot/frontend/images/storeimage.jpg'; ?>">
			         	<div class="hiw_mask"></div>
			         </div>
			         <div class="panel-body">
			            <h3 class="panel-title">  <?php echo __('Store Search', true); ?></h3>
			            <p></p>
			            <div>
			               <p>  <?php echo __('Search your nearby store easily in grocery', true); ?></p>
			            </div>
			            <p></p>
			         </div>
			      </a>
			   </div>
			   <div class="col-sm-3 panel-item">
			      <a class="panel panel-image" href="javascript:void(0);">
			         <div class="panel-icon">
			            <i class="fa fa-cart-plus icon"></i>
			         </div>
			         <div class="panel-heading">
			         	<img class="img-responsive-sm" src="<?php echo $siteUrl.'/webroot/frontend/images/placeorderimage.jpg'; ?>">
			         	<div class="hiw_mask"></div>
			         </div>
			         <div class="panel-body">
			            <h3 class="panel-title"> <?php echo __('Place Order', true); ?> </h3>
			            <p>  <?php echo __('Make your needs ordered faster and get in to cart', true); ?></p>
			         </div>
			      </a>
			   </div>
			   <div class="col-sm-3 panel-item">
			      <a class="panel panel-image" href="javascript:void(0);">
			         <div class="panel-icon">
			            <i class="fa fa-clock-o icon"></i>
			         </div>
			         <div class="panel-heading">
			         	<img class="img-responsive-sm" src="<?php echo $siteUrl.'/webroot/frontend/images/scheduleimage.jpg'; ?>">
			         	<div class="hiw_mask"></div>
			         </div>
			         <div class="panel-body">
			            <h3 class="panel-title"> <?php echo __('Schedule Delivery', true); ?></h3>
			            <p>  <?php echo __('Schedule your time to deliver your needs on time', true); ?></p>
			         </div>
			      </a>
			   </div>
			   <div class="col-sm-3 panel-item">
			      <a class="panel panel-image" href="javascript:void(0);">
			         <div class="panel-icon">
			            <i class="fa fa-gift icon"></i>
			         </div>
			         <div class="panel-heading">
			         	<img class="img-responsive-sm" src="<?php echo $siteUrl.'/webroot/frontend/images/getdeliverimages.jpg'; ?>">
			         	<div class="hiw_mask"></div>
			         </div>
			         <div class="panel-body">
			            <h3 class="panel-title">  <?php echo __('Get Order Delivered', true); ?></h3>
			            <p>  <?php echo __('Your order will be delivered to your door soon', true); ?></p>
			         </div>
			      </a>
			   </div>
			</div>

		</div>
	</div>
	<div class="testimonial-section">
		<div class="container">
			
			<div class="page-header page-header-with-icon">
			   <i class="fa fa-magic"></i>
			   <h2> <?php echo __('Testimonials', true); ?> </h2>
			</div>
			<div class="row quotes">		   

				<div class="carousel carousel-default slide carousel-auto" id="carousel-testimonials">
				   <div class="carousel-inner">
				      <div class="item active quote">
				         <div class="col-sm-12 text-center">
				            <p class="lead">  <?php echo __('" When we found grocery, it was easier for us to market and the price was better than anything out there.Update your Business information across the web from one place.Thanks to grocery for best support. "', true); ?> </p>
				            <div class="author-wrapper">
				               <p class="author">
				                  <strong>  <?php echo __('Peter Johnson', true); ?> </strong>,
				                   <?php echo __('Store owner', true); ?>
				               </p>
				            </div>
				         </div>
				      </div>
				      <div class="item quote">
				         <div class="col-sm-12 text-center">
				            <p class="lead">   <?php echo __('" When we found grocery, it was easier for us to market and the price was better than anything out there.Update your Business information across the web from one place.Thanks to grocery for best support. "', true); ?></p>
				            <div class="author-wrapper">
				               <p class="author">
				                  <strong> <?php echo __('Thomas Paul', true); ?></strong>,
				                   <?php echo __('Store owner', true); ?>
				               </p>
				            </div>
				         </div>
				      </div>
				      <div class="item quote">
				         <div class="col-sm-12 text-center">
				            <?php echo __('" When we found grocery, it was easier for us to market and the price was better than anything out there.Update your Business information across the web from one place.Thanks to grocery for best support. "', true); ?></p>
				            <div class="author-wrapper">
				               <p class="author">
				                  <strong> <?php echo __('Yuvaraj', true); ?></strong>,
				                   <?php echo __('Store owner', true); ?> 
				               </p>
				            </div>
				         </div>
				      </div>
				      <div class="item quote">
				         <div class="col-sm-12 text-center">
				            <p class="lead">   <?php echo __('" When we found grocery, it was easier for us to market and the price was better than anything out there.Update your Business information across the web from one place.Thanks to grocery for best support. "', true); ?> </p>
				            <div class="author-wrapper">
				               <p class="author">
				                  <strong> <?php echo __('Vincent Sanjai', true); ?></strong>,
				                   <?php echo __('Store owner', true); ?>
				               </p>
				            </div>
				         </div>
				      </div>
				   </div>
				   <ol class="carousel-indicators">
				      <li class="active" data-slide-to="0" data-target="#carousel-testimonials"></li>
				      <li data-slide-to="1" data-target="#carousel-testimonials"></li>
				      <li data-slide-to="2" data-target="#carousel-testimonials"></li>
				      <li data-slide-to="3" data-target="#carousel-testimonials"></li>
				   </ol>
				</div>


			</div>

		</div>
	</div>
		



<footer id="footer">
   <div id="footer-main">
      <div class="container">
         <div class="row">
            <div class="col-md-3 col-sm-6 info-box footer-widget">
               <div class="logo-container">
               		<h3 class="title"> <?php echo __('GROCERY', true); ?></h3>
               </div>
               
            </div>
            <div class="col-md-4 col-sm-6 info-box footer-widget">
               <h3 class="title"> <?php echo __('Contact', true); ?></h3>
               <div class="icon-boxes">
                  <div class="icon-box">
                     <div class="icon icon-wrap">
                        <i class="fa fa-map-marker"></i>
                     </div>
                     <div class="content">  <?php echo __('No 7,Water Tank Road, MMDA,Arumbakkam,Chennai.', true); ?>
                        
                     </div>
                  </div>
                  <div class="icon-box">
                     <div class="icon icon-wrap">
                        <i class="fa fa-phone"></i>
                     </div>
                     <div class="content">
                        <a href="tel:+012 345 678">  <?php echo __('+044 49524266', true); ?></a>
                     </div>
                  </div>
                  <div class="icon-box">
                     <div class="icon icon-wrap">
                        <i class="fa fa-envelope"></i>
                     </div>
                     <div class="content">
                        <a href="mailto:info@bublinastudio.com">  <?php echo __('info@groceryncart.com', true); ?></a>
                     </div>
                  </div>
                  <div class="icon-box">
                     <div class="icon icon-wrap">
                        <i class="fa fa-globe"></i>
                     </div>
                     <div class="content">
                        <a href="http://www.groceryncart.com">  <?php echo __('www.groceryncart.com', true); ?></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-2 col-sm-6 info-box footer-widget">
               <div class="flickr-widget widget">
                  	<h3 class="title"><?php echo __('Store'); ?></h3>                  	
                    <p><a href="javascript:void(0);">  <?php echo __('About Us', true); ?></a></p>
                    <p><a href="javascript:void(0);">  <?php echo __('Team', true); ?></a></p>
                    <p><a href="javascript:void(0);">  <?php echo __('Contact Us', true); ?></a></p>
	              
               </div>
               
            </div>
            <div class="col-md-3 col-sm-6 info-box footer-widget">
               <!-- start twitter widget -->
               <h3 class="title">  <?php echo __('Follow us', true); ?></h3>
               <div class="icon-boxes">
                  <div class="icon-box">                     
                     <div class="content">
                        <div class="links">
		                  <a class="btn btn-circle btn-medium-light btn-sm" href="#"><i class="fa fa-facebook text-dark"></i></a>
		                  <a class="btn btn-circle btn-medium-light btn-sm" href="#"><i class="fa fa-twitter text-dark"></i></a>
		                  <a class="btn btn-circle btn-medium-light btn-sm" href="#"><i class="fa fa-tumblr text-dark"></i></a>
		                </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="footer-copyright">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 clearfix">
               <p class="copyright"> &copy; <?php echo __('Copyright', true); ?> 2016
                  <a href="http://www.groceryncart.com/">  <?php echo __('Groceryncart', true); ?></a>.
                  	 <?php echo __('All Rights Reserved', true); ?>.
               </p>
               
            </div>
         </div>
      </div>
   </div>
</footer>

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