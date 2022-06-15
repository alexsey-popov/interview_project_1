<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Вход</div>

                <div class="card-body">
                    <form @submit.prevent="login">

                        <fieldset :disabled="loading">
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                                <div class="col-md-6">
                                    <input v-model="user.email" id="email" type="email" name="email" class="form-control" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>
                                <div class="col-md-6">
                                    <input v-model="user.password" id="password"  name="password" type="password" class="form-control" required autocomplete="current-password">
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
import EquipmentSearch from '../equipment/EquipmentSearchComponent.vue';
    export default {
 // components: { Spiner, ShowError },
        data() {
            return {
                loading: false,
                user: {
                    email:null,
                    password:null,
                    remember:false
                },
                errors: {
                    email: null,
                    password: null
                },

            }
        },
        mounted() {
            //console.log(window.Laravel.csrfToken)
        },
        methods: {
            login() {
                this.loading = true
                axios.post('/api/login', {email: this.user.email, password: this.user.password}).then(r => {
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + r.data;
                    localStorage.setItem( 'token', r.data );
                    this.$router.push('equipment')
                })
                    .catch(error => {
                        console.log(error.response);
                        this.errors = error.response.data.errors
                    })
                    .finally(() => {
                        this.loading = false
                    })

            }
        }
    }
</script>
