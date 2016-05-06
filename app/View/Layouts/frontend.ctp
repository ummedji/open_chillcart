<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
			if (top !=self) {
			   top.location=self.location;
			}
		</script>
		<title><?php 
		echo (!empty($metaTitle)) ? $metaTitle : $title_for_layout; ?> </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="description" content="<?php echo $metaDescriptions; ?>" />
		<meta name="keywords" content="<?php echo $metakeywords; ?>" /> <?php
		echo $this->Html->meta('icon', $this->Html->url($siteUrl.'/siteicons/fav.ico')); ?>

		<!--<link rel="stylesheet" href="<?php echo $this->webroot; ?>frontend/css/bootstrap.min.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo $this->webroot; ?>frontend/css/font-awesome.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo $this->webroot; ?>frontend/css/bootstrap-select.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo $this->webroot; ?>frontend/css/jquery.mCustomScrollbar.css" type="text/css" media="all">

		<link rel="stylesheet" href="<?php echo $this->webroot; ?>frontend/css/common.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo $this->webroot; ?>frontend/css/jquery.dataTables.min.css" type="text/css" media="all">

		<link rel="stylesheet" href="<?php echo $this->webroot; ?>frontend/css/owl.carousel.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo $this->webroot; ?>frontend/css/owl.theme.css" type="text/css" media="all">

		<link rel="stylesheet" href="<?php echo $this->webroot; ?>frontend/css/products.css" type="text/css" media="all">
		
		<link rel="stylesheet" href="<?php echo $this->webroot; ?>frontend/css/common_new.css" type="text/css" media="all">

		<link rel="stylesheet" href="<?php echo $this->webroot; ?>frontend/css/mobile.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo $this->webroot; ?>frontend/css/mobile_1.css" type="text/css" media="all">		

		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,400italic" rel="stylesheet" type="text/css"> -->
		
		 <?php
