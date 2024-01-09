$(document).ready(function (){

    $("#SingInForm").submit(function(e){
        e.preventDefault();
        var formDetails = $("#SingInForm").serializeArray();

        $.ajax({
            url: $("#SingInForm").attr("action"),
            type: 'post',
            data: formDetails,
            async: false,
            success: function(response) {
                if (typeof response.success != "undefined" && response.success) {
                    alert("Logged In Successfully");
                    window.location.href = response.redirectUrl;
                } else {
                    alert("Email or Password Incorrect");
                }
            },
            error: function(xhr) {
                alert("Unable check the details. Please refresh the page and try again.");
            }
        });

    });
});