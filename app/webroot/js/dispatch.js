

jQuery().ready(function() {

	var DriverAdminAddForm = jQuery("#DriverAdminAddForm").validate({
		rules: {
			"data[Driver][driver_name]": {
				required: true,
			},
			"data[Driver][driver_email]": {
				required: true,
				email:true,
			},
			"data[User][username]": {
				required: true,
				number:true,
			},
			"data[User][password]": {
				required: true,
			},
			"data[User][conformpassword]": {
				required: true,
				//equalsTo:'#UserPassword',
			},
			"data[Driver][address]": {
				required: true,
			},
			"data[Driver][license_no]": {
				required: true,
			},
		},
		messages: { 
			"data[Driver][driver_name]": {
				required: "Please enter the driver name",
			},
			"data[Driver][driver_email]": {
				required: "Please enter the email",
			},
			"data[User][username]": {
				required: "Please enter the Phone number",
			},
			"data[User][password]": {
				required: "Please enter the password",
			},
			"data[User][conformpassword]": {
				required: "Please enter the confirm password",
			},
			"data[Driver][address]": {
				required: "Please enter the address",
			},
			"data[Driver][license_no]": {
				required: "Please enter the license no",
			},
		}
	});
	

	var DriverAdminEditForm = jQuery("#DriverAdminEditForm").validate({
		rules: {
			"data[Driver][driver_name]": {
				required: true,
			},
			"data[Driver][driver_email]": {
				required: true,
				email:true,
			},
			"data[Driver][driver_phone]": {
				required: true,
				number : true
			},
			"data[Driver][address]": {
				required: true,
			},
			"data[Driver][license_no]": {
				required: true,
			},
		},
		messages: { 
			"data[Driver][driver_name]": {
				required: "Please enter the driver name",
			},
			"data[Driver][driver_email]": {
				required: "Please enter the email",
			},
			"data[Driver][driver_phone]": {
				required: "Please enter the phone number",
			},
			"data[Driver][address]": {
				required: "Please enter the address",
			},
			"data[Driver][license_no]": {
				required: "Please enter the license no",
			},
		}
	});



	var VehicleAdminAddvehicleForm = jQuery("#VehicleAdminAddvehicleForm").validate({
		rules: {
			"data[Vehicle][vehicle_name]": {
				required: true,
			},
			"data[Vehicle][model_name]": {
				required: true,
			},
			"data[Vehicle][color]": {
				required: true,
			},
			"data[Vehicle][year]": {
				required: true,
				number : true
			},
			"data[Vehicle][vehicle_no]": {
				required: true,
			},
		},
		messages: { 
			"data[Vehicle][vehicle_name]": {
				required: "Please enter the vehicle name",
			},
			"data[Vehicle][model_name]": {
				required: "Please enter the vehicle model",
			},
			"data[Vehicle][color]": {
				required: "Please enter the vehicle color",
			},
			"data[Vehicle][year]": {
				required: "Please enter the year",
			},
			"data[Vehicle][vehicle_no]": {
				required: "Please enter the vehicle no",
			},
		}
	});



	var VehicleAdminEditvehicleForm = jQuery("#VehicleAdminEditvehicleForm").validate({
		rules: {
			"data[Vehicle][vehicle_name]": {
				required: true,
			},
			"data[Vehicle][model_name]": {
				required: true,
			},
			"data[Vehicle][color]": {
				required: true,
			},
			"data[Vehicle][year]": {
				required: true,
				number : true
			},
			"data[Vehicle][vehicle_no]": {
				required: true,
			},
		},
		messages: { 
			"data[Vehicle][vehicle_name]": {
				required: "Please enter the vehicle name",
			},
			"data[Vehicle][model_name]": {
				required: "Please enter the vehicle model",
			},
			"data[Vehicle][color]": {
				required: "Please enter the vehicle color",
			},
			"data[Vehicle][year]": {
				required: "Please enter the year",
			},
			"data[Vehicle][vehicle_no]": {
				required: "Please enter the vehicle no",
			},
		}
	});
});


/*$(document).ready(function() {
	trackings();
	updateOrderMap();
});*/


//Clear Console
function clearConsole() {
    if(window.console || window.console.firebug) {
        //console.clear();
    }
}



