$(document).ready(function (){

    $("#SignUpForm").submit(function(e){
        e.preventDefault();
        var formDetails = $("#SignUpForm").serializeArray();

        var firstName = $("#UserFirstName").val();
        var lastName = $("#UserLastName").val();
        var contactNumber = $("#UserContactNumber").val();
        var email = $("#UserEmail").val();
        var pwd = $("#UserPassword").val();
        var confirmPwd = $("#UserConfirmPassword").val();
        var address = $("#UserAddress").val();
        var state = $("#UserState").val();

        if (!firstName.trim()) {
            alert("Please enter valid first name.");
            $("#UserFirstName").focus();
            return false;
        }

        if (!firstName.match(/^[A-Za-z]+$/)) {
            alert("Please enter only alphabets in first name.");
            $("#UserFirstName").focus();
            return false;
        }

        if (!lastName.trim()) {
            alert("Please enter valid last name.");
            $("#UserLastName").focus();
            return false;
        }

        if (!lastName.match(/^[A-Za-z]+$/)) {
            alert("Please enter only alphabets in last name.");
            $("#UserLastName").focus();
            return false;
        }

        if (!contactNumber.trim()) {
            alert("Please enter valid contact-number.");
            $("#UserContactNumber").focus();
            return false;
        }

        if (!contactNumber.match(/^[0-9]+$/)) {
            alert("Please enter only numbers contact-number.");
            $("#UserContactNumber").focus();
            return false;
        }

        if (contactNumber.length != 10) {
            alert("Please enter 10 digits contact-number.");
            $("#UserContactNumber").focus();
            return false;
        }

        if (contactNumber.indexOf(0) == '0') {
            alert("First digit should not be 0 in contact-number.");
            $("#UserContactNumber").focus();
            return false;
        }

        if (!email.trim() || !email.match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            alert("Please enter valid email.");
            $("#UserEmail").focus();
            return false;
        }

        if (!pwd.trim()) {
            alert("Please enter valid password.");
            $("#UserPassword").focus();
            return false;
        }

        if (pwd.length < 6) {
            alert("Minimum length should be 6 digit for password");
            $("#UserPassword").focus();
            return false;
        }

        if (pwd.length > 20) {
            alert("Maximum length should be 20 digit for password");
            $("#UserPassword").focus();
            return false;
        }

        if (pwd != confirmPwd) {
            alert("Password and confirm password do not matched.");
            $("#UserConfirmPassword").focus();
            return false;
        }

        if (!address.trim()) {
            alert("Please enter valid address.");
            $("#UserAddress").focus();
            return false;
        }

        if (!state.trim()) {
            alert("Please enter valid state.");
            $("#UserState").focus();
            return false;
        }

        if (checkExistsEmail(email)) {
            alert("Email already exists");
            $("#UserEmail").focus();
            return false;
        }

        $.ajax({
            url: $("#SignUpForm").attr("action"),
            type: 'post',
            data: formDetails,
            async: false,
            success: function(response) {
                if (typeof response.success != "undefined" && response.success) {
                    alert("Signed-Up Successfully");
                    window.location.href = response.redirectUrl;
                }
            },
            error: function(xhr) {
                alert("Unable to save the details. Please refresh the page and try again.");
            }
        });

    });


    function checkExistsEmail(email) {
        var success = false;
        $.ajax({
            url: $("#SignUpForm").attr("data-email-check-url"),
            type: 'post',
            data: {email: email},
            async: false,
            success: function(response) {
                if (typeof response.success != "undefined" && response.success) {
                    success = true;
                }
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
        return success;
    }

});