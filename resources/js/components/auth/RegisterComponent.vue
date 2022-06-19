<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Регистрация</div>

                <div class="card-body">
                    <form @submit.prevent="register" novalidate>

                        <fieldset :disabled="loading">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>

                                <div class="col-md-6">
                                    <input 
                                        v-model.trim="user.name" 
                                        id="name" 
                                        name="name" 
                                        type="text" 
                                        class="form-control" 
                                        v-bind:class="{'is-invalid': $v.user.name.$error}" 
                                        required 
                                        autocomplete="name" 
                                        autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <p v-if="!$v.user.name.required" class="mb-0">Поле обязательно для заполнения</p>
                                        <p v-if="!$v.user.name.server" v-for="(value, key) in errors.name" :key="key" class="mb-0">{{ value }}</p>
                                    </span>
                                </div>
                            </div>

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
                                        autocomplete="email">
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
                                        autocomplete="new-password">
                                    <span class="invalid-feedback" role="alert">
                                        <p v-if="!$v.user.password.required" class="mb-0">Поле обязательно для заполнения</p>
                                        <p v-if="!$v.user.password.sameAs" class="mb-0">Пароли не совпадают</p>
                                        <p v-if="!$v.user.password.server" v-for="(value, key) in errors.password" :key="key" class="mb-0">{{ value }}</p>
                                    </span>    
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Подтверждение пароля</label>

                                <div class="col-md-6">
                                    <input 
                                        v-model.trim="user.password_confirmation" 
                                        id="password-confirm" 
                                        name="password_confirmation" 
                                        type="password" 
                                        class="form-control" 
                                        v-bind:class="{'is-invalid': $v.user.password_confirmation.$error}" 
                                        required 
                                        autocomplete="new-password">
                                    <span class="invalid-feedback" role="alert">
                                        <p v-if="!$v.user.password_confirmation.required" class="mb-0">Поле обязательно для заполнения</p>
                                        <p v-if="!$v.user.password.sameAs" class="mb-0">Пароли не совпадают</p>
                                        <p v-if="!$v.user.password_confirmation.server" v-for="(value, key) in errors.password_confirmation" :key="key" class="mb-0">{{ value }}</p>
                                    </span>   
                                </div>
                            </div>

                            <div class="row mb-0 mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Зарегистрироваться
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
const { required, email, sameAs } = require('vuelidate/lib/validators')
    export default {
        mixins: [validationMixin],
        validations: {
            user: {
                name: {
                    required,
                    server(value) {
                        return !this.errors.hasOwnProperty('name')
                    }
                },
                email: {
                    required,
                    email,
                    server(value) {
                        return !this.errors.hasOwnProperty('email')
                    }
                },
                password:{
                    required,
                    sameAs: sameAs('password_confirmation'),
                    server(value) {
                        return !this.errors.hasOwnProperty('password')
                    }
                },
                password_confirmation:{
                    required,
                    server(value) {
                        return !this.errors.hasOwnProperty('password_confirmation')
                    }
                },
            },
        },
        data() {
            return {
                loading: false,
                user: {
                    name: null,
                    email:null,
                    password:null,
                    password_confirmation: null,
                },
                errors: {},

            }
        },
        methods: {
            register() {
                this.errors = {}
                this.$v.$touch();
                if (this.$v.$invalid) {
                    return;
                }

                this.loading = true
                axios.post('/api/register', this.user).then(r => {
                     this.$router.push('login')
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
