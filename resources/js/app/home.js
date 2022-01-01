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
