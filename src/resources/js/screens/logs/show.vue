<template>
    <div>
        <go-back></go-back>
        <card>
            <template v-slot:body>
                <div v-if="! loading" class="p-4">
                    <p>Email: {{ log.email }}</p>
                    <p>Descrizione: {{ log.description}}</p>
                    <p>Risorsa: {{ log.subject }}</p>
                    <p>Livello: {{ log.level }}</p>
                    <p>User Agent: {{ log.user_agent}}</p>
                    <p>Browser: {{ log.browser }}</p>
                    <p>Versione Browser: {{ log.browser_version }}</p>
                    <p>Piattaforma: {{ log.platform }}</p>
                    <p>Versione Piattaforma: {{ log.platform_version }}</p>
                    <p>Ip: {{ log.ip }}</p>
                    <p>Creato Il: {{ log.created_at }}</p>
                </div>
            </template>
        </card>
    </div>
</template>

<script>
    export default {
        name: 'log-show',
        data() {
            return {
                loading: true,
                error: false,
                id: 0,
                log: {},
                path: {
                    retrieve: {
                        log: '/logs/{id}'
                    }
                }
            }
        },
        mounted() {
            this.setId();
            this.retrieveLogs();
        },
        methods: {
            setId() {
                this.id = this.$route.params.id;
            },
            retrieveLogs() {
                let path = this.path.retrieve.log.replace('{id}', this.id);
                this.$http.get(path)
                    .then(({data}) => {
                        this.log = data;
                        this.loading = false;
                    })
                    .catch(() => {
                       this.error = true; 
                    })
                    .finally(() => {
                        this.loading = false;
                    })  
            }
        }
        
    }
</script>

<style scoped lang="scss">
    .pagination {
        margin-top: .5rem;
        margin-bottom: .5rem;
        margin-left: auto;
        margin-right: 1rem;
        
    }
    .pagination-info {
        margin-top: .5rem;
        margin-bottom: .5rem;
        margin-left: 1rem;
    }
</style>