//print_r($this->request->params);
//if($this->request->params['action'] == 'customer_myaccount') { echo "a";  exit;}
		 //echo "<pre>"; print_r($loggedUser);

	if(($this->request->params['controller'] == "checkouts" && $this->request->params['action'] == 'index') || ($this->request->params['controller'] == "customers" && $this->request->params['action'] == 'customer_myaccount') || ($this->request->params['controller'] == "searches" && ($this->request->params['action'] == 'index' || $this->request->params['action'] == 'stores' || $this->request->params['action'] == 'storeitems' || $this->request->params['action'] == 'aboutus'))) {  ?>

		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/bootstrap.min.css">
		
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->webroot; ?>frontend/css/style.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->webroot; ?>frontend/css/responsive.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->webroot; ?>frontend/css/font-awesome.css" />
		<link href="<?php echo $this->webroot; ?>frontend/css/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
		<link href="<?php echo $this->webroot; ?>frontend/css/SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css">
		<?php /* ?><link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->webroot; ?>frontend/css/style.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->webroot; ?>frontend/css/responsive.css" /><?php*/
	  } ?>

	</head>
	<body onload="$('#thanksmsg').modal('show');" class="home">
	<?php echo $this->element('frontend/topheader'); ?>
	<?php echo $this->Session->flash(); ?>
	<!--<div class="middle_height">-->
	<?php echo $this->fetch('content'); ?>
	<!--</div>
	<!-- Page refresh loading image -->
    <div class="ui-loader">
        <div class="spinner">
        	<div class="spinner-icon"></div>
        </div>
    </div>
	<script type="text/javascript" src="https://js.stripe.com/v2/"> </script>
	
	<!--<script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/jquery-1.11.3.js"></script>-->

	<script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/jquery-1.11.0.min.js"></script>	

	<script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/jquery-migrate-1.2.1.min.js"></script>


	<script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/bootstrap-select.js"></script>

	<script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/jquery.bootstrap-touchspin.js"></script>
	<script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/common.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/customer.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/jquery.mCustomScrollbar.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/scrolling-nav.js"></script>

    <script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/owl.carousel.min.js"></script>
	<script src="<?php echo $this->webroot; ?>frontend/js/jquery.stellar.min.js" type="text/javascript"></script>
	<script src="<?php echo $this->webroot; ?>frontend/css/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
	<script src="<?php echo $this->webroot; ?>frontend/css/SpryAssets/SpryAccordion.js" type="text/javascript"></script>


    <script type="text/javascript" src="<?php echo $this->webroot; ?>frontend/js/prefixfree.min.js"></script>

    <script type="text/javascript">
	
    	var loggedUser = "<?php echo (isset($loggedUser['role_id'])) ? $loggedUser['role_id'] : ''; ?>";
    	
    	if (loggedUser == 4) {
    		sessionCheck();
    	}


		var rp = "<?php echo $siteUrl.'/'; ?>";
		var publishKey = "<?php echo $publishKey; ?>";

		function showsubcat(id)
		{
			if($("#subul_"+id).css('display') == 'none')
			{
			$("#subul_"+id).show();
			}
			else
			{
			$("#subul_"+id).hide();
			}
		}
		function sessionCheck() {

			idleTimer = null;
			idleState = false;
			idleWait = 1800000;
			$('*').bind('click mousemove keydown scroll', function () {
				clearTimeout(idleTimer);
				if (idleState == true) { 
					//$("#logid").val("Not in Idle");						
				}
				idleState = false;
				idleTimer = setTimeout(function () { 
					window.location.href = rp+'customer/users/userLogout';
					idleState = true; }, idleWait);
			});
			$("body").trigger("mousemove");
		}
		

		$(window).load(function() {
			$('.ui-loader').hide();
		});

		$(document).ready(function(){			
			
           	$(window).trigger('resize');
		   	doResize();
		   	$(window).on('resize', doResize);		   
		   //	clearConsole();
            
        });
        function ajaxpromotionalSignup()
		{
			var email = $('#email').val();
			//var selectedValue = $(this).val();
			alert(email);	
			var targeturl = 'searches/ajaxpromotionalSignup';
			$.ajax({
			type: 'get',
			url: targeturl,
			data: 'email=' + email,
			accepts: {json: 'application/json'},
			success: function(response) {
			var obj = jQuery.parseJSON( response );
			var status = obj.status;
			$('#restext').html(obj.msg);
			}			
			});
		}
		function doResize()
		{
			var navbar_height = $(".navbar").height();
				
			//middle minimum height
			var footer_height = $("footer").height();			
			var win_height = $(window).height();
						
			var middle_height = win_height - ( navbar_height + footer_height ) + 30 ;/* -25 for footer paddings*/
			$(".middle_height").css({"min-height":middle_height});

			$("#cart-sidebar").css("top", $(".header").height());

			if( $(window).width() > 767 ) {
				$(".leftsideBar").css({ "padding-top": navbar_height + 30 }); 

				var leftsideBarHei = $(window).height() - ( $(".header").outerHeight() );
				$(".leftsideBar_scroller").css("height",leftsideBarHei);
			} else { 
				$(".leftsideBar").css({ "padding-top": 0 });
				
				var leftsideBarHei = $(window).height() - ( 65 );
				$(".leftsideBar_scroller").css("height",leftsideBarHei);
			}

			$(".rightSideBar").css({ "margin-top": navbar_height });
		}

		function showLocation()
		{
			if(jQuery(".changeloc-popup").css('display') == 'none')
			{
			jQuery(".changeloc-popup").show();
			}
			else
			{
			jQuery(".changeloc-popup").hide();
			}
		}
		jQuery().ready(function() {
			
        /*var signupvalidator = jQuery("#UserSignupForm").validate({
				rules: {
				   "data[Customer][first_name]": {
						required: true,
					},
					"data[Customer][last_name]": {
						required: true,
					},
		            "data[Customer][customer_email]": {
						required: true,
		                email:true,
					},
		            "data[User][password]": {
						required: true,
		                
					},
		            "data[User][confir_password]": {
						required: true,
						equalTo: '#UserPassword'
		                
					},
		            "data[Customer][customer_phone]": {
						required: true,
						number : true
					}
				},
				messages: { 
				  "data[Customer][first_name]": {
						required: "<?php echo __('Please enter firstname'); ?>",
					},
					"data[Customer][last_name]": {
					required: "<?php echo __('Please enter lastname'); ?>",
					},
		            "data[Customer][customer_email]": {
						required: "<?php echo __('Please enter email'); ?>",
						email : "<?php echo __('Please enter a valid email address'); ?>",
					},
		            "data[User][password]": {
					 	required: "<?php echo __('Please enter password'); ?>",
		                
					},
		            "data[User][confir_password]": {
						required: "<?php echo __('Please enter confirm password'); ?>",
						equalTo: "<?php echo __('Please enter the same value again'); ?>",		                
					},
		            "data[Customer][customer_phone]": {
						required: "<?php echo __('Please enter phone number'); ?>",
						number : "<?php echo __('Please enter valid phone number'); ?>",

					}

				}
			});

*/
			
		    
		    var loginvalidator = jQuery("#UserCustomerCustomerloginForm").validate({
				rules: {
					"data[User][username]": {
						required: true,
						email :true,
					},
		            "data[User][password]": {
						required: true,
					}
				},
				messages: { 
					"data[User][username]": {
						required: "<?php echo __('Please enter email'); ?>",
						email : "<?php echo __('Please enter a valid email address'); ?>",
					},
		            "data[User][password]": {
						required: "<?php echo __('Please enter password'); ?>",
					}
				}
			});
			
			var changepasswordvalidator = jQuery("#CustomerChangePasswordForm").validate({
				rules: {
					"data[User][oldpassword]": {
						required: true,
					},
					"data[User][newpassword]": {
						required: true,
					},
					"data[User][confirmpassword]":{
						required: true,
						equalTo: '#UserNewpassword'
					},

				},
				messages: {
					"data[User][oldpassword]": {
						required: "<?php echo __('Please enter old password'); ?>",
					},
					"data[User][newpassword]": {
						required: "<?php echo __('Please enter new password'); ?>",
					},
					"data[User][confirmpassword]":{
						required: "<?php echo __('Please enter confirm password'); ?>",
						equalTo: "<?php echo __('Please enter the same value again'); ?>",
					}

				}
			});

			var loginForgetmailvalidator = jQuery("#forgetmail").validate({
				rules: {
					"data[Users][email]": {
						required: true,
						email :true,
					}
				},
				messages: {
					"data[Users][email]": {
						required: "<?php echo __('Please enter email'); ?>",
						email : "<?php echo __('Please enter a valid email address'); ?>",
					}

				}
			});

			var Profilevalidator = jQuery("#CustomerCustomerMyaccountForm").validate({
				rules: {
					"data[Customer][first_name]": {
						required: true,
					},
					"data[Customer][customer_email]": {
						required: true,
		                email:true,
					},
		            "data[Customer][customer_phone]": {
						required: true,
		                number:true,
					}
				},
				messages: { 
					"data[Customer][first_name]": {
						required: "<?php echo __('Please enter firstname'); ?>",
					},
		            "data[Customer][customer_email]": {
						required: "<?php echo __('Please enter the email'); ?>",
						email : "<?php echo __('Please enter valid email'); ?>",
					},
		            "data[Customer][customer_phone]": {
						required: "<?php echo __('Please enter phone number'); ?>",
						number : "<?php echo __('Please enter valid phone number'); ?>",
					}

				}
			});

			var AddAdressBookvalidator = jQuery("#AddCustomerAddressBook").validate({
				rules: {
					"data[CustomerAddressBook][address_title]": {
						required: true,
					},
		            "data[CustomerAddressBook][address]": {
						required: true,
					},
		            "data[CustomerAddressBook][address_phone]": {
						required: true,
		                number:true,
					},
		            "data[CustomerAddressBook][landmark]": {
						required: true,
					},
		             "data[CustomerAddressBook][state_id]": {
						required: true,
					},
		             "data[CustomerAddressBook][city_id]": {
						required: true,
					},
		             "data[CustomerAddressBook][location_id]": {
						required: true,
					}
				},
				messages: { 
					"data[CustomerAddressBook][address_title]": {
						required: "<?php echo __('Please enter tittle'); ?>",
					},
		            "data[CustomerAddressBook][address]": {
						required: "<?php echo __('Please enter street address'); ?>",
					},
		            "data[CustomerAddressBook][address_phone]": {
						required: "<?php echo __('Please enter phone number'); ?>",
					},
		            "data[CustomerAddressBook][landmark]": {
						required: "<?php echo __('Please enter landmark'); ?>",
					},
		             "data[CustomerAddressBook][state_id]": {
						required: "<?php echo __('Please select state'); ?>",
					},
		             "data[CustomerAddressBook][city_id]": {
						required: "<?php echo __('Please select city'); ?>",
					},
		             "data[CustomerAddressBook][location_id]": {
						required: "<?php echo __('Please select location'); ?>",
					}

				}
			});
		    
		    	
		    
		    var EditAdressBookvalidator = jQuery("#EditCustomerAddressBook").validate({
				rules: {
					"data[CustomerAddressBook][address_title]": {
						required: true,
					},
		            "data[CustomerAddressBook][address]": {
						required: true,
					},
		            "data[CustomerAddressBook][address_phone]": {
						required: true,
		                number:true,
					},
		            "data[CustomerAddressBook][landmark]": {
						required: true,
					},
		             "data[CustomerAddressBook][state_id]": {
						required: true,
					},
		             "data[CustomerAddressBook][city_id]": {
						required: true,
					},
		             "data[CustomerAddressBook][location_id]": {
						required: true,
					}
				},
				messages: { 
					"data[CustomerAddressBook][address_title]": {
						required: "<?php echo __('Please enter tittle'); ?>",
					},
		            "data[CustomerAddressBook][address]": {
						required: "<?php echo __('Please enter street address'); ?>",
					},
		            "data[CustomerAddressBook][address_phone]": {
						required: "<?php echo __('Please enter phone number'); ?>",
						number : "<?php echo __('Please enter valid phone number'); ?>",
					},
		            "data[CustomerAddressBook][landmark]": {
						required: "<?php echo __('Please enter landmark'); ?>",
					},
		             "data[CustomerAddressBook][state_id]": {
							required: "<?php echo __('Please select state'); ?>",
					},
		             "data[CustomerAddressBook][city_id]": {
						required: "<?php echo __('Please select city'); ?>",
					},
		             "data[CustomerAddressBook][location_id]": {
						required: "<?php echo __('Please select location'); ?>",
					}

				}
			});
		});

		
		function validateAddress () {

			var title     = $('#CustomerAddressBookAddressTitles').val();
			var id        = $('#CustomerAddressBookId').val();
			var street    = $('#street').val();
			var ph        = $('#phone').val();
			var bulinding = $('#build').val();
			var state     = $('#CustomerAddressBookStateIds').val();
			var city      = $('#CustomerAddressBookCityIds').val();
			var area      = $('#CustomerAddressBookLocationIds').val();

			if(title == '') {
				$('.titleerorr').html("<?php echo __('Please enter tittle'); ?>");
				$('#CustomerAddressBookAddressTitles').focus();
				return false;
			}else if(street == ''){
				$('.streeterorr').html("<?php echo __('Please enter street address'); ?>");
				$('#street').focus();
				return false;
			}else if(ph == ''){
				$('.phoneerorr').html("<?php echo __('Please enter phone number'); ?>");
				$('#phone').focus();
				return false;
			}else if(isNaN(ph)){
				$('.phoneerorr').html("<?php echo __('Please enter valid phone number'); ?>");
				$('#phone').focus();
				return false;
			}else if(bulinding == ''){
				$('.builderorr').html("<?php echo __('Please enter landmark'); ?>");
				$('#build').focus();
				return false;
			}else if(state == ''){
				$('.stateerorr').html("<?php echo __('Please select state'); ?>");
				$('#CustomerAddressBookStateIds').focus();
				return false;
			}else if(city == ''){
				$('.cityerorr').html("<?php echo __('Please select city'); ?>");
				$('#CustomerAddressBookCityIds').focus();
				return false;
			}else if(area == ''){
				$('.areaerorr').html("<?php echo __('Please select location'); ?>");
				$('#CustomerAddressBookLocationIds').focus();
				return false;
			}else {
				$.post(rp+'customer/customers/editaddresschecking',{'title':title,'id':id}, function(response) {

					if($.trim(response) == 'success'){
						$("#EditCustomerAddressBook").submit();
					} else {
						$('.checkerorr').html("<?php echo __('Addressbook title already exists'); ?>");
						return false;
					}
				});
			}
			return false;
		}


		function addAddressCheck () {

			var title     = $('#CustomerAddressBookAddressTitle').val();

			$('.checkAdderorr').show();
			$('.checkAdderorr').html('');

			if (title != '') {
				$.post(rp+'customer/customers/editaddresschecking',{'title':title}, function(response) {

					if($.trim(response) == 'success'){   
						$("#AddCustomerAddressBook_Order").submit();
					} else {
						$('.checkAdderorr').html("<?php echo __('Addressbook title already exists'); ?>");
						return false;
					}
				});
				//return false;
			}
		}

		function checking(){
			$('.passerror').html('');
			var pass    = $('#UserOldpassword').val();
			var newpass     = $('#UserNewpassword').val();
			var confirm  = $('#UserConfirmpassword').val();
			if(pass != '' && newpass == '' && confirm == '' ) {
				$.post(rp + 'customer/Customers/passchecking', {'pass': pass}, function (response) {
					if ($.trim(response) == 'sucess') {
						$('#CustomerChangePasswordForm').submit();
					} else {
						$('#UserOldpassword').focus();
						$('.passerror').html("<?php echo __('Please enter old password'); ?>");
					}
				});
			} else {
				$('#UserOldpassword').focus();
				$('.passerror').html("<?php echo __('Please enter old password'); ?>");
				return false;
			}
		}


		function saveCard () {
			Stripe.setPublishableKey(publishKey);

			var CardName	= $('#CardName').val();
		 	var CardNumber	= $('#CardNumber').val();
		  	var CardCvv		= $('#CardCvv').val();
		    var noRecord    = $('#noRecord').text();

		    var savedCard = $.trim($('[name="data[Card][Saved]"]:checked').val());
		    
		    if ($('#cardCheck').is(":checked")) {
		        if (noRecord == '') {
		            if (savedCard != '') {
		                $('#UserPaymentForm').submit();
		                return false;
		            } else {
		                $('#error').html("<?php echo __('Please select any card'); ?>");
		                $('#error').addClass('error');
		                return false;
		            }
		        } else {
		            $('#error').html("<?php echo __('Card is not available'); ?>");
		            $('#error').addClass('error');
		            return false;
		        }
		    }
		    

		  	$('#error').html('');
		  	$('#error').removeClass('error');

		  	if (CardName == '') {

		        $('#error').html("<?php echo __('Please enter the name'); ?>");
		        $('#error').addClass('error');
		        $('#CardName').focus();
		        return false;
		    
		  	} else if (CardNumber == '') {

		        $('#error').html("<?php echo __('Please enter the card number'); ?>");
		        $('#error').addClass('error');
		        $('#CardNumber').focus();
		        return false;

		  	} else if (CardCvv == '') {

		        $('#error').html("<?php echo __('Please enter the cvv'); ?>");
		        $('#error').addClass('error');
		        $('#CardCvv').focus();
		        return false;

		  	} else {

				Stripe.card.createToken($('[name=StripeForm]'), 
			    function(status, response){
			       
			        if (status == 200 && response.id != '') {

						$('#CardName').append($('<input type="text" name="data[StripeCustomer][stripe_token_id]" value="'+response.id+'" />'+
												'<input type="text" name="data[StripeCustomer][card_id]" value="'+response.card.id+'" />'+
												'<input type="text" name="data[StripeCustomer][card_number]" value="'+response.card.last4+'" />'+
												'<input type="text" name="data[StripeCustomer][card_brand]" value="'+response.card.brand+'" />'+
												'<input type="text" name="data[StripeCustomer][card_type]" value="'+response.card.funding+'" />'+
												'<input type="text" name="data[StripeCustomer][exp_month]" value="'+response.card.exp_month+'" />'+
												'<input type="text" name="data[StripeCustomer][exp_year]" value="'+response.card.exp_year+'" />'+
												'<input type="text" name="data[StripeCustomer][country]" value="'+response.card.country+'" />'+
												'<input type="text" name="data[StripeCustomer][customer_name]" value="'+response.card.name+'" />'+
												'<input type="text" name="data[StripeCustomer][client_ip]" value="'+response.client_ip+'" />'));

						
		        		$("#stripebtn").attr('disabled','disabled');

		        		var checkMe = $('#checkout').val();

		        		if (checkMe == 'checkout') {

		        			var formData = ($("#UserIndexForm").serialize());
			        		$.post(rp+'/checkouts/customerCardAdd/',{'formData':formData}, function(res) {

					            $('#addpayment').modal('hide');

					            $.post(rp+'/checkouts/paymentCard/', function(respon) {
					            	$('#payment').html(respon);
						        });

						        $.post(rp+'/checkouts/cardAdd/', function(response) {
					            	$('#addpayment').html(response);

						        });
					        });
			        	} else {
			        		$('#UserIndexForm').submit();
			        	}
			        } else {
			        	alert("<?php echo __('Check your card details'); ?>");
			        }
				});
		    	return false;
			}
		}

		$(document).ready(function(){
			
			var speed = 'slow';
			var slides = $('#txtAni ul li');
		  	function slider() 
		  	{
		   	var now = $("#txtAni ul").children(':visible'),
		     	first = $("#txtAni ul").children(':first'),
		     	next = now.next();
		     	next = next.index() == -1 ? first : next;
		   	now.fadeOut(speed, function() {next.fadeIn(speed);});
		   	setTimeout(slider, 4500);
		  	} 
			slider();
			
			$("#howWork").on("click", function(){
				$("#howItWork").addClass("active");
				return false;
			});
			
			$("#close").on("click", function(){
				$("#howItWork").removeClass("active");
				return false;
			});
			
			$(document).on("click", function() {
				  $("#howItWork").removeClass("active");
				});
			
			$("#howItWork").on("click", function(e){
				  e.stopPropagation();
				});


			$("#menubutton").click(function() {
				$("header ul").slideToggle(400, function()  {
				jQuery(this).toggleClass("expanded").css('display',' ');
				
				});
				
			});
                        
                        $("#how_it_works").on("click",function(){
                            
                             $('html,body').animate({
                                scrollTop: $(".groceryworks").offset().top-100},
                              'slow');
                            
                        });
                        
                        
                        
                        
          var loginvalidator = jQuery("#UserLoginForm").validate({
				rules: {
					"data[User][username]": {
						required: true,
						email :true,
					},
		            "data[User][password]": {
						required: true,
					}
				},
				messages: { 
					"data[User][username]": {
						required: "Please enter email",
						email : "Please enter a valid email address",
					},
		            "data[User][password]": {
						required: "Please enter password",
					}

				}
			});
                        
                        
            $("#UserLoginForm").submit(function(e){
		
		e.preventDefault();
		
		if($("#UserLoginForm").valid()){
			
                        var rember_me = 0;
                        if ($('#remember_me').is(":checked"))
                        {
                          $('#remember_me').val(1);
                        }
                        
			var fromdata = $(this).serializeArray();
                        
			$.post(rp + 'customerlogin', {data : fromdata}, function (response) {
				
                                $("span.success_msg").remove();
                                
                                if(response == "unathorized_error"){
                                    $("div.login_logo h3").after("<span class='success_msg' style='color:red;'>Login failed, unauthorized.</span>");
                                }
                                else if(response == "data_incorrect_error"){
                                    $("div.login_logo h3").after("<span class='success_msg' style='color:red;'>Login failed your Username or Password Incorrect.</span>");
                                }
                                else{
                                    window.location.href = rp+"customer/customers/myaccount";
                                }
                                
				setTimeout(remove_message,2000);
				
			});
                            
		} else{
			return false;
		}
	});
          
                 
                 
	var $forgotvalidator =  $("#UserSignupForm").validate({
				rules: {
				   "data[Customer][first_name]": {
						required: true
					},
					"data[Customer][last_name]": {
						required: true
					},
		            "data[Customer][customer_email]": {
						required: true,
		                email:true
					},
		            "data[User][UserPassword_2]": {
						required: true
		                
					},
		            "data[User][confir_password]": {
						required: true
					//	equalTo: '#UserPassword'
					},
		            "data[Customer][customer_phone]": {
						required: true,
						number : true
					}
				},
				messages: { 
				  "data[Customer][first_name]": {
						required: "Please enter firstname",
					},
					"data[Customer][last_name]": {
					required: "Please enter lastname",
					},
		            "data[Customer][customer_email]": {
						required: "Please enter email",
						email : "Please enter a valid email address",
					},
		            "data[User][password]": {
					 	required: "Please enter password",
		                
					},
		            "data[User][confir_password]": {
						required: "Please enter confirm password",
						//equalTo: "Please enter the same value again",		                
					},
		            "data[Customer][customer_phone]": {
						required: "Please enter phone number",
						number : "Please enter valid phone number",

					}

				}
			});

	
	
	
	$("#UserSignupForm").submit(function(e){
		
		e.preventDefault();
		
		
		if($("#UserSignupForm").valid()){
			
			var fromdata = $(this).serializeArray();
			$.post(rp + 'signup', {data : fromdata}, function (response) {
				
                               // alert(response);
                                if(response == 1){
				$("div.login_logo h3").after("<span class='success_msg' style='color:green;'>Please check your email and activate your account. </span>");
				}
                                else{
                                    
                                  $("div.login_logo h3").after("<span class='error_msg' style='color:red;'>Mail not sent. </span>");  
                                }
				setTimeout(after_submit_signupform,2000);
                                
				return false;
			});
			
		} else{
			return false;
		}
	});
	
        
        
                
        var loginForgetmailvalidator = jQuery("#forgetmail").validate({
                    rules: {
                            "data[Users][email]": {
                                    required: true,
                                    email :true,
                            }
                    },
                    messages: {
                            "data[Users][email]": {
                                    required: "Please enter email.",
                                    email : "Please enter a valid email address.",
                            }
                    }
            }); 
        
        
        $("#forgetmail").submit(function(e){
		
		e.preventDefault();
                
		if($("#forgetmail").valid()){
			
			var fromdata = $(this).serializeArray();
                        
			$.post(rp + 'customerlogin', {data : fromdata}, function (response) {
				
                                remove_message();
                                if(response == "not_registered_error"){
				$("div.login_logo h3").after("<span class='success_msg' style='color:red;'>You are not register customer.</span>"); 
                                }
                                else if(response == "not_send_mail"){
                                    $("div.login_logo h3").after("<span class='success_msg' style='color:red;'>Email has been not sent.</span>"); 
                                }
                                else if(response == "success_msg"){
                                    $("div.login_logo h3").after("<span class='success_msg' style='color:green;'>Email has been sent successfully.</span>"); 
                                    window.location.href = rp;
                                }
				
				setTimeout(remove_message,2000);
				
			});
			
		} else{
			return false;
		}
	});
        
        
        
            $("#forgot_password").on("click",function(){
	
		$("div#loginform").css("display","none");
		$("div#forgotform").css("display","block");
		
	});
	
	$(".login").on("click",function(){
	
		$("div#loginform").css("display","block");
		$("div#forgotform").css("display","none");
		
	});     
        
        
        $('body').on('click', 'a.add-to-cart', function(e) {
       
            e.preventDefault();
            
       //     alert("HERE");
            
        var cart_data = $('.shopping-cart');
      //  var imgtodrag = $(this).parent('.item').find("img").eq(0);
        
        var imgtodrag = $(this).parent().parent().parent().parent().find("img").eq(0);
        
     //   alert(imgtodrag);
        
     //   return false;
        
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '100'
            })
                .appendTo($('body'))
                .animate({
                'top': cart_data.offset().top + 10,
                    'left': cart_data.offset().left + 10,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo');
            
         //   setTimeout(function () {
           //     cart_data.effect("shake", {
           //         times: 2
           //     }, 200);
          //  }, 1500);

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
        }
   });
       
       $("body").on("click","a.checkout",function(e){
       
        e.preventDefault();
        
         var checkout_url = $(this).attr("href");
                       
        var split_url = checkout_url.split("=");

        if(split_url[1] == "checkout"){

            $("form#UserLoginForm").attr("action",checkout_url);
            $("a#login_popup").trigger("click");
        }
        else{
           
            window.location.href= checkout_url;
            
        }
        
        
        
       
       
       });
        

		});
                
                
