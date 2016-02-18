
<div class="container loginBg">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="col-md-10 col-md-offset-1" >
				<div id="login" class="loginInnerBg clearfix">
					<h4> <?php echo __('Login', true); ?></h4><?php
					echo $this->Form->create('User', array('class' => 'login-form')); ?>
						<div class="form-group">
							<label class="control-label"> <?php echo __('Email', true); ?></label> <?php
							echo $this->Form->input('username',
												array('label' => false,
													  'placeholder' => __('Email'),
													  'class'=>'form-control placeholder-no-fix',
													  'autocomplete' => 'off',
													  'div' => false)); ?>
						</div>
						<div class="form-group">
							<label class="control-label"> <?php echo __('Password', true); ?></label><?php
							echo $this->Form->input('password',
												array('label' => false,
													  'placeholder' => __('Password'),
													  'class'=>'form-control placeholder-no-fix',
													  'autocomplete' => 'off',
													  'div' => false)); ?>
						</div>
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="rememberpassword padding-l-15-xs">
									<label class='checkbox'> <?php
				        				echo $this->Form->input("rememberMe",
				        							array("type"=>"checkbox",
				        									'label'=>false,
				        									'div' =>false));
				        				 echo __('Remember me', true); ?> </label>
								</div>
							</div>
							<div class="col-md-6" id="forget">
								<div class="rememberpassword margin-t-10 text-right text-left-xs">
									<a id="forgetPage" class="linkRight" href="javascript:void(0);"><?php echo __('Forget Password'); ?> ?</a>
								</div>
							</div>
						</div>

						<div class="signup-footer margin-t-15-xs">
							<div class="col-md-6">
								<?php echo $this->Form->submit(__('Login'));?>

							</div>
							<div class="col-md-6">
								<div class="margin-t-5 text-right">
									<a class="linkRight" href="<?php echo $siteUrl.'/signup'; ?>"> <?php echo __('Create New Account', true); ?> ?</a>
								</div>
							</div>
						</div> <?php
					echo $this->Form->end(); ?>

				</div>

				<div class="loginInnerBg clearfix" id="forgetsmail" style="display:none">
					<h4> <?php echo __('Forget Mail'); ?> </h4><?php
					echo $this->Form->create('Users', array('class' => 'login-form','id'=>'forgetmail')); ?>
						<div class="form-group">
							<label class="control-label"> <?php echo __('Email', true); ?></label> <?php
							echo $this->Form->input('email',
												array('label' => false,
													'placeholder' => __('Email'),
													'class'=>'form-control placeholder-no-fix',
													'autocomplete' => 'off',
													'div' => false)); ?>
						</div>


						<div class="signup-footer">
							<div class="col-md-6">
								<?php echo $this->Form->submit(__('Submit'));?>

							</div>
							<div class="col-md-6">
								<div class="margin-t-5 text-right">
									<a  id="loginPage" class="linkRight" href="javascript:void(0);">  <?php echo __('Login', true); ?> </a>
								</div>
							</div>
						</div> <?php

					echo $this->Form->end(); ?>
				</div>

			</div>
			<!-- <div class="socialOr"><span>Or</span></div> -->
		</div>
		<div class="col-md-3">
			<div class="social-logins">
				<a class="facebook" href="<?php echo $siteUrl.'/users/social_login/Facebook'; ?>">
					<img alt="facebook" title="facebook" src="<?php echo $siteUrl.'/frontend/images/facebook.png'; ?>">
					<i>Login with Facebook</i>
					<div class="clr"></div>
				</a>
				<!--<a class="twitter" href="javascript:voic(0);">
					<img alt="twitter" title="twitter" src="<?php echo $siteUrl.'/frontend/images/twitter.png'; ?>">
					<i>Login with Twitter</i>
					<div class="clr"></div>
				</a>-->
				<!-- <a class="googleplus" href="<?php echo $siteUrl.'/users/social_login/Google'; ?>">
					<img alt="gplus" title="gplus" src="<?php echo $siteUrl.'/frontend/images/gplus.png'; ?>">
					<i>Login with Google+</i>
					<div class="clr"></div>
				</a> -->
			</div>
		</div>
	</div>
</div>