//Update map when mouse enter and leave for map
function updateOrderMap() {

    $.post(rp+'/AjaxAction',{'Action':'orderManage'}, function(response) {
    	//clearConsole();
    	response = response.split('@@@@');
        if (response[0] != '') {
            var data    = JSON.parse(response[0]);

            $.each(data, function(key, value) {

            	var driverName = '<span class="tdnotassign">Not Yet Assigned</span>';
                var orderId = data[key].Order.id;
                var status  = data[key].Order.status;

                $('#status'+orderId).html(status);

                if (data[key].Order.status != 'Accepted') {
                	driverName = '<span class="tddriver">'+data[key].Driver.driver_name+'</span>';
                	$('#icon'+orderId).removeClass('buttonEdit');
                    $('#icon'+orderId).html('');
                    if (data[key].Order.status != 'Delivered') {
                        $('#orderDisclaim'+orderId).html('<a class="buttonEdit" href="javascript:void(0);" onclick="return disclaimOrder('+orderId+');"><i class="fa fa-ban"></i></a>');
                    }

                } else {
                    var icon = '<i class="fa fa-car"></i>';
                    $('#icon'+orderId).addClass('buttonEdit');
                    $('#icon'+orderId).html(icon);
                    $('#orderDisclaim'+orderId).html('');
                }
                $('#driver'+orderId).html(driverName);
            });
        }


        if (response[1] != '') {
            var completeData    = JSON.parse(response[1]);
            $.each(completeData, function(key, value) {
                var orderId = completeData[key].Order.id;
                var status  = '<span>'+completeData[key].Order.status+'</span>';
                $('#status'+orderId).html(status);
                if (completeData[key].Order.status == 'Delivered') {
                    $('#orderList_'+orderId).remove(); 
                }
            });
        }
        setTimeout(function() {
            updateOrderMap();
        }, 2000)
        return false;
    });
}


function disclaimOrder(orderId) {
	$.post(rp+'/admin/orders/orderStatus',{'orderId':orderId, 'status':'Accepted'}, function(response) {
		//clearConsole();
	});
}


//Assign Order
function assignOrder(ord, driver) {
	
    $('#assign'+driver).hide();
    $('#waiting'+driver).show();
    $.post(rp+'/drivers/assignOrder/'+ord+'/'+driver,
        function(response) {
            if (response == 1) {
                window.location.href = rp+'/admin/Orders/order';
                return false;
                
            }
        });
    return false;
}


function viewTrack(ordId) {

    $('#trackOrderId').val(ordId);
    $('#trackid').show();
    $('#initialmap').html('');
    $('#initialmap').load(rp+'/AjaxAction', {'Action' : 'InitialTracking'}, function(response) {
    	//alert(response);
    });
    return false;
}

function trackings() {
    var ordId = $('#trackOrderId').val(); 
    
    if (ordId != '' && $('#trackid:hidden').length == 0) {
        $.post(rp+'/AjaxAction',{'OrderId':ordId,'Action':'LoadTrackingMap'}, function(response) {
            clearConsole();
            removeMapIcons();
            var result = response.split('||@@||');
            $('#TrackingMap').html(result[0]);
            $('#trackingDistance').html(result[1]);
        });
    }
    setTimeout(function() {
        trackings();
    }, 4000);
    return false;
}

//Remove all icons from map
function removeMapIcons() {
    deleteMarkers();
    if ($('[name=direction]').val() == 'available') {
        directions1Display.setMap(null);
        directions1Display.setPanel(null);
    }
}

//Delete all marker
function deleteMarkers() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }

}




$('.statusLog').on('click', function() {
    var id = $(this).attr('id');
    var driverId = id.replace('log', '')
    $.post(rp+'/MobileApi/request',{'action':'DriverLogOut', 'from':'site', 'driverid':driverId}, function(response) {
        location.reload();
        return false;
    });
});



$(document).ready(function(){
	

	$(".table").on('click','.buttonStatus',function() {
		if($(this).hasClass('red_bck')){
			$(this).removeClass('red_bck');
			$(this).children("i").removeClass('fa-times').addClass("fa-check");
		}
		else if($(this).hasClass('yellow_bck')){
			$(this).removeClass('yellow_bck');
			$(this).children("i").removeClass('fa-exclamation').addClass("fa-check");
		}
		else{
			$(this).addClass('red_bck');
			$(this).children("i").removeClass('fa-check').addClass("fa-times");
		}

	});


	$('#sample_12').dataTable( {
		columnDefs: [
		   { 
		   	 "bSortable" : false,
		   	 "aTargets" : [ "no-sort" ]
		   }
		]
	} );

});

function trackOrder(orderId) {
	$('.ui-loadercont').show();
    $('#trackingContent').html('');
    $.post(rp+'/AjaxAction/index', {'orderId' : orderId, 'Action' : 'OrderStatus'}, function(response) {
         $('#trackingContent').html(response);
         $('.ui-loadercont').hide();
        $('#reportpopup').modal('show');
    });
    return false;
}