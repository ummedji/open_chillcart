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
  <div class="text-center mrgTB20">
    <h2 class="blgrtitle "><span class="blackborder">OUR</span> <span class="greenborder">Categories</span></h2>
  </div>
  
  <div class="content">
  <div class="changelocblock">
			<div class="changlocinnbl"><a class="btn addbtn changlocbtn" onclick="showLocation()">change location</a>
			<div class="changeloc-popup">
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
    <div class="row categorylist">
      <div class="col-md-2 col-sm-4">
        <section class="sky-form mrgB20">
          <div class="product_right">
            <h4 class="ribbontag"><span class="ribbon-arrow"></span><?php echo __('Categories', true); ?></h4>
            <div class="tab1 tabbing">
              <ul class="place">
			  <?php $categoryCount = 0;
			  
					foreach ($mainCategoryList as $key => $value) { 
				$categoryCount = $key+1; ?>
                <li class="sort clearfix">
				<span class="beverageicon"></span><?php echo $value['Category']['category_name']; ?><span class="glyphicon-plus pull-right" style="cursor: pointer;" onclick="showsubcat('<?php echo $value['Category']['id']; ?>');"></span>
					<ul id="subul_<?php echo $value['Category']['id']; ?>" style="display:none;" class="as_categories">
					<?php
						echo $this->Form->hidden('check' ,array('value'=>$value['Category']['id'].'_'.$storeId,
						'class'=>'remove_'.$value['Category']['id']));
						echo $this->Form->hidden('' ,array('value'=>$value['Category']['id'].'_'.$storeId,
						'id' => 'check'.$key));
								foreach ($value['ChildGroup'] as $keys => $values) {
									if (in_array($values['id'], $subCategoryList)) { ?>
									
						<li class="single-bottom"><a href="javascript:void(0);" onclick="categoriesProduct(<?php echo $values['parent_id'].','.$values['id'].','.$storeId;?>);">
												<?php echo $values['category_name'];?></a></li>
						<?php
									}

								} ?>
					</ul>
				</li>
			  <?php } ?>
              </ul>
              
            </div>
            
          </div>
        </section>
      </div>
	  <div id="filtterByCategory" class="col-md-10 col-sm-8"></div>
	  <div id="messageError" style="display:none">
		<h1><center>There is no product</center></h1>
	  </div>
	  
      <!-- <div class="col-md-10 col-sm-8">
        <div class="productdiv mrgB20">
          <div class="row title greenbut">
            <div class="pull-left">
              <h4 class="ribbontag"><span class="ribbon-arrow"></span>Beverage</h4>
            </div>
            <div class="pull-right">
              <button class="btn " type="submit">View More</button>
            </div>
          </div>
          <div class="row products padTB20">
            <div class="col-md-2 col-sm-4 productblock">
              <div class="product">
                <div class="image"> <a href="detail.html"> <img class="img-responsive image1" alt="" src="images/product1.png"> </a> <span class="prod-id">2</span> </div>
                <div class="text">
                  <h3><a href="#">Cremica Imli Chataka </a></h3>
                  <p class="prodesc">Sauces & Pickles </p>
                  <p class="price"> <span class="black-rs-icon"></span> 143.00</p>
                </div>
              </div>
            </div>
            <div class="col-md-2 col-sm-4 productblock">
              <div class="product">
                <div class="image"> <a href="detail.html"> <img class="img-responsive image1" alt="" src="images/product1.png"> </a> <span class="prod-id">2</span> </div>
                <div class="text">
                  <h3><a href="#">Cremica Imli Chataka </a></h3>
                  <p class="prodesc">Sauces & Pickles </p>
                  <p class="price"> <span class="black-rs-icon"></span> 143.00</p>
                </div>
              </div>
            </div>
            <div class="col-md-2 col-sm-4 productblock">
              <div class="product">
                <div class="image"> <a href="detail.html"> <img class="img-responsive image1" alt="" src="images/product1.png"> </a> <span class="prod-id">2</span> </div>
                <div class="text">
                  <h3><a href="#">Cremica Imli Chataka </a></h3>
                  <p class="prodesc">Sauces & Pickles </p>
                  <p class="price"> <span class="black-rs-icon"></span> 143.00</p>
                </div>
              </div>
            </div>
            <div class="col-md-2 col-sm-4 productblock">
              <div class="product">
                <div class="image"> <a href="detail.html"> <img class="img-responsive image1" alt="" src="images/product1.png"> </a> <span class="prod-id">2</span> </div>
                <div class="text">
                  <h3><a href="#">Cremica Imli Chataka </a></h3>
                  <p class="prodesc">Sauces & Pickles </p>
                  <p class="price"> <span class="black-rs-icon"></span> 143.00</p>
                </div>
              </div>
            </div>
            <div class="col-md-2 col-sm-4 productblock">
              <div class="product">
                <div class="image"> <a href="detail.html"> <img class="img-responsive image1" alt="" src="images/product1.png"> </a> <span class="prod-id">2</span> </div>
                <div class="text">
                  <h3><a href="#">Cremica Imli Chataka </a></h3>
                  <p class="prodesc">Sauces & Pickles </p>
                  <p class="price"> <span class="black-rs-icon"></span> 143.00</p>
                </div>
              </div>
            </div>
            <div class="col-md-2 col-sm-4 productblock">
              <div class="product">
                <div class="image"> <a href="detail.html"> <img class="img-responsive image1" alt="" src="images/product1.png"> </a> <span class="prod-id">2</span> </div>
                <div class="text">
                  <h3><a href="#">Cremica Imli Chataka </a></h3>
                  <p class="prodesc">Sauces & Pickles </p>
                  <p class="price"> <span class="black-rs-icon"></span> 143.00</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    
      </div> -->
    </div>
  </div>
