<template>
    <div>
        <div>
            <card>
                <template v-slot:header>
                    <div>
                        <form class="w-full max-w-sm flex">
                            <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700border-4 text-white py-1 px-2 rounded mr-4 export" @click="retrieveLogs">
                                <font-awesome-icon icon="undo-alt"/>
                            </button>
                        </form>
                    </div>
                </template>
                <template v-slot:body>
                    <div v-if="loading" style="height: 150px">
                        <loading></loading>
                    </div>
                    <div v-if="! loading && logs.data && ! error" style="overflow-x: scroll">
                        <table class="border w-full">
                            <thead>
                                <tr>
                                    <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">Stato</th>
                                    <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">Risorsa</th>
                                    <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">Log</th>
                                    <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">Creato Il</th>
                                    <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr 
                                    v-for="(log, index) in logs.data"
                                    :key="index"
                                    class="border-b border-gray-300 hover:bg-blue-100 bg-white"
                                >
                                    <td class="py-4 px-6"><badge :type="log.status"></badge></td>
                                    <td class="py-4 px-6">{{ log.model }}</td>
                                    <td class="py-4 px-6">{{ log.log ? log.log : '-' }}</td>
                                    <td class="py-4 px-6">{{ log.created_at }}</td>
                                    <td class="py-4 px-6">
                                        <form :action="'/' + log.url" v-if="log.url">
                                            <button type="submit">
                                                <sc-icon icon="download"/>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="flex align-middle w-full">
                            <span class="pagination-info">{{ logs.total }} Elementi - Pagina {{ logs.current_page }} di {{ logs.last_page }} totali.</span>
                            <t-pagination
                                class="pagination"
                                :total-items="logs.total"
                                :per-page="logs.per_page"
                                v-model="logs.current_page"
                                @change="retrieveLogs"
                            />
                        </div>
                        
                    </div>
                    
                    <div v-if="! loading && ! logs.data.length && ! error">
                        <data-not-found></data-not-found>
                    </div>
                    <div v-if="error">
                        error
                    </div>
                </template>
            </card>
        </div>
    </div>
    
</template>

<script>
    export default {
        name: 'log-preview',
        data() {
            return {
                logs: {
                    data: []
                },
                loading: true,
                error: false,
                totalRows: 20,
                perPage: 5,
                limit: 4,
                currentPage: 1,
                search: '',
                currentSearch: '',
                path: {
                    exportLogs: {
                        retrieve: '/export-logs?page={page}&q={q}',
                    }
                }
            }
        },
        mounted() {
            this.sleep(5000).then(() => {
                this.retrieveLogs()
            });
            
        },
        computed: {
            searchIcon() {
                return this.loading ? 'spinner' : 'search';
            }
        },
        
        methods: {
            triggerDrawer() {
                this.open = ! this.open;
            },
            retrieveLogs(page = 1) {
                
                let path = this.path.exportLogs.retrieve
                    .replace('{page}', page)
                    .replace('{q}', this.search);
                this.loading = true;
                this.currentSearch = this.search;
                this.$http.get(path)
                    .then(({data}) => {
                        this.logs = data;
                    })
                    .catch(() => {
                       this.error = true; 
                    })
                    .finally(() => {
                        this.loading = false;
                    })  
            },
            sleep(time) {
                return new Promise((resolve) => setTimeout(resolve, time));
            }
        },
    }
</script>

<style scoped>
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
    .search, .export {
        font-size: 1rem;
        line-height: 1rem;
    }

    .currentSearch {
        font-size: .7rem;
        text-align: right;
    }
</style>
