<template>
  <form @submit.prevent="submitComment">
    <div class="comment-box d-flex mt-3">
      <input
        class="form-control recipe-comment"
        type="text"
        ref="userComment"
        id="userComment"
        name="content"
        required
        v-model="content"
        placeholder="コメントをする"
      />
      <button type="submit" class="comment-btn btn btn-primary btn-lg">
        <i class="fas fa-paper-plane"></i>
      </button>
    </div>
  </form>
</template>

<script>
import axios from "axios";

export default {
  props: {
    authorized: {
      type: Boolean,
      default: false,
    },
    endpoint: {
      type: String,
    },
  },
  data() {
    return {
      content: "",
    };
  },
  methods: {
    submitComment() {
      if (!this.authorized) {
        alert("フォロー機能はログイン中のみ使用できます");
        return;
      }
        this.comment();
    },
    async comment() {
      const response = await axios.post(this.endpoint);
    },
  },
};
</script>