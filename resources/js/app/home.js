$(document).ready(function() {

    //search in input header
    $("#searchInput").on("keypress", function(e) {
        var value = $(this)
            .val()
            .toLowerCase();

        if (e.which == 13) {
            var origin = window.location.origin;
            window.location.href = origin + "?search=" + value;
        }
    });

});
