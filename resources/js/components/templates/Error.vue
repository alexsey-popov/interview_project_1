<template>
    <div class="alert alert-danger" role="alert" v-if="haveEror">
        Произошла ошибка на стороне сервера
    </div>
</template>

<script>
    export default {
        props: {
            haveEror: {
                type: Boolean,
                default: false
            },
        },
    }
</script>
