import './bootstrap'
import Vue from 'vue'
import RecipeLike from './components/RecipeLike'
import RecipeComment from './components/RecipeComment'
import RecipeSave from './components/RecipeSave'
import RecipeTagsInput from './components/RecipeTagsInput'
import FollowButton from './components/FollowButton'
import CommentBox from './components/CommentBox'

const app = new Vue({
    el: '#app',
    components: {
        RecipeLike,
        RecipeTagsInput,
        RecipeSave,
        RecipeComment,
        FollowButton,
        CommentBox
    }
})
