<template>
  <div class="options-box">
    <div class="option">
      <a href="#" @click.prevent="router.push('misPropiedades')">
        <img src="/images/panelusuario/casa.svg" alt="icon" width="27" height="27">
        <span>Mis propiedades</span>
      </a>
    </div>
    <div class="option">
      <a href="/favoritos">
        <img src="/images/panelusuario/corazon.svg" alt="icon" width="27" height="27">
        <span>Favoritos</span>
      </a>
    </div>
    <div class="option">
      <a href="#" @click.prevent="router.push('panelUsuario')">
        <img src="/images/panelusuario/usuario.svg" alt="icon" width="27" height="27">
        <span>Mis datos</span>
      </a>
    </div>
    <div class="option">
      <a href="#">
        <img src="/images/panelusuario/papelera.svg" alt="icon" width="27" height="27">
        <span>Eliminar Cuenta</span>
      </a>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
const router = useRouter();


</script>

<style scoped>
.options-box {
  border: 1px solid #ccc;
  padding: 10px;
}
.option {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}
.option img {
  margin-right: 10px;
}
</style>
