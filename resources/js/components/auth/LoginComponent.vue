<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Вход</div>

                <div class="card-body">
                    <form @submit.prevent="login">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                            <div class="col-md-6">
                                <input v-model="user.email" id="email" type="email" name="email" class="form-control" required autocomplete="email" autofocus>

                                <!--<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>-->
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

                            <div class="col-md-6">
                                <input v-model="user.password" id="password"  name="password" type="password" class="form-control" required autocomplete="current-password">

                                 <!--   <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>-->
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" :checked="user.remember">

                                    <label class="form-check-label" for="remember">
                                        Запомнить меня
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Войти
                                </button>

                                <!--@if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif-->
                            </div>
                        </div>
                    </form>
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
                loading: true,
                user: {
                    email:null,
                    password:null,
                    remember:false
                },
                error: false,

            }
        },
        methods: {
            login() {
                console.log(this.user)
            }
        }
    }
</script>
