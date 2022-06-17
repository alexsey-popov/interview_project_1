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
                            <td>{{ equipment.equipment_type_name }}</td>
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
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import EquipmentSearch from '../equipment/EquipmentSearchComponent.vue';
    export default {
 // components: { Spiner, ShowError },
        data() {
            return {
                loading: true,
                equipmentList: [],
                error: false,

            }
        },
        mounted() {
            this.load(this.$route.query)
        },
        methods: {
            load(queries) {
                axios.get('/api/equipment', { params: queries }).then(response => {
                    this.equipmentList = response.data.data;
                })
                    .catch(error => {
                        this.error = true
                    })
                    .finally(() => {
                        this.loading = false
                    })
            }
        }
    }
</script>
