<script src="<?php echo $this->webroot; ?>frontend/js/jquery.stellar.min.js" type="text/javascript"></script>
<div id="banner" class="innerbanner">
  <div class="container">
    <div class="bannerdesc text-center">
      <div class="bannertext">
        <div class="bannercaption">
          <h1>Categories</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="bannerbg"></div>
</div>

<section class="container"> </section>
<div class="innercontentsection">
  <div class="container">
    <div class="text-center mrgTB20">
      <h2 class="blgrtitle "><span class="blackborder">OUR</span> <span class="greenborder"><?php echo __('Gorcery store', true); ?></span></h2>
    </div>
	
	
    <div class="content">
			<div class="changelocblock">
			<div class="changlocinnbl"> <a class="btn addbtn changlocbtn" onclick="showLocation()">change location</a>
			<div class="changeloc-popup">
			<h2>change location</h2>
			<div class="locfield pad20">
			<div class="form-group">
			<label class="sr-only">City</label>
			<?php
			print_r($cityList);
			if (!empty($cityList)) {
				echo $this->Form->create('Search',array(
    'url' => array('controller' => 'searches', 'action' => 'index'))) ;
	
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
                              array('onclick' => 'return locationStore();','class'=>'btn btn-green btn-success addbtn'));

			?>
			<!-- <select class="form-control">
			<option selected="">Select City</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
			</select> -->
			</div>
			<div class="form-group">
			<label class="sr-only">Area</label>
			<?php 
			echo $this->Form->input('area',
						array('type'=>'select',
						 		'id' => 'location',
						 		'empty' => __('Select Area / Zipcode'),
						 		'div' => 'form-group mrnone',
							 		'label'=> false,
									'class'=>'form-control'));
			?>
			<!-- <select class="form-control">
			<option selected="">Select Area</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
			</select> -->
			</div>
			<div class="text-center"><?php echo $this->Form->button(__("Let's go to shop"),
                              array('onclick' => 'return locationStore();','class'=>'btn btn-green btn-success addbtn')); ?> </div>
			</div>
			</div>
			</div>
			</div>
			<div class="row storelist">
			<div class="col-md-9 col-sm-12 floatnone mrgauto">
			<div class="clearfix">
				<?php
				$i = 1;
				foreach($storeList as $key => $value) {
				if($i%3 == 0) {
				echo "</div>"; // close div if it's not the first
				echo "<div class='row storelist'>";
				}
				?>
			     
			<div class="col-md-4 col-sm-6 storebl mrgB20">
				<div class="flipper"><div class="storeimg"> <a href=""><img src="<?php echo $cdn.'/storelogos/'.$value['Store']['store_logo']; ?>"></a></div>
				<div class="storefirstbl"> <a href="">
				<p>ShopEasy</p>
				<p>Min Order -   5.00</p>
				<ul class="starcredit">
				<li><span class="staricon"></span></li>
				<li><span class="staricon"></span></li>
				<li><span class="staricon"></span></li>
				<li><span class="staricon"></span></li>
				<li><span class="staricon"></span></li>
				</ul>
				</a> </div></div>
			</div>
			
			<?php $i++; } ?>
			</div>	
			</div>
			</div>
	
	
	</div>
	</div>
	</div>
	
	<?php echo $this->element('frontend/footer'); ?>
    <?php
