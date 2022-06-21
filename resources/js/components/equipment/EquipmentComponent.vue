<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <equipment-search></equipment-search>

                <div class="card">
                    <div class="card-header">
                        Список оборудования
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <router-link :to="{name: 'equipment-add'}" class="btn btn-primary">Добавить оборудование</router-link>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Тип оборудования</th>
                                <th scope="col">Серийный номер</th>
                                <th scope="col">Примечание</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="equipment in equipmentList" :key="equipment.id">
                                    <td>{{ equipment.equipment_type.name }}</td>
                                    <td><router-link :to="{name: 'equipment-show', params: {equipmentId: equipment.id}}">{{ equipment.serial_number }}</router-link></td>
                                    <td>{{ equipment.notes }}</td>
                                </tr>
                                <tr v-if="!equipmentList.length && !loading">
                                    <td colspan="3" class="pt-3 text-center">
                                        <h3>Список пуст</h3>
                                    </td>
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
import EquipmentSearch from '../equipment/EquipmentSearchComponent.vue';
import { BPagination } from 'bootstrap-vue'
    export default {
        components: {
            'equipment-search': EquipmentSearch,
            'b-pagination': BPagination
        },
        data() {
            return {
                loading: true,
                equipmentList: [],
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
                this.queries = queries;
                axios.get('/api/equipment', { params: queries }).then(response => {
                    this.$router.replace({name : 'equipment', query: queries}).catch(()=>{})
                    this.equipmentList = response.data.data;
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
