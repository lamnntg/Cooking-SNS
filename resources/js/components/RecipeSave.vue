<template>
  <div>
    <button
      class="btn-sm shadow-none p-2"
      :class="buttonColor"
      @click="clickSave"
    >
      <i class="me-1" :class="buttonIcon"></i>
      {{ buttonText }}
    </button>
  </div>
</template>

<script>
export default {
  props: {
    initialIsSaved: {
      type: Boolean,
      default: false,
    },
    authorized: {
      type: Boolean,
      default: false,
    },
    // endpoint: {
    //   type: String,
    // },
  },
  data() {
    return {
      isSaved: this.initialIsSaved,
    };
  },
  computed: {
    buttonColor() {
      return this.isSaved ? "btn btn-success" : "btn btn-outline-success";
    },
    buttonIcon() {
      return this.isSaved ? "fas fa-check" : "far fa-bookmark";
    },
    buttonText() {
      return this.isSaved ? "保存しました" : "保存する";
    },
  },
  methods: {
    clickSave() {
      if (!this.authorized) {
        alert("フォロー機能はログイン中のみ使用できます");
        return;
      }

      this.isSaved ? this.unsave() : this.save();
    },
    async save() {
      const response = await axios.put(this.endpoint);

      this.isSaved = true;
    },
    async unsave() {
      const response = await axios.delete(this.endpoint);

      this.isSaved = false;
    },
  },
};
</script>