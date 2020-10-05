<template>
  <div class="card">
    <div id="header">
        <slot name="header" class="uppercase">
            {{ title }}
        </slot>
    </div>
    <div id="body">
        <slot name="body" style="width: 100%"></slot>
    </div>
      
  </div>
</template>

<script>
export default {
    name: "card",
    computed: {
        title() {
            let completePath = this.$route.path;
            let name = completePath.split("/");
            
            return name[name.length - 1].toUpperCase();
        }
    }
}
</script>

<style scoped>
    #header {
        background-color: white;
        padding: .75rem 1.25rem;
        font-size: 1.2rem;
    }
    #body {
        background-color: #f1f7fa;
    }
    .card {
        box-shadow: 0 2px 3px #cdd8df;
        border: none;
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }
</style>