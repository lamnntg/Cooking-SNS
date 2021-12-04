$("#avatar").click(function() {
    $("#avatar-input").click();
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#avatar").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#avatar-input").change(function() {
    if ($("#avatar-input").val() != "") {
        $("#avatar").show("slow");
    }

    readURL(this);
});
