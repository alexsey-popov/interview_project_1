<template>
    <div class="container">
        <h1 class="mb-3 mt-3">Тестовое задание</h1>
             
        <ul class="nav nav-pills mb-3">
            <li class="nav-item active">
                <router-link :to="{name: 'equipment'}" class="nav-link">Оборудование</router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{name: 'equipmentTypes'}" class="nav-link">Типы оборудования</router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{name: 'login'}" class="nav-link">Войти</router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{name: 'register'}" class="nav-link">Зарегистрироваться</router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{name: 'logout'}" class="nav-link">Выйти</router-link>
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
        mounted() {
            
        }
    }
</script>