function after_submit_signupform(){

	$("#UserSignupForm input#CustomerFirstName").val("");
	$("#UserSignupForm input#CustomerLastName").val("");
	$("#UserSignupForm input#CustomerCustomerEmail").val("");
	$("#UserSignupForm input#UserPassword_2").val("");
	$("#UserSignupForm input#UserConfirPassword").val("");
	$("#UserSignupForm input#CustomerCustomerPhone").val("");
	$("span.success_msg").remove();
	//alert("here");
	$("a#modal_submitdata").trigger("click");
        
       //  $('#modal').modal('toggle');
        
	
}
                
                
	</script>

	<?php
		if ($this->request->params['controller'] == 'searches' &&
			$this->request->params['action'] == 'storeitems') {
	?>
			<script type="text/javascript">
				$(document).ready(function(){								
					$(".viewCart_mobile").click(function() {
						$('#cart-sidebar').show();
					});
					$(".mobile_cart_close").click(function() {
						$('#cart-sidebar').hide();
					});
				});
			</script> <?php
		}

		if (!empty($siteSetting['Sitesetting']['google_analytics'])) {
			echo '<script>'. $siteSetting['Sitesetting']['google_analytics']. '</script>';
		}

		if (!empty($siteSetting['Sitesetting']['woopra_analytics'])) {
			echo '<script>'. $siteSetting['Sitesetting']['woopra_analytics']. '</script>';
		} ?>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>
<script>
$(document).ready(function(){
    $('.close_pop_btn a').click(function(){
        $('.changeloc-popup').hide();
   });

});
</script>

	
	</body>
</html>