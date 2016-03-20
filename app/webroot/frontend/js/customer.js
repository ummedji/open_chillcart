//customerAddressBookEdit process
function customerAddressBookEdit(id) {
    $.post(rp + 'customer/customers/editaddressbook', {'id': id}, function (response) {
        $('#editBookAddress').html(response);
        $('#editBookAddress').modal('show');
    });
}
//City Fillter Process
function cityFillters() {
    var id = $('#CustomerAddressBookStateId').val();
    $.post(rp + '/customer/customers/cityFillter', {'id': id}, function (response) {
        $("#CustomerAddressBookCityId").html(response);

    })
}
//Location Fillter Process
function locationFillters() {
    var id = $('#CustomerAddressBookCityId').val();
    $.post(rp + '/customer/customers/locationFillter', {'id': id}, function (response) {
        $("#CustomerAddressBookLocationId").html(response);

    })
}

//City Fillter Process
function cityFillter() {
    var id = $('#CustomerAddressBookStateIds').val();
    $.post(rp + '/customer/customers/cityFillter', {'id': id}, function (response) {
        $("#CustomerAddressBookCityIds").html(response);

    })
}
//Location Fillter Process
function locationFillter() {
    var id = $('#CustomerAddressBookCityIds').val();
    $.post(rp + '/customer/customers/locationFillter', {'id': id}, function (response) {
        $("#CustomerAddressBookLocationIds").html(response);

    })
}


//customer delete action
function customerdelete(id, model) {
    $.post(rp+'customer/Customers/deleteaddress',{'id':id,'model':model}, function(response) {
        $("#record"+id).remove();
    });
}

//Status Change
function statusChange(id, model) {
    $.post(rp+'customer/Customers/addressbookStatus',{'id':id,'model':model},function(response) {
    })
}

// delete card
function deletecard(id) {
    $.post(rp + 'customer/Customers/deletecard', {'id': id}, function (response) {
        $("#card" + id).remove();
    })
}

//OrderInvoice Details Print Format 
function documentPrints() {
    var win = window.open('', 'printwindow');
    win.document.write('<html><head><title>Print Order Invoice!</title><link rel="stylesheet" type="text/css" href="styles.css"></head><body>');
    win.document.write($(".myorderTab").html());
    win.document.write('</body></html>');
    win.print();
    $('.link').hide();
    $('.footer').hide();
    $('#sidebar').hide();
    win.close();
}

function pdfdownload(id) {
    $.post(rp + 'customer/Customers/downloadiInvoice', {'id': id}, function (response) {
        // alert(response) ;
    });
}
function orderid(id) {
    $('#reviewId').val(id);

}
$(document).ready(function () {


    $(".table").on('click', '.buttonStatus', function () {
        if ($(this).hasClass('red_bck')) {
            $(this).removeClass('red_bck');
            $(this).children("i").removeClass('fa-times').addClass("fa-check");
        }
        else if ($(this).hasClass('yellow_bck')) {
            $(this).removeClass('yellow_bck');
            $(this).children("i").removeClass('fa-exclamation').addClass("fa-check");
        }
        else {
            $(this).addClass('red_bck');
            $(this).children("i").removeClass('fa-check').addClass("fa-times");
        }

    });

    $("#forgetPage").click(function () {
        $("#forgetsmail").show();
        $("#login").hide();

    });

    $('#loginPage').click(function () {
        $("#forgetsmail").hide();
        $("#login").show();
    })

});