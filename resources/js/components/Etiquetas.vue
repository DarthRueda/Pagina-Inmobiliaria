<template>
    <div class="etiquetas-div">Etiqueta</div>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'Etiquetas'
});
</script>

<style scoped>
.etiquetas-div {
    width: 86px;
    height: 31px;
    border-radius: 30px;
    background-color: #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 5px;
    margin-bottom: 5px;
}
</style>
