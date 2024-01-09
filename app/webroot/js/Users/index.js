$(document).ready(function(){

    function listUsers(url) {
        $.ajax({
            url: url,
            type: 'get',
            async: false,
            success: function(response) {
                $("#UserListSection").html(response);
            },
            error: function(xhr) {
                alert("Unable to get the user information. Please refresh the page and try again");
            }
        });
    }

    var listUserUrl = $("#UserListSection").attr("data-user-list-url");
    listUsers(listUserUrl);

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();

        var url = $(this).attr("href");
        listUsers(url);

    });

    $(document).on('click', '.delete-user-link', function(e){
        e.preventDefault();

        var url = $(this).attr("data-delete-url");
        var id = $(this).attr("data-id");

        if (!confirm("Are you really want to delete the user?")) {
            return false;
        }

        $.ajax({
            url: url,
            type: 'post',
            data: {id: id},
            async: false,
            success: function(response) {
                if (typeof response.success != "undefined" && response.success) {
                    alert("User Deleted Successfully");
                    window.location.href = response.redirectUrl;
                }
            },
            error: function(xhr) {
                alert("Unable to delete the user. Please refresh the page and try again");
            }
        });

    });

});