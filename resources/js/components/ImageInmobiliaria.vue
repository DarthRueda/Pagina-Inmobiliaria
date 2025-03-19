<template>
    <img src="/images/inmobiliarias/test-inmueble.jpg" alt="Inmobiliaria Image" class="inmobiliaria-image">
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'ImageInmobiliaria'
});
</script>

<style scoped>
.inmobiliaria-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
}
</style>
