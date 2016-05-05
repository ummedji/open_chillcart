<footer>
  <div class="quicklinks">
    <div class="container">
      <div class="clearfix linksinnerblock">
        <div class="col-lg-4 col-sm-5 col-md-4 col-xs-6 cccontactdet">
          <div class="text-center"><img src="<?php echo $siteUrl.'/frontend/images/logo-white.png';?>"/></div>
          <form>
            <div class="form-group">
              <label class="sr-only">Address</label>
              <input type="text" placeholder="ABC Town Luten Street" class="contact addressicon" disabled>
            </div>
            <div class="form-group">
              <label class="sr-only">Contact No.</label>
              <input type="text" placeholder="+ 9725908113" class="contact phone-icon" disabled>
            </div>
            <div class="form-group">
              <label class="sr-only">Email</label>
              <input type="text" placeholder="support@chillcart.com" class="contact emailicon" disabled>
            </div>
          </form>
          <ul class="social-network">
            <li><a title="" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a title="" href=""><i class="fa fa-twitter"></i></a></li>
            <li><a title="" href=""><i class="fa fa-linkedin"></i></a></li>
            <li><a title="" href=""><i class="fa fa-youtube"></i></a></li>
          </ul>
        </div>
        <div class="col-lg-8 col-sm-7 col-md-8 col-xs-12 mrgTB20 wrapmrgB">
          <div class="clearfix">
            <div class="col-lg-offset-1 col-md-offset-1">
              <div class="col-lg-4 col-md-4 col-sm-4  col-xs-4 wrapmrgB">
                <h3>Quick Links</h3>
                <ul>
                  <li><a href="">Blog</a></li>
                  <li><a href="">FAQs</a></li>
                  <li><a href="">Payment</a></li>
                  <li><a href="">Shipment</a></li>
                  <li><a href="">Where is my order?</a></li>
                  <li><a href=""> Return Policy</a></li>
                </ul>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4  col-xs-4 wrapmrgB">
                <h3>Style Advisor</h3>
                <ul>
                  <li><a href="">Your Account</a></li>
                  <li><a href="">Information</a></li>
                  <li><a href="">Addresses</a></li>
                  <li><a href="">Discount</a></li>
                  <li><a href="">Orders History</a></li>
                  <li><a href=""> Additional Information</a></li>
                </ul>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4  col-xs-4 wrapmrgB">
                <h3>Information</h3>
                <ul>
                  <li><a href="">Site Map</a></li>
                  <li><a href="">Search Terms </a></li>
                  <li><a href="">Advanced Search</a></li>
                  <li><a href="">About Us</a></li>
                  <li><a href="">Contact Us</a></li>
                  <li><a href="">Suppliers</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="site-footer">
    <div class="container">
      <div class="clearfix">
        <div class="col-lg-12 text-center">
          <p> &copy; 2016 Flavours. All Rights Reserved. </p>
        </div>
      </div>
    </div>
  </div>
</footer>


