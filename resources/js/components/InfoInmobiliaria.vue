<template>
    <div v-if="info" class="info-inmobiliaria row">
        <div class="column col-4 center">
            <img :src="info.logo || '/images/placeholder-logo.jpg'" alt="Inmobiliaria Logo" class="image">
        </div>
        <div class="column col-4">
            <h1 class="title">{{ info.nombre_comercial }}</h1>
            <h2 class="subtitle">{{ info.direccion }}, {{ info.localidad }}</h2>
            <h2 class="subtitle light">{{ info.descripcion }}</h2>
        </div>
        <div class="column col-4 center">
            <p class="telefono"><strong>Teléfono:</strong> {{ info.telefono }}</p>
            <button class="search-button" @click="showContactBox = true">Contacta</button>
        </div>
        <div v-if="showContactBox" class="modal-overlay" @click.self="showContactBox = false">
            <div class="modal-box">
                <h2>Correo de contacto</h2>
                <p>{{ info.email }}</p>
                <button class="close-button" @click="showContactBox = false">Cerrar</button>
            </div>
        </div>
    </div>
    <div v-else>
        <p>Loading...</p>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue';

export default defineComponent({
  props: {
    info: {
      type: Object,
      required: false,
      default: null,
    },
  },
  setup() {
    const showContactBox = ref(false);
    return {
      showContactBox,
    };
  },
});
</script>

<style scoped>
.info-inmobiliaria {
    width: 80%;
    margin: 0 auto;
    box-sizing: border-box;
    background-color: #ffffff;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 20px;
    position: relative;
    z-index: 1;
    margin-top: -40px;
    margin-bottom: 30px;
    height: 240px;
    overflow: hidden;
}

.column {
    padding: 10px;
    display: flex;
    flex-direction: column;
}

.column.center {
    align-items: center;
}

.column.col-4 {
    text-align: left;
}

.image {
    width: auto;
    height: 100%;
    max-width: 100%;
    max-height: 116px;
    object-fit: contain;
    border-radius: 8px;
}

.title {
    font-size: 24px;
    margin-bottom: 5px;
}

.subtitle {
    font-size: 14px;
    margin-bottom: 5px;
}

.subtitle.light {
    font-weight: lighter;
    margin-bottom: 10px;
}

.telefono {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 15px;
    text-align: center;
    color: #333;
}

.search-button {
    width: 200px;
    padding: 10px 20px;
    background-color: #835EAE;
    color: white;
    cursor: pointer;
    margin: 0 auto;
    border: none;
    box-shadow: 0 4px 2px -2px gray;
    font-size: 16px;
    border-radius: 5px; 
}

.search-button:hover {
    background-color: #64428C;
}

/* Modal styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-box {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 300px;
}

.modal-box h2 {
    margin-bottom: 10px;
    font-size: 18px;
    color: #333;
}

.modal-box p {
    font-size: 16px;
    color: #555;
    margin-bottom: 20px;
}

.close-button {
    padding: 10px 20px;
    background-color: #835EAE;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.close-button:hover {
    background-color: #64428C;
}
</style>