/*  <div class="row storelist">
        <div class="col-md-3 col-sm-6 storebl mrgB20">
          <div class="storeimg storefirstbl"> <a href="">
            <p>ShopEasy</p>
            <p>Min Order -   5.00</p>
            <ul class="starcredit">
              <li><span class="staricon"></span></li>
              <li><span class="staricon"></span></li>
              <li><span class="staricon"></span></li>
              <li><span class="staricon"></span></li>
              <li><span class="staricon"></span></li>
            </ul>
            </a>
		  </div>
        </div>
		$i = 1;
	foreach($storeList as $key => $value) {
	if($i%3 == 0) {
    echo "</div>"; // close div if it's not the first
    echo "<div class='row storelist'>";
	}
	?>
	<!-- <div class="col-md-4 col-sm-6 storebl mrgB20">
        <div class="flipper">  <div class="storeimg"> <a href=""><img src="<?php echo $value['Store']['store_name']; ?>" src="<?php echo $cdn.'/storelogos/'.$value['Store']['store_logo']; ?>"> </a> </div>
          <div class="storefirstbl"> <a href="<?php echo $siteUrl.'/shop/'.$value['Store']['seo_url'].'/'.$value['Store']['id']; ?>">
            <p>ShopEasy</p>
            <p>Min Order -   5.00</p>
            <ul class="starcredit">
              <li><span class="staricon"></span></li>
              <li><span class="staricon"></span></li>
              <li><span class="staricon"></span></li>
              <li><span class="staricon"></span></li>
              <li><span class="staricon"></span></li>
            </ul>
            </a> 
		  </div>
		</div>
     </div>
	
	
       <?php /* <div class="col-md-3 col-sm-6 storebl mrgB20">
          <div class="storeimg"><a href="<?php echo $siteUrl.'/shop/'.$value['Store']['seo_url'].'/'.$value['Store']['id']; ?>"><img alt="<?php echo $value['Store']['store_name']; ?>" src="<?php echo $cdn.'/storelogos/'.$value['Store']['store_logo']; ?>" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/frontend/images/no_store.jpg"; ?>'"></a></div>
        </div> */ ?>
	<?php //$i++; } ?>
      <!-- </div>
     <div class="row storelist">
        <div class="col-md-9 col-sm-12 floatnone mrgauto">
        <div class="row">
          <div class="col-md-4  col-sm-6 storebl mrgB20">
            <div class="storeimg"> <a href=""><img src="images/store-img5.png"> </a> </div>
          </div>
          <div class="col-md-4  col-sm-6 storebl mrgB20">
            <div class="storeimg"> <a href=""><img src="images/store-img6.png"> </a> </div>
          </div>
          <div class="col-md-4  col-sm-6 storebl mrgB20">
            <div class="storeimg"> <a href=""><img src="images/store-img7.png"> </a> </div>
          </div>
        </div>
      </div>
      </div>
    </div>
	
	
	
	
  </div>
</div>-->

<!--<div class="container">
	<div class="searchshopContent">
	<?php /* if ($orderSuccess == 'success') {?>
		<div class="modal fade" id="thanksmsg"> 
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header menuCartHeader clearfix">
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
						</button>
							<h2> <?php echo __('Thank You'); ?></h2>
					</div>
					<div class="modal-body menuInner clearfix">
						<div class="alert alert-success">
							<h1 class="no-border no-margin no-padding"><?php 
								echo __('Your Order Placed Successfully', true); ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } */ ?> 

		<!--h1><?php //echo __('Select store to start shopping...!', true); ?></h1>
		
		<ul class="products search_stores"> <?php
			//foreach ($storeList as $key => $value) { ?>

				<li class="product col-sm-2">
				    <div class="product__inner">
				        <figure class="product__image" >
				        	<a href="<?php //echo $siteUrl.'/shop/'.$value['Store']['seo_url'].'/'.$value['Store']['id']; ?>">
				            <!-- <span class="discount_image"><span>17% OFF</span></span> -->
				            
							<!--	<img alt="<?php// echo $value['Store']['store_name']; ?>" src="<?php// echo $cdn.'/storelogos/'.$value['Store']['store_logo']; ?>" onerror="this.onerror=null;this.src='<?php//echo $siteUrl."/frontend/images/no_store.jpg"; ?>'">

				            <figcaption>
				                <div class="product-addon">
				                    <span class="yith-wcqv-button" href="<?php //echo $siteUrl.'/shop/'.$value['Store']['seo_url'].'/'.$value['Store']['id']; ?>"><span></span><i class="fa fa-check"></i></span>
				                </div>
				            </figcaption>
				          </a>
				        </figure>
				        <div class="product__detail">
				            <div class="top-section">
				                <h2 class="product__detail-title"><a href="javascript:void(0);"><?php //echo $value['Store']['store_name']; ?></a></h2>
				               	<div class="product__detail-category">
				               		<a rel="tag" href="javascript:void(0);"> <?php 

				               		/*if ($value['Store']['minimum_order'] != 0) {
				               			echo __('Min Order').' - '. $this->Number->currency($value['Store']['minimum_order'], $siteCurrency);
				               		} ?> </a> <?php

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


		<div class="page-header page-header-with-icon">
			<i class="fa fa-or"><?php echo __('Or', true); ?></i>
			<h2>
				<a class="btn btn-default btn-md bold" onclick="changeLocation();">
					<i class="fa fa-map-marker"></i> <?php echo __('Change Location', true); ?></a>
			</h2>

		</div>
		
		<h2 class="text-center">
			
		</h2>
		
	</div>
</div> --> <?php */ ?>	


