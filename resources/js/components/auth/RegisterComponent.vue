<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Регистрация</div>

                <div class="card-body">
                    <form @submit.prevent="register">

                        <fieldset :disabled="loading">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>

                                <div class="col-md-6">
                                    <input v-model="user.name" id="name" name="name" type="text" class="form-control" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input v-model="user.email" id="email" type="email" class="form-control" name="email" required autocomplete="email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

                                <div class="col-md-6">
                                    <input v-model="user.password" id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Подтверждение пароля</label>

                                <div class="col-md-6">
                                    <input v-model="user.password_confirmation" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
import EquipmentSearch from '../equipment/EquipmentSearchComponent.vue';
    export default {
 // components: { Spiner, ShowError },
        data() {
            return {
                loading: false,
                user: {
                    name: null,
                    email:null,
                    password:null,
                    password_confirmation: null,
                },
                error: false,

            }
        },
        methods: {
            register() {
                this.loading = true
                axios.post('/api/register', {name: this.user.name, email: this.user.email, password: this.user.password}).then(r => {
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + r.data;
                    localStorage.setItem( 'token', r.data );
                })
                    .catch(error => {
                        console.log(error.response.data.errors);
                        this.errors = error.response.data.errors
                    })
                    .finally(() => {
                        this.loading = false
                    })
            }
        }
    }
</script>