</div>

<!--<div class="mobile_cart">
	<div class="">
		<span class="pull-left">
			<div class="mobile_cart_price" href="javascript:void(0);" >
				
				<?php //echo $siteCurrency; ?><span class="cartTotal">0</span>

				<div class="cart_notification" style="display:none;">
					<?php //echo __('1 Item added to cart successfully.', true); ?>
				</div>
				<div class="cart_failedNotification" style="display:none;">
					<?php //echo __('Quantity Exceeded..!', true); ?>
				</div>
			</div>
		</span>
		<span class="pull-right viewCart_mobile">
			<a class="checkout_arrow view relative" href="javascript:void(0);" ><i class="fa fa-shopping-cart white"></i><span class="price_count" id="cartCount">0</span></a>			
		</span>
	</div>	
</div> -->


<!-- <div class="menuWrapper">
			
	<div class="category_mobile"> -->
		<?php /* <div class="leftsideBar">
			<div class="leftsideBar_scroller">
				<a class="close_category" href="javascript:void(0);">X</a>
				<h1> <?php echo __('List'); ?> </h1>
				<ul>
					<li><a href="javascript:void(0);" onclick="offerDetails(<?php echo $storeId; ?>);"><span>&rarr;</span>
						<?php echo __('Offer', true); ?> </a>
					</li> <?php
					if (!empty($dealProduct)) { ?>
						<li><a href="javascript:void(0);" onclick="dealsProduct(<?php echo $storeId;?>);"><span>&rarr;</span>
							<?php echo __('Deals', true); ?> </a>
						</li> <?php 
					} ?>
				</ul>
				<h1> <?php echo __('Categories', true); ?></h1>
				<ul class="maincategory"> <?php
					$categoryCount = 0;
					foreach ($mainCategoryList as $key => $value) { 
						$categoryCount = $key+1; ?>
						<li>
							<a href="javascript:void(0);" class="mainMenu"><?php
								echo $value['Category']['category_name']; ?></a><?php
							echo $this->Form->hidden('check' ,array('value'=>$value['Category']['id'].'_'.$storeId,
								'class'=>'remove_'.$value['Category']['id']));

							echo $this->Form->hidden('' ,array('value'=>$value['Category']['id'].'_'.$storeId,
																'id' => 'check'.$key));
								?>
							<ul class="subcategories">
								<li>
									<a href="javascript:void(0);" onclick="categoriesProduct(<?php echo $value['Category']['id'].',0,'.$storeId;?>);"> <span>&rarr;</span> All <?php
									echo $value['Category']['category_name']; ?> </a> <?php
								foreach ($value['ChildGroup'] as $keys => $values) {
									if (in_array($values['id'], $subCategoryList)) { ?>
										<li>
											<a href="javascript:void(0);" onclick="categoriesProduct(<?php echo $values['parent_id'].','.$values['id'].','.$storeId;?>);">
											<span>&rarr;</span>
												<?php echo $values['category_name'];?></a></li> <?php
									}

								} ?>
							</ul>
						</li> <?php
					}
					echo $this->Form->hidden('', array('value'=> $categoryCount,
														'id' => 'countCategory')); ?>
				</ul>
			</div>
		</div> */ ?>
	<!--</div>
	
	<div class="rightSideBar">
		
		<div id="messageError" style="display:none">
			<h1><center>There is no product</center></h1>
		</div>
		<div id="cart-sidebar">
			<a class="mobile_cart_close" href="javascript:void(0);"><i class="fa fa-chevron-left"></i></a>
			<div class="cart-sidebar-overlay"></div>
			<header>
				<div class="btn-cart-toggle">
					<span class="fa fa-angle-double-left"></span>
				</div>
			</header>
			<section>
				<div class="cart-wrapper" id="cartdetailswrapper">
					
				</div>
			</section>
		</div>
		<div class="modal fade" id="addCartPop"> </div>
	</div>
</div>-->
<?php echo $this->element('frontend/footer'); ?>