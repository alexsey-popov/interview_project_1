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
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: true,
                equipmentTypes: [],
                error: false,

            }
        },
        mounted() {
            axios.get('/api/equipment-type').then(response => {
                console.log(response);
                this.equipmentTypes = response.data.data;
            })
            .catch(error => {
                this.error = true
            })
            .finally(() => {
                this.loading = false
            })
        }
    }
</script>
