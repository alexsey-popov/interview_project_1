<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <router-link :to="{name: 'equipment'}" class="btn btn-link">Вернуться назад</router-link>
                    </div>

                    <div class="card-body">

                        <form @submit.prevent="addEquipment">
                        <fieldset :disabled="loading">
                            <legend>Добавление оборудования</legend>
                           
                           <div class="mb-3">
                               <label for="equipmentType" class="form-label">Тип оборудования</label>
                               <select v-model="equipment.equipmentType" class="form-select" id="equipmentType">
                                    <option disabled :value="null">Выберите тип оборудования</option>
                                    <option v-for="equipmentType in equipmentTypes" :key="equipmentType.id" :value="equipmentType.id">{{ equipmentType.name }}</option>
                                </select>
                           </div>
                            

                            <div class="mb-3">
                               <label for="serialNumbers" class="form-label">Серийные номера</label>
                               <textarea name="serialNumbers" id="serialNumbers" class="form-control" rows="10" v-model="equipment.serial_numbers" placeholder="Каждый серийный номер должен начинаться с новой строки."></textarea>
                            </div>

                            <div class="mb-3">
                               <label for="notes" class="form-label">Примечание</label>
                               <textarea name="notes" id="notes" class="form-control" rows="3" v-model="equipment.notes" placeholder="Необязательное поле"></textarea>
                            </div>

                             <button type="submit" class="btn btn-primary">Добавить</button>

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
                equipmentTypes: [],
                error: false,

                equipment: {
                    equipmentType: null,
                    serial_numbers: null,
                    notes: null,
                }

            }
        },
        mounted() {
            axios.get('/api/equipment-type/').then(response => {
                this.equipmentTypes = response.data.data;
            })
            .catch(error => {
                this.error = true
            })
            .finally(() => {
                this.loading = false
            })
        },
        methods: {
            
        },
    }
</script>
