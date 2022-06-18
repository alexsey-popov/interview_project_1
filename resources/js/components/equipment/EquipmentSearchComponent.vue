<template>
    <div class="card mb-5">
                    <div class="card-header">
                        Поиск оборудования
                    </div>

                    <div class="card-body">

                        <form @submit.prevent="search(equipment)">
                        <fieldset :disabled="loading">

                           <div class="container">
                               <div class="row">
                                   <div class="col-md-6 mb-3">
                                        <label for="EquipmentSearch_search" class="form-label">Поиск</label>
                                        <input v-model.trim="equipment.search" name="search" id="EquipmentSearch_search" class="form-control"  placeholder="По серийному номеру/примечанию">
                                   </div>
                                   <div class="col-md-6 mb-3">
                                        <label for="EquipmentSearch_id" class="form-label">Код оборудования</label>
                                        <input v-model.trim="equipment.id" name="id" id="EquipmentSearch_id" class="form-control" >
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-4 mb-3">
                                        <label for="EquipmentSearch_search_equipment_type" class="form-label">Тип оборудования</label>
                                        <input v-model.trim="equipment.search_equipment_type" name="search_equipment_type"  class="form-control" id="EquipmentSearch_search_equipment_type">
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="EquipmentSearch_search_serial_number" class="form-label">Серийные номера</label>
                                        <input v-model.trim="equipment.search_serial_number" name="search_serial_number" id="EquipmentSearch_search_serial_number" class="form-control" >
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="EquipmentSearch_search_notes" class="form-label">Примечание</label>
                                        <input v-model.trim="equipment.search_notes" name="search_notes" id="EquipmentSearch_search_notes" class="form-control" >
                                    </div>
                               </div>
                           </div>

                           <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Поиск</button>
                                <a @click="clear()" class="btn btn-secondary">Сбросить</a>
                           </div>

                        </fieldset>
                        </form>

                        <error :haveEror="error"></error>
                        <spiner :loading="loading"></spiner>
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
                loading: false,
                error: false,

                equipment: {
                    id: null,
                    search_equipment_type: null,
                    search_serial_number: null,
                    search_notes: null,
                    search: null,
                }

            }
        },
        mounted() {
             this.equipment = {
                 id: this.$route.query.id,
                 search_equipment_type: this.$route.query.search_equipment_type,
                 search_serial_number: this.$route.query.search_serial_number,
                 search_notes: this.$route.query.search_notes,
                 search: this.$route.query.search,
             }
        },
        methods: {
            search(data) {
                this.$router.replace({name : 'equipment', query: data}).catch(()=>{})
                this.$parent.load(data)
            },
            clear() {
                this.equipment = {}
                this.search(this.equipment)
            }
        }
    }
</script>
