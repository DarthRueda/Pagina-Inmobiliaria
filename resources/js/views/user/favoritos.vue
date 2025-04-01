<template>
  <div class="panelusuario mt-50">
    <div class="row">
      <!-- Columna para las opciones -->
      <div class="col-md-3">
        <PanelUsuarioOpciones />
      </div>
      <!-- Columna para el contenido -->
      <div class="col-md-9">
        <div class="row">
          <!-- Escuchar el evento removeLike para actualizar la lista -->
          <CardInmueble 
            v-for="vivienda in viviendas" 
            :key="vivienda.id" 
            :vivienda="vivienda" 
            @removeLike="handleRemoveLike" 
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PanelUsuarioOpciones from "@/components/PanelUsuarioOpciones.vue";
import CardInmueble from "@/components/CardInmueble.vue";
import axios from "axios";
import useProfile from "@/composables/profile";

export default {
  components: {
    PanelUsuarioOpciones,
    CardInmueble,
  },
  data() {
    return {
      viviendas: [],
      userProfile: null, // Guardamos el perfil del usuario
    };
  },
  async mounted() {
    await this.getProfile();
    await this.fetchLikedViviendas();
  },
  methods: {
    async getProfile() {
      const { profile, getProfile } = useProfile();
      await getProfile(); // Obtener el perfil del usuario
      this.userProfile = profile.value; // Guardamos el perfil en el componente
    },

    async fetchLikedViviendas() {
      try {
        const userId = this.userProfile.id;

        // Ahora la API devuelve las viviendas completas
        const response = await axios.get(`/api/likes/${userId}`);
        this.viviendas = response.data.likes; // Directamente asignamos la lista de viviendas
      } catch (error) {
        console.error("Error fetching liked viviendas:", error);
      }
    },

    // Método que maneja la eliminación del like y actualiza la lista de viviendas
    handleRemoveLike(viviendaId) {
      this.viviendas = this.viviendas.filter(vivienda => vivienda.id !== viviendaId);
    },
  },
};
</script>

<style scoped>
.row {
  margin-right: 0;
  margin-left: 0;
}

.ml-20 {
  margin-left: 20px;
  width: 23%;
}

.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.overlay-content {
  background: white;
  padding: 20px;
  text-align: center;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 50%;
  height: 80%;
  overflow-y: auto;
}

.form-container {
  width: 100%;
  max-height: 100%;
  overflow-y: auto;
}

.form-group {
  margin-bottom: 15px;
}

.btn {
  margin-top: 10px;
}

.card-inmueble {
  margin-bottom: 15px;
}
</style>
