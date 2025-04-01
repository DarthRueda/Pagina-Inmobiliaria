<template>
    <img :src="fondo || '/images/placeholder-fondo.jpg'" alt="Inmobiliaria Image" class="inmobiliaria-image">
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'ImageInmobiliaria',
    props: {
        fondo: {
            type: String,
            required: false,
        },
    },
});
</script>

<style scoped>
.inmobiliaria-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
}
</style>