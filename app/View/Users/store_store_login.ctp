<div class="content"> <?php
	echo $this->Form->create('User', array('class' => 'login-form')); ?>
		<h3 class="form-title">Login to your account</h3>
		<div class="alert alert-danger display-hide">
		
			<span>
			Enter any username and password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i> <?php
					echo $this->Form->input('username',
										array('label' => false,
											  'placeholder' => 'Username',
											  'class'=>'form-control placeholder-no-fix',
											  'autocomplete' => 'off',
											  'div' => false)); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i> <?php
					echo $this->Form->input('password',
										array('label' => false,
											  'placeholder' => 'Password',
											  'class'=>'form-control placeholder-no-fix',
											  'autocomplete' => 'off',
											  'div' => false)); ?> 
			</div>
		</div>
		<div class="form-actions">
			<label class='checkbox'> <?php
				echo $this->Form->input("rememberMe",
							array("type"=>"checkbox",
									'label'=>false,
									'div' =>false));
				 echo __('Remember me', true); ?> </label> <?php
	    	echo $this->Form->submit('Login',
	    				 array('class' => 'btn green-haze pull-right',
	    				 		'div'=>false)); ?>
			</button>
		</div>
		<div class="forget-password">
			<h4>Forgot your password ?</h4>
			<p>
				 no worries, click <a href="javascript:;" id="forget-password">
				here </a>
				to reset your password.
			</p>
		</div> <?php
		echo $this->Form->end(); ?>

		<?php
		echo $this->Form->create('Users', array('class' => 'forget-form','id'=>'forgetmail')); ?>
			<h3>Forget Password ?</h3>
			<p>
				 Enter your e-mail address below to reset your password.
			</p>
			<div class="form-group">
				<div class="input-icon">
					<i class="fa fa-envelope"></i> <?php

					echo $this->Form->input('email',
										array('label' => false,
											'placeholder' => 'Email',
											'class'=>'form-control placeholder-no-fix',
											'autocomplete' => 'off',
											'div' => false)); ?> 


				</div>
			</div>
			<div class="form-actions">
				<button type="button" id="back-btn" class="btn">
				<i class="m-icon-swapleft"></i> Back </button>
				<?php echo $this->Form->submit('Submit', array('class' => 'btn green-haze pull-right', 'div' => false));?>
			</div> <?php
		echo $this->Form->end(); ?>
</div>