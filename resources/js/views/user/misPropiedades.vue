<template>
  <div class="panelusuario mt-50">
    <div class="row">
      <!-- Columna para las opciones -->
      <div class="col-md-3">
        <PanelUsuarioOpciones @enable-editing="enableEditing" />
      </div>
      <!-- Columna para el contenido -->
      <div class="col-md-9">
        <div v-for="vivienda in viviendas" :key="vivienda.id" class="card-inmueble">
          <CardInmueble :vivienda="vivienda" />
        </div>
        <button @click="toggleForm" class="btn btn-primary mb-3">Añadir Propiedad</button>
        <div v-if="showForm" class="overlay">
          <div class="overlay-content">
            <form @submit.prevent="submitForm" class="form-container">
              <h3>Crea una propiedad para que la vea todo el mundo</h3>
              <div class="form-group">
                <label for="localizacion">Localización</label>
                <input v-model="vivienda.localizacion" type="text" class="form-control" id="localizacion" required>
              </div>
              <div class="form-group">
                <label for="precio">Precio</label>
                <input v-model="vivienda.precio" type="number" class="form-control" id="precio" required>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea v-model="vivienda.descripcion" class="form-control" id="descripcion" required></textarea>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="habitaciones">Habitaciones</label>
                    <input v-model="vivienda.habitaciones" type="number" class="form-control" id="habitaciones" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="banyos">Baños</label>
                    <input v-model="vivienda.banyos" type="number" class="form-control" id="banyos" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="dimensiones">Dimensiones (m²)</label>
                    <input v-model="vivienda.dimensiones" type="number" class="form-control" id="dimensiones" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="planta">Planta</label>
                    <input v-model="vivienda.planta" type="number" class="form-control" id="planta" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select v-model="vivienda.tipo" class="form-control" id="tipo" required>
                      <option value="Piso">Piso</option>
                      <option value="Casa">Casa</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="orientacion">Orientación</label>
                    <select v-model="vivienda.orientacion" class="form-control" id="orientacion" required>
                      <option value="Norte">Norte</option>
                      <option value="Sur">Sur</option>
                      <option value="Este">Este</option>
                      <option value="Oeste">Oeste</option>
                      <option value="Noreste">Noreste</option>
                      <option value="Sureste">Sureste</option>
                      <option value="Noroeste">Noroeste</option>
                      <option value="Suroeste">Suroeste</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="agua_caliente">Agua Caliente</label>
                    <select v-model="vivienda.agua_caliente" class="form-control" id="agua_caliente" required>
                      <option value="Gas Natural">Gas Natural</option>
                      <option value="Electricidad">Electricidad</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="calefaccion">Calefacción</label>
                    <select v-model="vivienda.calefaccion" class="form-control" id="calefaccion" required>
                      <option value="Gas Natural">Gas Natural</option>
                      <option value="Electricidad">Electricidad</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="estado">Estado</label>
                    <select v-model="vivienda.estado" class="form-control" id="estado" required>
                      <option value="A reformar">A reformar</option>
                      <option value="Normal">Normal</option>
                      <option value="Bueno">Bueno</option>
                      <option value="Excelente">Excelente</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="antiguedad">Antigüedad</label>
                    <select v-model="vivienda.antiguedad" class="form-control" id="antiguedad" required>
                      <option value="5 a 10 años">5 a 10 años</option>
                      <option value="10 a 15 años">10 a 15 años</option>
                      <option value="20 a 30 años">20 a 30 años</option>
                      <option value="30 a 50 años">30 a 50 años</option>
                      <option value="más de 50 años">más de 50 años</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="parking">Parking</label>
                    <select v-model="vivienda.parking" class="form-control" id="parking" required>
                      <option value="Privado">Privado</option>
                      <option value="Publico">Publico</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="ascensor">Ascensor</label>
                    <select v-model="vivienda.ascensor" class="form-control" id="ascensor" required>
                      <option value="Si">Si</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="caracteristicas">Características</label>
                <div class="checkbox-group grid">
                  <label>
                    <input type="checkbox" value="Aire acondicionado" v-model="selectedFilters" /> Aire acondicionado
                  </label>
                  <label>
                    <input type="checkbox" value="Terraza" v-model="selectedFilters" /> Terraza
                  </label>
                  <label>
                    <input type="checkbox" value="Trastero" v-model="selectedFilters" /> Trastero
                  </label>
                  <label>
                    <input type="checkbox" value="Electrodomésticos" v-model="selectedFilters" /> Electrodomésticos
                  </label>
                  <label>
                    <input type="checkbox" value="Balcón" v-model="selectedFilters" /> Balcón
                  </label>
                  <label>
                    <input type="checkbox" value="Puerta Blindada" v-model="selectedFilters" /> Puerta Blindada
                  </label>
                  <label>
                    <input type="checkbox" value="Calefacción" v-model="selectedFilters" /> Calefacción
                  </label>
                  <label>
                    <input type="checkbox" value="Jardín" v-model="selectedFilters" /> Jardín
                  </label>
                  <label>
                    <input type="checkbox" value="Patio" v-model="selectedFilters" /> Patio
                  </label>
                  <label>
                    <input type="checkbox" value="Piscina" v-model="selectedFilters" /> Piscina
                  </label>
                  <label>
                    <input type="checkbox" value="Suite - con baño" v-model="selectedFilters" /> Suite - con baño
                  </label>
                  <label>
                    <input type="checkbox" value="Serv. portería" v-model="selectedFilters" /> Serv. portería
                  </label>
                  <label>
                    <input type="checkbox" value="Internet" v-model="selectedFilters" /> Internet
                  </label>
                  <label>
                    <input type="checkbox" value="Lavadero" v-model="selectedFilters" /> Lavadero
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="images">Imágenes</label>
                <input type="file" class="form-control" id="images" multiple @change="handleFileUpload">
              </div>
              <button type="submit" class="btn btn-primary">Crear Vivienda</button>
              <button type="button" @click="toggleForm" class="btn btn-secondary ml-2">Cancelar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, reactive, onMounted } from 'vue';
