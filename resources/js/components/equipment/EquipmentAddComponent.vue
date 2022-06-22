<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <button v-if="show_report" @click="rollback" class="btn btn-link">Вернуться назад</button>
                        <router-link v-else :to="{name: 'equipment'}" class="btn btn-link">Вернуться назад</router-link>
                    </div>

                    <div v-if="!show_report" class="card-body">

                        <form @submit.prevent="submit">
                        <fieldset :disabled="loading">
                           <legend>Добавление оборудования</legend>

                           <div class="mb-3">
                               <label for="equipment_type" class="form-label">Тип оборудования</label>
                               <select
                                v-model="equipment.equipment_type_id"
                                class="form-select"
                                v-bind:class="{'is-invalid': $v.equipment.equipment_type_id.$error}"
                                id="equipment_type"
                                required>
                                    <option disabled :value="null">Выберите тип оборудования</option>
                                    <option v-for="equipment_type in equipment_types" :key="equipment_type.id" :value="equipment_type.id">{{ equipment_type.name }}</option>
                               </select>
                                <span class="invalid-feedback" role="alert">
                                    <p v-if="!$v.equipment.equipment_type_id.required" class="mb-0">Поле обязательно для заполнения</p>
                                    <p v-if="!$v.equipment.equipment_type_id.server" v-for="(value, key) in errors.equipment_type_id" :key="key" class="mb-0">{{ value }}</p>
                                </span>
                           </div>

                            <div class="mb-3">
                                <label for="serial_numbers" class="form-label">Серийные номера</label>
                                <textarea
                                    v-model="serial_numbers"
                                    name="serial_numbers"
                                    id="serial_numbers"
                                    class="form-control"
                                    v-bind:class="{'is-invalid': $v.equipment.serial_numbers.$error}"
                                    rows="10"
                                    placeholder="Перечислите серийные номера через запятую."
                                    required></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <span v-for="(arr, type) in errors" :key="type">
                                        <p
                                            v-for="(value, key) in arr"
                                            :key="key"
                                            class="mb-0"
                                            >{{ value }}</p>
                                    </span>
                                    <p v-if="!$v.equipment.serial_numbers.required" class="mb-0">Поле обязательно для заполнения</p>
                                </span>
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Примечание</label>
                                <textarea
                                    v-model="equipment.notes"
                                    name="notes"
                                    id="notes"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Необязательное поле"></textarea>
                            </div>

                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>

                        </fieldset>
                        </form>


                        <error :haveEror="errors.load"></error>
                        <spiner :loading="loading"></spiner>
                    </div>

                    <div v-if="show_report" class="card-body">
                        <h3>Отчёт о выполнении запроса</h3>

                        <div v-for="(report_item, report_index) in report" :key="report_index" class="card mb-3">
                            <div class="card-header">
                                <span>{{ report_item.item.serial_number }}</span>
                            </div>
                            <div class="card-body">
                                <h4 v-bind:class="{ 'text-danger': !report_item.created, 'text-success': report_item.created }" class="mb-2">
                                    {{ report_item.created ? 'Оборудование создано' : 'Ошибка при создании оборудования' }}
                                </h4>

                                <div v-if="!report_item.created" class="card-text">
                                    <div v-for="(messages, index_messages) in report_item.messages" :key="report_index+'_'+index_messages">
                                        <p v-for="(message, index_message) in messages" :key="report_index+'_'+index_messages+'_'+index_message">
                                            {{ message }}
                                        </p>
                                    </div>
                                </div>
                                <div v-else>
                                    <router-link :to="{ name: 'equipment-show', params: {equipmentId: report_item.item.id} }">
                                        Перейти на страницу оборудования
                                    </router-link>
                                </div>

                            </div>
                        </div>

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
                equipment_type_id: {
                    required,
                },
                serial_numbers: {
                    required,
                    server(value) {
                        return !this.has_errors
                    }
                },

            }
        },
        props: [
            'equipmentId'
        ],
        data() {
            return {
                loading: true,
                equipment_types: [],
                errors: {},
                has_errors: false,
                serial_numbers: [],

                report: [],
                show_report: false,

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
                this.errors.load = true
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
                this.has_errors = false
                this.errors = {}
                this.$v.$touch();
                if (this.$v.$invalid) {
                    return;
                }

                this.loading = true
                axios.post('/api/equipment', this.equipment).then(response => {
                    //this.$router.push({ name:'equipment' })
                    this.show_report = true
                    this.report = response.data
                })
                    .catch(error => {
                         // Обрабатываем валидацию с сервера
                        if(error.status = 422) {
                            this.errors = error.response.data.errors
                            this.has_errors = true;
                        } else {
                            console.log(error)
                        }
                    })
                    .finally(() => {
                        this.loading = false
                    })
            },
            rollback() {
                this.show_report = false
            },
        },
    }
</script>
