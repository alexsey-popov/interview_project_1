<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Вход</div>

                <div class="card-body">
                    <form @submit.prevent="login" novalidate>

                        <fieldset :disabled="loading">

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input  
                                        v-model.trim="user.email" 
                                        id="email" 
                                        name="email" 
                                        type="email" 
                                        class="form-control" 
                                        v-bind:class="{'is-invalid': $v.user.email.$error}" 
                                        required 
                                        autocomplete="email" 
                                        autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <p v-if="!$v.user.email.required" class="mb-0">Поле обязательно для заполнения</p>
                                        <p v-if="!$v.user.email.email" class="mb-0">Некорректный email</p>
                                        <p v-if="!$v.user.email.server" v-for="(value, key) in errors.email" :key="key" class="mb-0">{{ value }}</p>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>
                                <div class="col-md-6">
                                    <input 
                                        v-model.trim="user.password" 
                                        id="password"  
                                        name="password" 
                                        type="password" 
                                        class="form-control" 
                                        v-bind:class="{'is-invalid': $v.user.password.$error}" 
                                        required 
                                        autocomplete="current-password">
                                    <span class="invalid-feedback" role="alert">
                                        <p v-if="!$v.user.password.required" class="mb-0">Поле обязательно для заполнения</p>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-0 mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Войти
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
const { required, email } = require('vuelidate/lib/validators')
    export default {
        mixins: [validationMixin],
        validations: {
            user: {
                email: {
                    required,
                    email,
                    server(value) {
                        return !this.errors.hasOwnProperty('email')
                    }
                },
                password:{
                    required
                },
            },
        },
        data() {
            return {
                loading: false,
                user: {
                    email:null,
                    password:null,
                },
                errors: {},
            }
        },
        mounted() {

        },
        methods: {
            login() {
                this.errors = {}
                this.$v.$touch();
                if (this.$v.$invalid) {
                    return;
                }

                this.loading = true
                axios.post('/api/login', {email: this.user.email, password: this.user.password}).then(r => {
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + r.data;
                    localStorage.setItem( 'token', r.data );
                    this.$router.push('equipment')
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
