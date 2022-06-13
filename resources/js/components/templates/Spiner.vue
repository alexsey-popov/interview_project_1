<template>
    <div class="d-flex justify-content-center absolute-center" v-if="loading">
        <div class="spinner-grow" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                
            }
        },
        props: {
            loading: {
                type: Boolean,
                default: true
            }
        },
    }
</script>
