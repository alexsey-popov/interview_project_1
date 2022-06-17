<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <router-link :to="{name: 'equipment'}" class="btn btn-link">Вернуться назад</router-link>
                    </div>

                    <div class="card-body">

                        <form @submit.prevent="submit">
                        <fieldset :disabled="loading">
                            <legend>{{equipment.equipment_type_name}}</legend>
                            <div class="mb-3">
                                <label for="serial_number" class="form-label">Серийный номер (маска {{ equipment.equipment_type_mask }}):</label>
                                <input v-model.trim="equipment.serial_number" type="text" id="serial_number" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="form-label">Примечание:</label>
                                <input v-model.trim="equipment.notes" type="text" id="notes" class="form-control">
                            </div>

                            <div class="row mb-0 mt-4">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                        </form>

                        <spiner :loading="loading"></spiner>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'equipmentId'
        ],
        data() {
            return {
                loading: true,
                equipment: {
                    id: null,
                    serial_number: null,
                    equipment_type_id: null,
                    equipment_type_name: null,
                    equipment_type_mask: null,
                    notes: null
                },
                error: {
                    haveEror: false,
                    message: ''
                },

            }
        },
        mounted() {
            axios.get('/api/equipment/'+this.equipmentId).then(response => {
                this.equipment = response.data.data;
            })
            .catch(error => {
                this.error.message = "Произошла ошибка на строне сервера"
                this.error.haveEror = true
            })
            .finally(() => {
                this.loading = false
            })
        },
        methods: {
            submit()
            {
                axios.put('/api/equipment/'+this.equipmentId, this.equipment)
                    .then(resp => {
                        this.$router.push({name: 'equipment-show', params: {equipmentId: this.equipmentId}})
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    }
</script>
