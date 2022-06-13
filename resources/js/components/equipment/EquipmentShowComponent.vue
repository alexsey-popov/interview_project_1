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
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Much longer nav link</a>
  </li>
</ul>
                       
                       

                        <div class="alert alert-danger" role="alert" v-if="error.haveEror">
                        {{error.message}}
                        </div>

                        <div class="d-flex justify-content-center" v-if="loading">
                            <div class="spinner-grow" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
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
    }
</script>