import PanelUsuarioOpciones from "@/components/PanelUsuarioOpciones.vue";
import CardInmueble from "@/components/CardInmueble.vue";
import axios from 'axios';

export default {
  name: 'MisPropiedades',
  components: {
    PanelUsuarioOpciones,
    CardInmueble
  },
  setup() {
    const viviendas = ref([]);
    const vivienda = reactive({
      localizacion: '',
      precio: '',
      descripcion: '',
      habitaciones: '',
      banyos: '',
      dimensiones: '',
      planta: '',
      tipo: '',
      orientacion: '',
      agua_caliente: '',
      calefaccion: '',
      estado: '',
      antiguedad: '',
      parking: '',
      ascensor: '',
    });
    const images = ref([]);
    const showForm = ref(false);
    const selectedFilters = ref([]);

    const fetchViviendas = async () => {
      try {
        const userId = getUserId();
        const response = await axios.get(`/api/viviendas?user_id=${userId}`);
        viviendas.value = response.data;
      } catch (error) {
        console.error('Error fetching viviendas:', error);
      }
    };

    const enableEditing = () => {
      console.log("Habilitar edición");
    };

    const handleFileUpload = (event) => {
      images.value = event.target.files;
    };

    const toggleForm = () => {
      showForm.value = !showForm.value;
    };

    const submitForm = async () => {
      try {
        const formData = new FormData();
        Object.keys(vivienda).forEach(key => {
          formData.append(key, vivienda[key]);
        });

        formData.append('id_usuario', getUserId());
        formData.append('filters', JSON.stringify(selectedFilters.value));

        for (let i = 0; i < images.value.length; i++) {
          formData.append('images[]', images.value[i]);
        }

        const response = await axios.post('/api/vivienda', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });

        console.log('Vivienda creada:', response.data);
        toggleForm();
        fetchViviendas();
      } catch (error) {
        console.error('Error al crear la vivienda:', error);
      }
    };

    const getUserId = () => {
      return 1;
    };

    onMounted(() => {
      fetchViviendas();
    });

    return {
      viviendas,
      vivienda,
      images,
      showForm,
      fetchViviendas,
      enableEditing,
      handleFileUpload,
      toggleForm,
      submitForm,
      getUserId,
      selectedFilters
    };
  }
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
  overflow-x: hidden;
}

.form-container {
  width: 100%;
  max-height: 100%;
  overflow-y: auto;
  overflow-x: hidden;
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

.checkbox-group {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

.checkbox-group.grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 10px;
  margin-left: 0px;
}

.checkbox-group.grid label {
  display: flex;
  align-items: center;
  gap: 5px;
  font-weight: bold;
  margin-top: 10px;
}
</style>