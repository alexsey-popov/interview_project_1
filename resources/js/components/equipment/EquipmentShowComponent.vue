<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <router-link :to="{name: 'equipment'}" class="btn btn-link">Вернуться назад</router-link>
                    </div>

                    <div class="card-body">

                        <form>
                        <fieldset disabled>
                            <legend>{{equipment.equipment_type_name}}</legend>
                            <div class="mb-3">
                                <label for="serial_number" class="form-label">Серийный номер:</label>
                                <input type="text" id="serial_number" class="form-control" :value="equipment.serial_number">
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="form-label">Примечание:</label>
                                <input type="text" id="notes" class="form-control">
                            </div>
                        </fieldset>
                        </form>

                        <ul class="nav nav-pills nav-fill">
                          <li class="nav-item">
                              <router-link :to="{name: 'equipment-edit', params: {equipmentId: equipment.id}}">Редактировать</router-link>
                          </li>
                          <li class="nav-item">
                            <a @click="deleteEquipment(equipment.id)" class="btn btn-link text-danger">Удалить</a>
                          </li>
                        </ul>

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
                equipment: [],
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
            deleteEquipment(equipmentId)
            {
                if(confirm("Вы уверены, что хотите выйти из профиля?")){
                    axios.post('/equipment/'+equipmentId, {_method: 'DELETE'})
                        .then(resp => {
                            this.$router.push('/equipment')
                        })
                        .catch(error => {
                            console.log(error);
                        })
                }
            }
        }
    }
</script>
