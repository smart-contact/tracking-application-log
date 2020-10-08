<template>
  <font-awesome-icon :icon="icon" class="icon"/>
</template>

<script>
export default {
    props: {
        icon: {
            required: true
        }
    }
}
</script>

<style scoped>
    .icon {
        color: #c3cbd3;
        cursor: pointer
    }

    .icon:hover {
        color: #00938c;
    }
</style>xO