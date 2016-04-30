<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">
if (top !=self) {
   top.location=self.location;
}
</script>
<meta charset="utf-8"/>
<title> <?php echo $title_for_layout; ?> </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/> <?php
	echo $this->Html->meta('icon', $this->Html->url($siteUrl.'/siteicons/fav.ico')); ?>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> <?php 
	echo $this->Html->css(
					array('font-awesome.min',
							'bootstrap.min',
							'uniform.default',
							'bootstrap-switch.min',
							'select2',
							'dataTables.bootstrap',
							'components',
							'plugins',
							'login',
							'layout',
                            'jquery.ui.datepicker',
                            'summernote',                            
                            'common_new',   
							'default'));
	echo $this->Html->script(array('jquery-1.11.0.min',
									'jquery-migrate-1.2.1.min',
									'bootstrap.min',
									'bootstrap-hover-dropdown.min',
									'jquery.uniform.min')); ?>


</head>

<?php if(empty($loggedUser['role_id'])) {  ?>
<body  class="login">
<?php }else if(isset($loggedUser['role_id']) && ($loggedUser['role_id'] == 1 || $loggedUser['role_id'] == 2 || $loggedUser['role_id'] == 4)) { ?>
<body class="page-boxed page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed-hide-logo"> 
<?php } 
if(isset($loggedUser['role_id']) && ($loggedUser['role_id'] == 1)) {
echo $this->element('admin/topheader'); } ?>
<div class="page-container">
<?php if(empty($loggedUser['role_id'])) {  ?>
	<div class="logo">
			<a href="javascript:void();">
				Grocery
			</a>
	</div>

<?php
 } else if(($loggedUser['role_id']) && ($loggedUser['role_id'] == 1)) {

	echo $this->element('admin/sidebar'); 
} ?>


<?php if(!empty($loggedUser['role_id'])) {  ?>

	
	<div class="page-content-wrapper">
		<div class="page-content">	

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>

	<?php } else { ?>



			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
			

	<?php
	}
	?>
		
	</div>
	<!-- BEGIN FOOTER -->
	<div class="page-footer">
		<div class="page-footer-inner">2016 &copy; ChillCart Ltd.</div>
		<div class="scroll-to-top"><i class="icon-arrow-up"></i></div>
	</div>

	<!-- Page refresh loading image -->
    <div class="ui-loadercont">
        <div class="spinner_new">
        	<div class="spinner-icon_new"></div>
        </div>
    </div>
	<!-- END FOOTER --> 
	<?php
		
		if ($this->request->params['controller'] == 'products' && 
				$this->request->params['action'] == 'admin_index') {
			
		} else {
			echo $this->Html->script(array('jquery.validate.min',
											'adminChangePassword'
											));
		}

		echo $this->Html->script(array('bootstrap-switch.min',
									'moment.min',
									'jquery.dataTables.min',
									'dataTables.bootstrap',
									'metronic',
									'layout',
									'demo',
									'components-editors',
									'product_mgnt',
									'location',
									'dispatch',
									'storeSetting',
                                    'bootstrap-datepicker',
                                    'summernote.min',
                                    'daterangepicker',
                                    'jquery-ui-1.10.3.custom.min',
                                    'siteSetting'
                                    )); ?>
	
	<script>
		var rp = "<?php echo $siteUrl; ?>";

		$(window).load(function() {
			$('.ui-loadercont').hide();
		});
		
	</script>


	<script>	 	

		$(document).ready(function() {   
			Metronic.init(); // init metronic core components
			//Layout.init(); // init current layout
			Demo.init(); // init demo features
			
			$('#forget-password').click(function() {
				jQuery('.login-form').hide();
				jQuery('.forget-form').show();
			});
		
			$('#back-btn').click(function() {
				jQuery('.login-form').show();
				jQuery('.forget-form').hide();
			});
			clearConsole();

		});
		function doResize()
		 {
			var navbar_height = $(".header").height();
				
			//middle minimum height
			var footer_height = $(".footer").height();			
			var win_height = $(window).height();
						
			var middle_height = win_height - ( navbar_height + footer_height );/* -25 for footer paddings*/
			$(".middle_height").css({"min-height":middle_height});

            
		 }
	</script>

</body>
<!-- END BODY -->
</html>