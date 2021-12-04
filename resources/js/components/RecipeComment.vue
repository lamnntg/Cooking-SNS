<template>
  <div class="d-inline-block">
    <button type="button" class="btn m-0 p-1 shadow-none">
      <i class="far fa-comment" @click="clickComment" />
    </button>
    {{ countComments }}
  </div>
</template>

<script>
export default {
  props: {
    authorized: {
      type: Boolean,
      default: false,
    },
    initialCountComments: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      countComments: this.initialCountComments,
      gotToLike: false,
    };
  },
  methods: {
    clickComment() {
      if (!this.authorized) {
        alert("コメント機能はログイン中のみ使用できます");
        return;
      }
      const commentBox = document.getElementById("userComment");
      commentBox.focus();
    },
  },
};
</script>
