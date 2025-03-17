<!-- <template>
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
      <a href="#" @click.prevent="deleteUser(profile.id)">
        <img src="/images/panelusuario/papelera.svg" alt="icon" width="27" height="27">
        <span>Eliminar Cuenta</span>
      </a>
    </div>
  </div>

  <div>
    <h3>Datos del perfil:</h3>
    <pre>{{ JSON.stringify(profile.id, null, 2) }}</pre>
  </div>
</template>

<script setup>
import {onMounted} from "vue";
import { useRouter } from 'vue-router';
import useUsers from "@/composables/users";
import useProfile from "@/composables/profile";

const router = useRouter();
const { deleteUser } = useUsers();


onMounted(() => {
    getProfile();
});



import { reactive, watchEffect } from "vue";

// Use profile composable
const { profile: profileData, getProfile, } = useProfile();

// Reactive profile data
const profile = reactive({
  
});

// Store original profile data for canceling edits
const originalProfile = reactive({
    id: "",
});

// Watch for changes in profile data
watchEffect(() => {

    profile.id = profileData.value.id

    originalProfile.id = profileData.value.id;
});





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
</style> -->

<template>
  <div class="options-box">
    <div class="option">
      <a href="#" @click.prevent="router.push('misPropiedades')">
        <img src="/images/panelusuario/casa.svg" alt="icon" width="27" height="27" />
        <span>Mis propiedades</span>
      </a>
    </div>
    <div class="option">
      <a href="/favoritos">
        <img src="/images/panelusuario/corazon.svg" alt="icon" width="27" height="27" />
        <span>Favoritos</span>
      </a>
    </div>
    <div class="option">
      <a href="#" @click.prevent="router.push('panelUsuario')">
        <img src="/images/panelusuario/usuario.svg" alt="icon" width="27" height="27" />
        <span>Mis datos</span>
      </a>
    </div>
    <!-- Mostramos el botón de eliminar solo si tenemos un id en el perfil -->
    <div class="option" v-if="profileId">
      <a href="#" @click.prevent="handleDeleteUser(profileId)">
        <img src="/images/panelusuario/papelera.svg" alt="icon" width="27" height="27" />
        <span>Eliminar Cuenta</span>
      </a>
    </div>
  </div>

  <!-- Bloque para depuración: muestra el perfil completo -->
  <div v-if="profile">
    <h3>Datos del perfil:</h3>
    <pre>{{ profile }}</pre>
  </div>
</template>

<script setup>
import { onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';
import useUsers from '@/composables/users';
import useProfile from '@/composables/profile';

const router = useRouter();
const { getUser,deleteAccount } = useUsers();
const { profile, getProfile } = useProfile();

// Creamos una propiedad computada que extrae el id del perfil cuando esté disponible.
const profileId = computed(() => {
  return profile.value && profile.value.id ? profile.value.id : null;
});

onMounted(() => {
  getProfile();
  getUser();
});

const handleDeleteUser = (id) => {
  getUser(id).then(() => {
    deleteAccount(id);
  }).catch(error => {
    console.error("Error fetching user:", error);
  });
};

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
