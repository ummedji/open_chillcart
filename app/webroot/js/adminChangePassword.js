jQuery(function () {

    var login = jQuery("#UserAdminLoginForm").validate({
        rules: {
            "data[User][username]": {
                required: true,
            },
            "data[User][password]": {
                required: true,
            }
        },
        messages: {
            "data[User][username]": {
                required: "Please enter the username",
            },
            "data[User][password]": {
                required: "Please enter the password",
            },
        }
    });

    var UserAdminChangepassword = jQuery("#UserAdminChangepasswordForm").validate({
        rules: {
            "data[User][oldpassword]": {
                required: true,
            },
            "data[User][newpassword]": {
                required: true,
            },
            "data[User][retypepassword]": {
                required: true,
                equalTo: '#UserPassword'
            }
        },
        messages: {
            "data[User][oldpassword]": {
                required: "Please enter the old password",
            },
            "data[User][newpassword]": {
                required: "Please enter the new password",
            },
            "data[User][retypepassword]": {
                required: "Please enter the confirm password",
                //equalTo : "Please enter the same "
            },
        }
    });
});