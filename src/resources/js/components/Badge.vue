<template>
    <span class="inline-block px-2 py-0 rounded-full text-xs font-semibold tracking-wider leading-relaxed uppercase" :class="color">
        {{ type | translate }}
    </span>
</template>

<script>
export default {
    props: {
        type: {
            required: false
        }
    },
    computed: {
        color() {
            switch(this.type) {
                case 'error': return 'bg-red-100 text-red-800'; break;
                case 'started':  return 'bg-orange-100 text-orange-800'; break;
                case 'info': return 'bg-blue-100 text-blue-800'; break;
                default: return 'bg-green-100 text-green-800';
            }
        }
    },
    filters: {
        translate(value) {
            switch(value) {
                case 'error': return 'Errore'; break;
                case 'started': return 'In Corso'; break;
                case 'completed': return 'Completato'; break;
                default: return value;
            }
        }
    }
}
</script>

<style>

</style>