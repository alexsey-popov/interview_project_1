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
                           <legend>Добавление оборудования</legend>

                           <div class="mb-3">
                               <label for="equipment_type" class="form-label">Тип оборудования</label>
                               <select v-model="equipment.equipment_type_id" class="form-select" id="equipment_type" required>
                                    <option disabled :value="null">Выберите тип оборудования</option>
                                    <option v-for="equipment_type in equipment_types" :key="equipment_type.id" :value="equipment_type.id">{{ equipment_type.name }}</option>
                               </select>
                           </div>

                            <div class="mb-3">
                               <label for="serial_numbers" class="form-label">Серийные номера</label>
                               <textarea v-model="serial_numbers" name="serial_numbers" id="serial_numbers" class="form-control" rows="10" placeholder="Перечислите серийные номера через запятую." required></textarea>
                            </div>

                            <div class="mb-3">
                               <label for="notes" class="form-label">Примечание</label>
                               <textarea name="notes" id="notes" class="form-control" rows="3" v-model="equipment.notes" placeholder="Необязательное поле"></textarea>
                            </div>

                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>

                        </fieldset>
                        </form>


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
        props: [
            'equipmentId'
        ],
        data() {
            return {
                loading: true,
                equipment_types: [],
                error: false,
                serial_numbers: [],

                equipment: {
                    equipment_type_id: null,
                    serial_numbers: null,
                    notes: null,
                }

            }
        },
        mounted() {
            axios.get('/api/equipment-type/').then(response => {
                this.equipment_types = response.data.data;
            })
            .catch(error => {
                this.error = true
            })
            .finally(() => {
                this.loading = false
            })
        },
        watch: {
            serial_numbers: function () {
                this.equipment.serial_numbers = this.serial_numbers.split(',')
                    .map(element => element.trim())
                    .filter(element => element !== '');
            }
        },
        methods: {
            submit() {
                this.loading = true
                axios.post('/api/equipment', this.equipment).then(response => {
                    this.$router.push({ name:'equipment' })
                })
                    .catch(error => {
                        this.error = true
                    })
                    .finally(() => {
                        this.loading = false
                    })
            }
        },
    }
</script>
