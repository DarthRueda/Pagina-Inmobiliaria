<template>
  <div class="options-box">
    <div class="option">
      <a href="/panelUsuario" :class="{ 'active': isActive('/panelUsuario') }">
        <svg width="27" height="27">
          <path d="M11.733 2.25c2.983 0 5.226 2.407 5.223 5.732a7.803 7.803 0 0 1-2.028 6.044c-.23.253-.163 2.019.082 2.11l2.383.882.598.23c.471.183.877.35 1.245.51l.217.095c1.52.682 2.45 1.315 2.914 2.113a.75.75 0 0 1-1.24.838l-.057-.084c-.242-.417-.885-.871-1.988-1.387l-.243-.11a32.965 32.965 0 0 0-1.679-.688l-.813-.307-1.859-.686c-1.413-.524-1.528-3.58-.666-4.53 1.218-1.32 1.815-3.097 1.637-4.957 0-2.593-1.596-4.305-3.726-4.305s-3.726 1.712-3.73 4.373a6.31 6.31 0 0 0 1.645 4.89c.859.945.743 4-.67 4.525l-2.042.755-.916.35c-.547.213-1 .4-1.4.58-1.04.468-1.71.882-2.06 1.275a.75.75 0 1 1-1.12-.996c.523-.59 1.347-1.1 2.564-1.647.355-.16.742-.322 1.19-.5l1.042-.401 2.22-.823c.245-.09.312-1.856.086-2.105C7.034 12.39 6.296 10.19 6.507 8.05c0-3.395 2.244-5.801 5.226-5.801z"></path>
        </svg>
        <span>Mis datos</span>
      </a>
    </div>
    <div class="option">
      <a href="/misPropiedades" :class="{ 'active': isActive('/misPropiedades') }">
        <svg width="27" height="27" fill="black">
          <path d="M20.254 13.173a.75.75 0 0 1 .743.648l.007.102v8.25a.75.75 0 0 1-.648.743l-.102.007h-6a.75.75 0 0 1-.743-.648l-.007-.102v-6a.75.75 0 0 0-.648-.743l-.102-.007h-1.5a.75.75 0 0 0-.743.648l-.007.102v6a.75.75 0 0 1-.648.743l-.102.007h-6a.75.75 0 0 1-.743-.648l-.007-.102v-8.25a.75.75 0 0 1 1.493-.102l.007.102v7.5h4.5v-5.25a2.25 2.25 0 0 1 2.096-2.245l.154-.005h1.5a2.25 2.25 0 0 1 2.245 2.096l.005.154v5.25h4.5v-7.5a.75.75 0 0 1 .648-.743l.102-.007z"></path>
          <path d="M10.414 1.704a2.25 2.25 0 0 1 3.052-.12l.13.12 10.188 10.189a.75.75 0 0 1-.976 1.133l-.084-.073-10.19-10.189a.75.75 0 0 0-.976-.072l-.084.072-10.19 10.19a.75.75 0 0 1-1.133-.977l.073-.084 10.19-10.19z"></path>
          <path d="M20.254 3.423a.75.75 0 0 1 .743.648l.007.102v5.25a.75.75 0 0 1-1.493.102l-.007-.102v-4.5h-2.25v.75a.75.75 0 0 1-.648.743l-.102.007a.75.75 0 0 1-.743-.648l-.007-.102v-1.5a.75.75 0 0 1 .648-.743l.102-.007h3.75z"></path>
        </svg>
        <span>Mis propiedades</span>
      </a>
    </div>
    <div class="option">
      <a href="/favoritos" :class="{ 'active': isActive('/favoritos') }">
        <svg width="27" height="27" fill="black">
          <path d="M13.036 3.289 12 4.323l-1.036-1.034A6.423 6.423 0 0 0 .678 4.958L.563 5.2a6.428 6.428 0 0 0 1.135 6.983l9.76 10.18a.75.75 0 0 0 1.083 0l9.59-10.003a6.418 6.418 0 0 0 1.19-7.402l-.122-.234a6.423 6.423 0 0 0-10.163-1.435zm5.33-.318a4.923 4.923 0 0 1 3.514 2.467l.108.205.099.21a4.92 4.92 0 0 1-.867 5.288L12 20.76l-9.046-9.434a4.928 4.928 0 0 1-1.027-5.499l.1-.212A4.923 4.923 0 0 1 9.904 4.35l1.567 1.564a.75.75 0 0 0 1.06 0l1.566-1.565a4.923 4.923 0 0 1 4.27-1.378z"></path>
        </svg>
        <span>Favoritos</span>
      </a>
    </div>
    <div class="option">
      <a href="/notificaciones" :class="{ 'active': isActive('/notificaciones') }">
        <svg width="27" height="27">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7556 21C13.8266 21 13.8966 21.01 13.9656 21.03C14.3626 21.147 14.5916 21.564 14.4746 21.961C14.2016 22.892 13.4826 23.611 12.5516 23.884C12.2896 23.961 12.0196 24 11.7496 24C11.2796 24 10.8106 23.88 10.3936 23.652C9.72863 23.289 9.24464 22.688 9.03163 21.961C8.91463 21.564 9.14263 21.147 9.53963 21.03C9.60863 21.01 9.67963 21 9.75063 21C10.044 21 10.3104 21.1746 10.4321 21.4361L10.4706 21.538C10.5716 21.881 10.7996 22.164 11.1126 22.336C11.3096 22.443 11.5296 22.5 11.7506 22.5C11.8776 22.5 12.0056 22.481 12.1296 22.445C12.5676 22.316 12.9066 21.977 13.0356 21.539C13.1286 21.222 13.4246 21 13.7556 21ZM11.7506 0C12.1646 0 12.5006 0.336 12.5006 0.75V2.284C16.65 2.65738 19.8696 6.06658 19.9967 10.2433L20.0058 11.1927C20.0929 16.9054 21.2471 18.1865 21.2586 18.199C21.4766 18.398 21.5556 18.731 21.4456 19.017C21.3316 19.31 21.0586 19.5 20.7506 19.5H2.75064C2.46564 19.5 2.20164 19.335 2.07664 19.079C1.96551 18.8515 1.97689 18.5911 2.10004 18.3768L2.20176 18.2204C2.42928 17.8344 3.50064 15.7397 3.50064 10.5C3.50064 6.207 6.76664 2.665 11.0006 2.284V0.75C11.0006 0.336 11.3366 0 11.7506 0ZM11.7496 3.75C8.02764 3.75 4.99964 6.778 4.99964 10.5C4.99964 14.457 4.41964 16.777 3.95364 18H19.4606L19.3611 17.7305C18.9148 16.4508 18.4996 14.2521 18.4996 10.5C18.4996 6.778 15.4716 3.75 11.7496 3.75Z" fill="black" />
        </svg>
        <span>Notificaciones<span v-if="unreadCount > 0"> {{ unreadCount }}</span></span>
      </a>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import useProfile from "@/composables/profile";
import axios from 'axios';
import { useRoute } from 'vue-router';

const unreadCount = ref(0);
const { profile, getProfile } = useProfile();
const route = useRoute();

// Función para verificar si la ruta actual coincide con la opción
const isActive = (path) => {
  return route.path === path;
};

onMounted(async () => {
  await getProfile();
  const userId = profile.value.id;
  notificationCount();
});

async function notificationCount() {
  const { data } = await axios.get(`/api/notificaciones/no-leidas/${profile.value.id}`);
  unreadCount.value = data.unread_count;
  console.log('El valor es : ' + unreadCount.value);
}
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
.option span {
  margin-left: 7px;
}

.option a.active {
  font-weight: bold;
  color: #835EAE;
}
.option a.active svg {
  fill: #835EAE;
}
</style>
