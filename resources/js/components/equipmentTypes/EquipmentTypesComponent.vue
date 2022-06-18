<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card">
                    <div class="card-header">Список типов оборудования</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Тип оборудования</th>
                                <th scope="col">Маска серийного номера</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="equipmentType in equipmentTypes" :key="equipmentType.id">
                                    <td><router-link :to="{name: 'equipment', query: { search_equipment_type: equipmentType.name }}">{{ equipmentType.name }}</router-link></td>
                                    <td>{{ equipmentType.mask }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <error :haveEror="error"></error>
                        <spiner :loading="loading"></spiner>
                        <b-pagination
                            v-if="pagination.last_page != 1"
                            v-model="pagination.current_page"
                            :total-rows="pagination.total"
                            :per-page="pagination.per_page"
                            @change="paginate"
                            align="center"
                            class="mt-4"
                        ></b-pagination>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import { BPagination } from 'bootstrap-vue'
    export default {
        components: { 
            'b-pagination': BPagination
        },
        data() {
            return {
                loading: true,
                equipmentTypes: [],
                error: false,
                queries: {},
                pagination: {
                    current_page: 1,
                    total: 0,
                    per_page: 0,
                    last_page: 1
                },

            }
        },
        mounted() {
            this.queries = Object.assign({}, this.$route.query);
            this.load(this.queries)
        },
        methods: {
            load(queries) {
                axios.get('/api/equipment-type', { params: queries }).then(response => {
                    this.equipmentTypes = response.data.data;
                    this.pagination = response.data.meta;
                })
                .catch(error => {
                    this.error = true
                })
                .finally(() => {
                    this.loading = false
                })
            },
            paginate(page) {
                this.queries.page = page;
                this.load(this.queries)
            }
        }
    }
</script>
