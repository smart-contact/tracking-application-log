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
                            <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700border-4 text-white py-1 px-2 rounded mr-4 export" @click="exportData">
                                <font-awesome-icon icon="download"/>&nbsp;Export
                            </button>
                            <div class="flex items-center border-b border-teal-500 search">
                                <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" v-model="search" placeholder="Ricerca Email" aria-label="email" @keyup.enter="retrieveLogs">
                                <button :disabled="loading" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700border-4 text-white py-1 px-2 rounded" type="button" @click="retrieveLogs">
                                    <font-awesome-icon :icon="searchIcon"/>&nbsp;
                                    Cerca
                                </button>
                            </div>
                        </form>
                        <p v-if="currentSearch" class="mt-4 currentSearch"><span class="text-gray-500">Rircerca attuale: </span> <span class="ml-2 bg-gray-200 font-mono px-3 py-1 rounded text-gray-900">{{ currentSearch }} </span></p>
                    </div>
                </template>
                <template v-slot:body>
                    <div v-if="loading" style="height:100px">
                        <loading></loading>
                    </div>
                    <div v-if="! loading && logs.data && ! error">
                        <table class="border w-full">
                            <thead>
                                <tr>
                                    <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">Email</th>
                                    <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">Risorsa</th>
                                    <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">Descrizione</th>
                                    <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">Livello</th>
                                    <th class="py-4 px-6 bg-gray-200 font-bold uppercase text-sm text-left text-gray-800">Ip</th>
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
                                    <td class="py-4 px-6">{{ log.email }}</td>
                                    <td class="py-4 px-6">{{ log.subject }}</td>
                                    <td class="py-4 px-6">{{ log.description }}</td>
                                    <td class="py-4 px-6"><badge :type="log.level"></badge></td>
                                    <td class="py-4 px-6">{{ log.ip }}</td>
                                    <td class="py-4 px-6">{{ log.created_at }}</td>
                                    <td class="py-4 px-6" @click="triggerDrawer()">
                                        <router-link :to="{ name: 'logs-show', params: { id: log.id }}" exact><sc-icon icon="eye"/></router-link>
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
                open: false,
                loading: true,
                error: false,
                totalRows: 20,
                perPage: 5,
                limit: 4,
                currentPage: 1,
                search: '',
                currentSearch: '',
                path: {
                    logs: {
                        retrieve: '/logs?page={page}&q={q}',
                        export: '/logs/download'
                    }
                }
            }
        },
        mounted() {
            this.retrieveLogs();
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
                
                let path = this.path.logs.retrieve
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
            exportData() {
                this.$http.get(this.path.logs.export)
                    .then(() => {
                        this.$router.push({name: 'export-logs'});
                    })
            }
        },
        watch: {
            search(value) {
                if(value == '') {
                    this.retrieveLogs();
                }
            }
        }
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
