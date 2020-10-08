<template>
    <lottie
        class="loading"
        :options="loading"
        :height="60"/>
</template>

<script>
    import Loading from '../lottie/cardDashboardLoading'
    import Lottie from 'vue-lottie'
    export default {
        name: "DashboardLoading",
        components: {
            Lottie
        },
        data() {
            return {
                loading: { animationData: Loading, loop: true },
            }
        }
    }
</script>

<style scoped>
    .loading {
        position: absolute;
        opacity: 0.8;
        width: 100%;
        height:  100px;
    }
</style>