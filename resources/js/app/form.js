$("#canvas_image").hide();
$("#remove").hide();
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $("#canvas_image").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function() {
    if ($("#imgInp").val() != "") {
        $("#remove").show();
        $("#canvas_image").show("slow");
    } else {
        $("#remove").hide();
        $("#canvas_image").hide("slow");
    }
    readURL(this);
});

$("#remove").click(function() {
    $("#imgInp").val("");
    $("#old_canvas_image").empty();

    $(this).hide();
    $("#canvas_image").hide("slow");
    $("#canvas_image").attr(
        "src",
        "http://upload.wikimedia.org/wikipedia/commons/thumb/4/40/No_pub.svg/150px-No_pub.svg.png"
    );
});
