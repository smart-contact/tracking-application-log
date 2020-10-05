<template>
    <card>
        <template v-slot:body>
            <el-table
                :data="users"
                style="width: 100%">
                <el-table-column
                    prop="name"
                    label="Nome">
                </el-table-column>
                <el-table-column
                    prop="email"
                    label="Email">
                </el-table-column>
            </el-table>
        </template>
    </card>
</template>

<script>
    import Card from '../../components/Card'
    export default {
        name: 'log-preview',
        components: { Card },
        data() {
            return {
                users: [
                    {
                        'name': 'Andrea',
                        'email': 'a@a.it'
                    },
                    {
                        'name': 'Ortu',
                        'email': 'a@a.it'
                    },
                ]
            }
        }
        
    }
</script>
