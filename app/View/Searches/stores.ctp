<script src="<?php echo $this->webroot; ?>frontend/js/jquery.stellar.min.js" type="text/javascript"></script>

<style>
    
    .modal-header {
    
    background-color: #2088b2;
	}
	
	.h2, h2 {
    font-size: 30px;
}

.modal-header .close {
    color: #000;
    margin-top: 2px;
    opacity: 1 !important;
    text-shadow: none !important;
}

.close {
    font-size: 40px;
    position: absolute;
    right: 10px;
    top: 0;
    z-index: 1;
}
.close {
    color: #000;
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    opacity: 0.2;
    text-shadow: 0 1px 0 #fff;
}

.modal-body {
    padding-bottom: 15px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 15px;
    position: relative;
}



.searchshopContent h1 {
    -x-system-font: none;
    border-bottom-color: #dddddd;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    font-family: Lato;
    font-feature-settings: normal;
    font-kerning: auto;
    font-language-override: normal;
    font-size: 34px;
    font-size-adjust: none;
    font-stretch: normal;
    font-style: normal;
    font-synthesis: weight style;
    font-variant-alternates: normal;
    font-variant-caps: normal;
    font-variant-east-asian: normal;
    font-variant-ligatures: normal;
    font-variant-numeric: normal;
    font-variant-position: normal;
    font-weight: 300;
    line-height: normal;
    margin-bottom: 30px;
    margin-left: 0;
    margin-right: 0;
    margin-top: 0;
    padding-bottom: 20px;
    text-align: center;
}
.no-padding {
    padding-bottom: 0 !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    padding-top: 0 !important;
}
.no-margin {
    margin-bottom: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    margin-top: 0 !important;
}
.no-border {
    -moz-border-bottom-colors: none !important;
    -moz-border-left-colors: none !important;
    -moz-border-right-colors: none !important;
    -moz-border-top-colors: none !important;
    border-bottom-color: -moz-use-text-color !important;
    border-bottom-style: none !important;
    border-bottom-width: medium !important;
    border-image-outset: 0 0 0 0 !important;
    border-image-repeat: stretch stretch !important;
    border-image-slice: 100% 100% 100% 100% !important;
    border-image-source: none !important;
    border-image-width: 1 1 1 1 !important;
    border-left-color: -moz-use-text-color !important;
    border-left-style: none !important;
    border-left-width: medium !important;
    border-right-color: -moz-use-text-color !important;
    border-right-style: none !important;
    border-right-width: medium !important;
    border-top-color: -moz-use-text-color !important;
    border-top-style: none !important;
    border-top-width: medium !important;
}

.alert-success {
    background-color: #dff0d8;
    border-bottom-color: #d6e9c6;
    border-left-color: #d6e9c6;
    border-right-color: #d6e9c6;
    border-top-color: #d6e9c6;
    color: #3c763d;
}
.alert {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-bottom-color: transparent;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    border-image-outset: 0 0 0 0;
    border-image-repeat: stretch stretch;
    border-image-slice: 100% 100% 100% 100%;
    border-image-source: none;
    border-image-width: 1 1 1 1;
    border-left-color: transparent;
    border-left-style: solid;
    border-left-width: 1px;
    border-right-color: transparent;
    border-right-style: solid;
    border-right-width: 1px;
    border-top-color: transparent;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-top-style: solid;
    border-top-width: 1px;
    margin-bottom: 20px;
    padding-bottom: 15px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 15px;
}
.modal-body {
    padding-bottom: 15px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 15px;
    position: relative;
}
    
</style>

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
      
      
      <?php if ($orderSuccess == 'success') {?>
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
	<?php } ?> 
      
      
    <div class="text-center mrgTB20">
      <h2 class="blgrtitle "><span class="blackborder">OUR</span> <span class="greenborder"><?php echo __('Gorcery store', true); ?></span></h2>
    </div>
	
	
    <div class="content">
			<div class="changelocblock">
			<div class="changlocinnbl"><a class="btn addbtn changlocbtn" onclick="showLocation()">change location</a>
			<div class="changeloc-popup">
			<!--<div class="close_pop_btn"><a href="#"><i aria-hidden="true" class="fa fa-times-circle"></i></a></div>-->
			<h2>change location</h2>
			<div class="locfield pad20">
			<div class="form-group">
			<label class="sr-only">City</label>
			<?php
			
			if (!empty($cityList)){
				echo $this->Form->create('Search',array("id"=>'ChangeLocationToNew')) ;
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
									array("label"=>false,
											"class"=>"btn btn-green btn-success addbtn",
											'onclick' => 'return removeOldLocation();',
											"type"=>'button')); 
				echo $this->Form->end();					
				/*echo $this->Form->button(__("Let's go to shop"),
                              array('onclick' => 'return removeOldLocation();','class'=>'btn btn-green btn-success addbtn'));*/
			?>
			<!-- <select class="form-control">
			<option selected="">Select City</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
			</select> -->
			</div>
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
				<div class="flipper"><div class="storeimg"> <a href="<?php echo $siteUrl.'/shop/'.$value['Store']['seo_url'].'/'.$value['Store']['id']; ?>"><img src="<?php echo $cdn.'/storelogos/'.$value['Store']['store_logo']; ?>"></a></div>
				<div class="storefirstbl"> <a href="<?php echo $siteUrl.'/shop/'.$value['Store']['seo_url'].'/'.$value['Store']['id']; ?>">
				<p>ShopEasy</p>
				<p>
				<?php
				if($value['Store']['minimum_order'] != 0) {
					echo __('Min Order').' - '. $this->Number->currency($value['Store']['minimum_order'], $siteCurrency);
				} 
				?>
				</p>
				<ul class="starcredit">
				<?php for($star=1;$star<=$value['Store']['minimum_order'];$star++) { ?>
				<li><span class="staricon"></span></li>
				<?php } ?>
				
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



