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
                            <legend>{{equipment.equipment_type.name}}</legend>
                            <div class="mb-3">
                                <label for="serial_number" class="form-label">Серийный номер (маска {{ equipment.equipment_type.mask }}):</label>
                                <input
                                    v-model.trim="equipment.serial_number"
                                    id="serial_number"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{'is-invalid': $v.equipment.serial_number.$error}">
                                <span class="invalid-feedback" role="alert">
                                    <p v-if="!$v.equipment.serial_number.required" class="mb-0">Поле обязательно для заполнения</p>
                                    <p v-if="!$v.equipment.serial_number.server" v-for="(value, key) in errors.serial_number" :key="key" class="mb-0">{{ value }}</p>
                                </span>
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="form-label">Примечание:</label>
                                <input
                                    v-model.trim="equipment.notes"
                                    id="notes"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{'is-invalid': $v.equipment.notes.$error}">
                                <span class="invalid-feedback" role="alert">
                                    <p v-if="!$v.equipment.notes.server" v-for="(value, key) in errors.notes" :key="key" class="mb-0">{{ value }}</p>
                                </span>
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
import { validationMixin } from 'vuelidate'
const { required } = require('vuelidate/lib/validators')
    export default {
        mixins: [validationMixin],
        validations: {
            equipment: {
                serial_number: {
                    required,
                    server(value) {
                        return !this.errors.hasOwnProperty('serial_number')
                    }
                },
                notes: {
                    server(value) {
                        return !this.errors.hasOwnProperty('notes')
                    }
                },
            },
        },
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
                    equipment_type: {
                        id: null,
                        name: null,
                        mask: null
                    },
                    notes: null
                },
                errors: {},

            }
        },
        mounted() {
            axios.get('/api/equipment/'+this.equipmentId).then(response => {
                this.equipment = response.data.data;
            })
            .catch(error => {
                this.errors.submit = true
            })
            .finally(() => {
                this.loading = false
            })
        },
        methods: {
            submit()
            {
                this.errors = {}
                this.$v.$touch();
                if (this.$v.$invalid) {
                    return;
                }

                this.loading = true;
                axios.put('/api/equipment/'+this.equipmentId, this.equipment)
                    .then(resp => {
                        this.$router.push({name: 'equipment-show', params: {equipmentId: this.equipmentId}})
                    })
                    .catch(error => {
                        // Обрабатываем валидацию с сервера
                        if(error.status = 422) {
                            this.errors = error.response.data.errors
                        } else {
                            console.log(error)
                        }
                    })
                    .finally(() => {
                        this.loading = false
                    })
            }
        }
    }
</script>