<!--login-->
<div class="modal fade login_popup" id="demo-1" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo $siteUrl.'/frontend/images/login_icon.png'; ?>" class="img-responsive" alt="">
        <div class="clearfix"></div>
        <h3><span class="white_tl">Welcome</span><span class="green_tl">back!</span></h3>
      </div>
        
       <?php //echo $this->Form->create('User', array('class' => 'login-form')); ?>
        
       <?php
                    echo $this->Form->create('User', array('class' => 'login-form','url'=>'/customerlogin','id'=>'UserLoginForm'));
               ?>
        
        
      <div class="modal-body">
        <div class="col-md-12 log_fields">
          <div class="form-group">
            <div class="input-group">
             <!-- <input type="email" class="form-control" placeholder="Email Address" value="" /> -->
                
                <?php
			echo $this->Form->input('username',
					array('label' => false,						 
                                            'placeholder' => __('Email Address'),
					    'class'=>'form-control',
					    'autocomplete' => 'off',
                                            'div' => false)); ?>
                
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <!--<input type="password" class="form-control" placeholder="Password" value="" /> -->
                
                <?php
			echo $this->Form->input('password',
					array('label' => false,
					'placeholder' => __('Password'),
					'class'=>'form-control',
					'autocomplete' => 'off',
					'div' => false)); ?>
                
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="submit" class="form-control" value="Login" /> 
              
              <?php //echo $this->Form->submit(__('Login'));?>
              
            </div>
            <div class="clearfix"></div>
          </div>
        </div>

          <?php echo $this->Form->end(); ?>
          
        <div class="col-md-12 text-center reme_sp">
          <div class="squaredFour">
         <!--   <input type="checkbox" value="None" id="squaredFour" name="check" /> -->
              
              <?php
				        			//	echo $this->Form->input("rememberMe",
				        				//			array("type"=>"checkbox",
				        				//					'label'=>false,
				        				//					'div' =>false));
				        				// echo __('Remember me', true); ?>
              
              <input id="remember_me" name="data[User][rememberMe]" class="styled" type="checkbox" />
              
            <label for="squaredFour"></label>
            <span class="check_text">Remember Me</span>
          </div>
        </div>

        <div class="col-md-12 text-center or_section">
          <div class="left_line"></div>
          <div class="center_tl">or</div>
          <div class="right_line"></div>
          <div class="clearfix"></div>
        </div>

        <div class="col-md-12 social_section">
          <div class="row">
            <div class="col-md-6 col-sm-6 resp_space">
              <a href="#">
                <div class="facebook_sp"><i></i> <span>Connect with Facebook</span> <div class="clearfix"></div></div>
              </a>
            </div>
            <div class="col-md-6 col-sm-6 resp_space">
              <a href="#"><div class="google_plus_sp"><i></i> <span>Connect with Facebook</span> <div class="clearfix"></div></div></a>
            </div>
          </div>
        </div>

        <div class="col-md-12 login_bottom">
          <div class="row">
            <div class="col-md-6 col-sm-6 text-center resp_space">Don't have an account? <a href="#" data-toggle="modal" data-target="#demo-2" data-dismiss="modal">Sign up</a></div>
            <div class="col-md-6 col-sm-6 text-center resp_space">Forgot your password? <a href="#" data-toggle="modal" data-target="#demo-4" data-dismiss="modal">Reset it</a></div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<!--login-->


