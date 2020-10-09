<template>
  <button class="mb-2 btn" @click="goTo()">
      <font-awesome-icon :icon="icon"/>&nbsp;{{ text }}</button>
</template>

<script>
export default {
    props: {
        destination: {
            required: false,
            default: null
        },
        text: {
            required: false,
            default: 'Indietro'
        },
        icon: {
            required: false,
            default: 'arrow-left'
        }
    },

    methods: {
        goTo() {
            this.destination ? window.location.href = this.destination : this.$router.go(-1);
        }
    }
}
</script>

<style>
    .btn {
        color: #00938c;
    }
</style>