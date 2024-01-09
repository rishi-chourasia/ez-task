$(document).ready(function (){

    $("#UserEditForm").submit(function(e){
        e.preventDefault();
        var formDetails = $("#UserEditForm").serializeArray();

        console.log(formDetails);

        var id = $("#UserId").val();
        var firstName = $("#UserFirstName").val();
        var lastName = $("#UserLastName").val();
        var contactNumber = $("#UserContactNumber").val();
        var email = $("#UserEmail").val();
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

        if (checkExistsEmail(email, id)) {
            alert("Email already exists");
            $("#UserEmail").focus();
            return false;
        }

        $.ajax({
            url: $("#UserEditForm").attr("action"),
            type: 'post',
            data: formDetails,
            async: false,
            success: function(response) {
                if (typeof response.success != "undefined" && response.success) {
                    alert("User Updated Successfully");
                    window.location.href = response.redirectUrl;
                }
            },
            error: function(xhr) {
                alert("Unable to update the details. Please refresh the page and try again.");
            }
        });

    });


    function checkExistsEmail(email, id) {
        var success = false;
        $.ajax({
            url: $("#UserEditForm").attr("data-email-check-url"),
            type: 'post',
            data: {email: email, id: id},
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