<!--sign up-->
<div class="modal fade login_popup" id="demo-2" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content" style="border: solid 3px #2f475f;">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo $siteUrl.'/frontend/images/signup_icon.png'; ?>" class="img-responsive" alt="">
        <div class="clearfix"></div>
        <h3><span class="white_tl">Create</span><span class="green_tl">Account</span></h3>
      </div>
        
         <?php echo $this->Form->create('User', array('class' => 'login-form','url'=>'/signup','id'=>'UserSignupForm')); ?>
        
      <div class="modal-body">
        <div class="col-md-12 log_fields">
          <div class="form-group">
            <div class="input-group">
            <!--  <input type="text" class="form-control first_name_i" placeholder="First Name" value="" /> -->
                
                <?php
                            echo $this->Form->input('Customer.first_name',array('class'=>'form-control first_name_i', 'autocomplete' => 'off','label' => false,'div' => false,'placeholder'=>"First Name")); 
                        ?> 
                
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
            <div class="input-group">
            <!--  <input type="text" class="form-control last_name_i" placeholder="Last Name" value="" />-->
                
                <?php
                            echo $this->Form->input('Customer.last_name',array('class'=>'form-control last_name_i', 'autocomplete' => 'off','label' => false,'div' => false,'placeholder'=>"Last Name")); 
                        ?> 
                
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
            <div class="input-group">
          <!--    <input type="email" class="form-control email_i" placeholder="Email" value="" /> -->
                
                <?php
                            echo $this->Form->input('Customer.customer_email',array('class'=>'form-control email_i', 'autocomplete' => 'off','label' => false,'div' => false,'placeholder'=>"Email")); 
                        ?> 
                
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
            <div class="input-group">
             <!-- <input type="password" class="form-control password_i" placeholder="Password" value="" /> -->
                
                <?php
                            echo $this->Form->input('User.password',array('id'=>'UserPassword_2', 'class'=>'validate form-control password_i', 'autocomplete' => 'off','label' => false,'div' => false,'placeholder'=>"Password",'name'=>'data[User][UserPassword_2]')); 
                        ?> 
                
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
            <div class="input-group">
           <!--   <input type="password" class="form-control password_i" placeholder="Confirm Password" value="" /> -->
                
                 <?php
                            echo $this->Form->input('password',array( "equalto"=>"#UserPassword_2", 'class'=>'validate form-control password_i', 'autocomplete' => 'off','label' => false,'div' => false,'placeholder'=>"Confirm Password","name"=>"data[User][confir_password]","id"=>'UserConfirPassword')); 
                        ?> 
                
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
            <div class="input-group">
           <!--   <input type="text" class="form-control phone_number_i" placeholder="Phone Number" value="" /> -->
                
                <?php
                            echo $this->Form->input('Customer.customer_phone',array('class'=>'form-control phone_number_i', 'autocomplete' => 'off','label' => false,'div' => false,'placeholder'=>"Phone Number")); 
                        ?> 
                
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
            <div class="input-group">
           <!--   <input type="submit" class="form-control" value="Let's go to shop"/> -->
                
                 <a  style="display:'none';" id="modal_submitdata" class="close" data-dismiss="modal" aria-label="Close"></a>
                 
                 
                 
                     <?php 
                        echo $this->Form->submit(__("Let's go to shop"), array('class' => 'form-control btn registre_btn hvr-rectangle-out','id'=>'signupform')); 
                     ?>
                
                    <?php
                       echo $this->Form->end(); 
                    ?>
                
            </div>
            <div class="clearfix"></div>
          </div>
        </div>

        <div class="col-md-12 text-center watch_sp">
          <button type="button" class="btn btn-primary">Watch our video here</button>
        </div>

        <div class="col-md-12 login_bottom">
          <div class="row">
            <div class="col-md-12 text-center resp_space">Already have an account? <a href="#" data-toggle="modal" data-target="#demo-1" data-dismiss="modal">Log in</a></div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<!--sign up-->

<!--watchvideo-->
<div class="modal fade login_popup" id="demo-3" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
<iframe width="100%" height="315" src="https://www.youtube.com/embed/yAoLSRbwxL8" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>
<!--watchvideo-->

<!--forgot pass-->
<div class="modal fade login_popup" id="demo-4" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo $siteUrl.'/frontend/images/login_icon.png'; ?>" class="img-responsive" alt="">
        <div class="clearfix"></div>
        <h3><span class="white_tl">Forgot</span><span class="green_tl">Password</span></h3>
      </div>

       <?php //echo $this->Form->create('User', array('class' => 'login-form')); ?>

       <?php
                    echo $this->Form->create('User', array('class' => 'login-form','url'=>'/customerlogin','id'=>'UserLoginForm'));
               ?>


      <div class="modal-body">
        <div class="col-md-12 log_fields">
          <div class="form-group">
            <div class="input-group">
             <!-- <input type="email" class="form-control" placeholder="Email Address" value="" /> -->

                <?php
			echo $this->Form->input('username',
					array('label' => false,
                                            'placeholder' => __('Enter Email ID'),
					    'class'=>'form-control',
					    'autocomplete' => 'off',
                                            'div' => false)); ?>

            </div>
            <div class="clearfix"></div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <input type="submit" class="form-control" value="Send Password" />

              <?php //echo $this->Form->submit(__('Login'));?>

            </div>
            <div class="clearfix"></div>
          </div>
        </div>

          <?php echo $this->Form->end(); ?>







        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<!--forgot pass-->
