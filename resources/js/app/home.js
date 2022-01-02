$(document).ready(function () {

    //search in input header
    $("#searchInput").on("keypress", function (e) {
        var value = $(this)
            .val()
            .toLowerCase();

        if (e.which == 13) {
            var origin = window.location.origin;
            window.location.href = origin + "?search=" + value;
        }
    });

    $("#tagInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        toggleFilteredTags(value);
        if (value !== "") {
            $("#tags-clear-btn").show()
        } else {
            $("#tags-clear-btn").hide()
        }
    });

});

$('#tags-clear-btn').on("click", function (event) {
    event.preventDefault();
    $("#tagInput").val("")
    $("#tags-clear-btn").hide()
    toggleFilteredTags("")

});

$('#tags-right-btn').on("click", function (event) {
    event.preventDefault();
    $('#tags-content').animate({
        scrollLeft: "+=400px"
    }, "slow", function () {
        toggleScrollButton()
    });
});

$('#tags-left-btn').on("click", function (event) {
    event.preventDefault();
    $('#tags-content').animate({
        scrollLeft: "-=400px"
    }, "slow", function () {
        toggleScrollButton()
    });
});

const tagsContent = document.getElementById("tags-content")
const tagsLeftBtn = document.getElementById("tags-left-btn")
const tagsRightBtn = document.getElementById("tags-right-btn")

const toggleFilteredTags = (value) => {
    $("#tags-content a").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
}
const toggleScrollButton = () => {
    if (tagsContent.scrollLeft == 0) {
        tagsLeftBtn.style.display = "none"
    } else {
        tagsLeftBtn.style.display = "block"
    }
    if (tagsContent.scrollWidth == tagsContent.offsetWidth + tagsContent.scrollLeft) {
        tagsRightBtn.style.display = "none"
    } else {
        tagsRightBtn.style.display = "block"
    }
}

toggleScrollButton()
