window.Vue = require("vue");


import "./bootstrap";
import Vue from "vue";
import RecipeLike from "./components/RecipeLike";
import RecipeComment from "./components/RecipeComment";
import RecipeSave from "./components/RecipeSave";
import RecipeTagsInput from "./components/RecipeTagsInput";
import FollowButton from "./components/FollowButton";
import CommentBox from "./components/CommentBox";
import Notifications from "./components/Notifications";

const app = new Vue({
    el: "#app",
    components: {
        RecipeLike,
        RecipeTagsInput,
        RecipeSave,
        RecipeComment,
        FollowButton,
        CommentBox,
        Notifications
    },
    // created() {
    //     Echo.channel("notification").listen("MessageNotification", e => {
    //         alert(e);
    //         console.log(e)
    //     });
    // }
});
