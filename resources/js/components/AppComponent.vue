<template>
    <div class="container">
        <h1 class="mb-3 mt-3">Тестовое задание</h1>

        <ul class="nav nav-pills mb-5">
            <li v-if="isAuth()" class="nav-item active">
                <router-link :to="{name: 'equipment'}" class="nav-link">Оборудование</router-link>
            </li>
            <li v-if="isAuth()" class="nav-item">
                <router-link :to="{name: 'equipmentTypes'}" class="nav-link">Типы оборудования</router-link>
            </li>
            <li v-if="!isAuth()" class="nav-item">
                <router-link :to="{name: 'login'}" class="nav-link">Войти</router-link>
            </li>
            <li v-if="!isAuth()" class="nav-item">
                <router-link :to="{name: 'register'}" class="nav-link">Зарегистрироваться</router-link>
            </li>
            <li v-if="isAuth()" class="nav-item">
                <button @click="logout" class="nav-link text-danger">Выйти из профиля</button>
            </li>
        </ul>

    <div>
        <router-view></router-view>
    </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {

            }
        },
        methods: {
            logout() {
                if(confirm("Вы уверены, что хотите выйти из профиля?")){
                    axios.post('/api/logout/')
                        .then(resp => {
                            axios.defaults.headers.common['Authorization'] = 'Bearer ';
                            this.clearToken();
                            this.$router.push('login');
                        })
                        .catch(error => {
                            console.log(error);
                        })
                }
            }
        }
    }
</script>
