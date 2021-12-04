$("#comment-submit").click(function(event) {
    event.preventDefault();
    $.ajax({
        url: `/recipes/${recipeId}/comment`,
        type: "POST",
        data: {
            content: $("#comment").val(),
            user_id: userId
        },
        success: function(response) {
            if (response) {
                $("#comment").val("");
                var newComment = response.result;
                $("#list_comments .comment-list:last-child").after(newComment);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
});
