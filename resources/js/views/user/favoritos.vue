<template>
  <div class="favoritos-page">
    <div class="panelusuario mt-50">
      <div class="row">
        <!-- Columna para las opciones -->
        <div class="col-md-3">
          <PanelUsuarioOpciones />
        </div>
        <!-- Columna para el contenido -->
        <div class="col-md-9">
          <h1 class="mb-30">Favoritos</h1>
          <div v-for="vivienda in viviendas" :key="vivienda.id" class="card-inmueble">
            <CardInmueble :vivienda="vivienda" />
          </div>
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

        const response = await axios.get(`/api/likes/${userId}`);
        this.viviendas = response.data.likes;

        // Asegurarse de que la imagen de la vivienda esté disponible
        this.viviendas.forEach(vivienda => {
          const firstMedia = vivienda.media?.find(media => media.model_id === vivienda.id);
          vivienda.image = firstMedia?.original_url || '/images/placeholder.jpg';
        });
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
.favoritos-page {
  display: flex;
  flex-direction: column;
  min-height: 100vh; /* Asegura que la página ocupe toda la altura de la ventana */
}

.panelusuario {
  flex: 1; /* Hace que el contenido principal ocupe el espacio disponible */
}

.row {
  margin-right: 0;
  margin-left: 0;
}

.form-group {
  margin-bottom: 15px;
}

.card-inmueble {
  margin-bottom: 15px;
}

.mt-50 {
  margin-top: 50px;
}

.mb-30 {
  margin-bottom: 30px;
}

.panelusuario {
  padding: 0 15px;
}
</style>

