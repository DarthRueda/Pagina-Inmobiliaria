<template>
  <div class="panelusuario mt-50">
    <div class="row">
      <!-- Columna para las opciones -->
      <div class="col-md-3">
        <PanelUsuarioOpciones />
      </div>
      <!-- Columna para el contenido -->
      <div class="col-md-9">
        <div v-for="vivienda in viviendas" :key="vivienda.id" class="card-inmueble">
          <CardInmueble :vivienda="vivienda" />
          <button @click="editVivienda(vivienda)" class="btn btn-secondary mb-3">Editar Propiedad</button>
        </div>
        <button @click="toggleCreateForm" class="btn btn-primary mb-3">Añadir Propiedad</button>
        
        <!-- Formulario para crear -->
        <div v-if="showCreateForm" class="overlay">
          <div class="overlay-content">
            <form @submit.prevent="submitCreateForm" class="form-container">
              <h3>Crea una propiedad para que la vea todo el mundo</h3>
              <div class="form-group position-relative">
                <input
                  type="text"
                  v-model="searchQuery"
                  @input="filterMunicipios"
                  @focus="inputFocused = true"
                  @blur="handleBlur"
                  class="form-control"
                  placeholder="Buscar municipio..."
                />
                <ul v-if="filteredMunicipios.length && inputFocused" class="dropdown-menu show">
                  <li
                    v-for="municipio in filteredMunicipios"
                    :key="municipio.idMunicipio"
                    @mousedown.prevent="selectMunicipio(municipio.Municipio)"
                    class="dropdown-item"
                  >
                    {{ municipio.Municipio }}
                  </li>
                </ul>
              </div>
              <!-- Form fields... -->
              <div class="form-group">
                <label for="precio">Precio</label>
                <input v-model="vivienda.precio" type="number" class="form-control" id="precio" required />
              </div>
              <!-- Other form fields identical to the edit form -->
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
              <button type="button" @click="toggleCreateForm" class="btn btn-secondary ml-2">Cancelar</button>
            </form>
          </div>
        </div>

        <!-- Formulario para editar -->
        <div v-if="showEditForm" class="overlay">
          <div class="overlay-content">
            <form @submit.prevent="submitEditForm" class="form-container">
              <h3>Editar Propiedad</h3>
              <div class="form-group">
                <label>Precio Actual: {{ originalPrice }}</label>
              </div>
              <div class="form-group">
                <label>
                  <input type="checkbox" v-model="changePrice" /> Cambiar Precio
                </label>
              </div>
              <div class="form-group">
                <label for="precio">Nuevo Precio</label>
                <input
                  v-model="vivienda.precio"
                  type="number"
                  class="form-control"
                  id="precio"
                  :disabled="!changePrice"
                />
              </div>
              <!-- Other form fields identical to the create form -->
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
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
              <button type="button" @click="toggleEditForm" class="btn btn-secondary ml-2">Cancelar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, reactive, onMounted, onUnmounted } from 'vue';
import PanelUsuarioOpciones from "@/components/PanelUsuarioOpciones.vue";
import CardInmueble from "@/components/CardInmueble.vue";
import useProfile  from "@/composables/profile"; 
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
      localizacion: '',
    });
    const images = ref([]);
    const showCreateForm = ref(false);
    const showEditForm = ref(false);
    const isEditing = ref(false);
    const changePrice = ref(false);
    const selectedFilters = ref([]);
    const municipios = ref([]);
    const searchQuery = ref('');
    const editingViviendaId = ref(null);
    const originalPrice = ref(null);
    const inputFocused = ref(false);

    const fetchViviendas = async () => {
      try {
        const userId = getUserId();
        const response = await axios.get(`/api/viviendas?user_id=${userId}`);
        viviendas.value = response.data;
      } catch (error) {
        console.error('Error fetching viviendas:', error);
      }
    };

    const fetchMunicipios = async () => {
      try {
        const response = await axios.get('/api/municipios');
        municipios.value = response.data;
      } catch (error) {
        console.error('Error fetching municipios:', error);
      }
    };

    const enableEditing = () => {
      console.log("Habilitar edición");
    };

    const handleFileUpload = (event) => {
      images.value = event.target.files;
    };

    const toggleCreateForm = () => {
      showCreateForm.value = !showCreateForm.value;
      if (!showCreateForm.value) {
        resetForm();
      }
    };

    const toggleEditForm = () => {
      showEditForm.value = !showEditForm.value;
      if (!showEditForm.value) {
        resetForm();
      }
    };

    const resetForm = () => {
      Object.keys(vivienda).forEach(key => (vivienda[key] = ''));
      selectedFilters.value = [];
      images.value = [];
      isEditing.value = false;
      editingViviendaId.value = null;
      originalPrice.value = null;
      changePrice.value = false;
    };

    const editVivienda = async (viviendaData) => {
      try {
        // Obtener los datos más recientes de la vivienda
        const response = await axios.get(`/api/vivienda/${viviendaData.id}`);
        const updatedVivienda = response.data;

        // Rellenar el objeto vivienda con los datos más recientes
        Object.keys(vivienda).forEach(key => {
          vivienda[key] = updatedVivienda[key];
        });

        // Analizar y eliminar el símbolo de moneda del precio
        originalPrice.value = updatedVivienda.precio
          ? parseInt(updatedVivienda.precio.replace(/[.,€]/g, ''), 10)
          : 0;
        vivienda.precio = originalPrice.value;

        // Establecer los filtros seleccionados (características)
        selectedFilters.value = updatedVivienda.filtros
          ? updatedVivienda.filtros.map(filtro => filtro.nombre)
          : []; // Mapear el campo 'filtros' para extraer 'nombre'

        editingViviendaId.value = updatedVivienda.id;
        isEditing.value = true;
        toggleEditForm();
      } catch (error) {
        console.error('Error al obtener los datos de la vivienda:', error);
        alert('Error al cargar los datos de la vivienda. Por favor, inténtelo de nuevo más tarde.');
      }
    };

    const submitCreateForm = async () => {
      try {
        const formData = new FormData();
        Object.keys(vivienda).forEach(key => formData.append(key, vivienda[key]));
        formData.append('id_usuario', getUserId());
        formData.append('filters', JSON.stringify(selectedFilters.value));
        for (let i = 0; i < images.value.length; i++) {
          formData.append('images[]', images.value[i]);
        }
        const response = await axios.post('/api/vivienda', formData, {
          headers: { 'Content-Type': 'multipart/form-data' },
        });
        viviendas.value.push(response.data);
        toggleCreateForm();
      } catch (error) {
        console.error('Error al crear la vivienda:', error);
      }
    };

    const submitEditForm = async () => {
      try {
        const formData = new FormData();
        Object.keys(vivienda).forEach(key => {
          if (key === 'precio') {
            formData.append(key, changePrice.value ? vivienda[key] : originalPrice.value); // Usar el precio original si no se cambia
          } else {
            formData.append(key, vivienda[key]);
          }
        });

        // Ensure localizacion is included in the form data
        if (!formData.has('localizacion') || !vivienda.localizacion) {
          formData.append('localizacion', vivienda.localizacion || ''); // Use existing value or empty string
        }

        formData.append('id_usuario', getUserId());
        formData.append('filters', JSON.stringify(selectedFilters.value));

        for (let i = 0; i < images.value.length; i++) {
          formData.append('images[]', images.value[i]);
        }

        // Log the form data for debugging
        console.log('Submitting edit form with data:', Object.fromEntries(formData.entries()));

        const response = await axios.post(`/api/vivienda/${editingViviendaId.value}`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        // Actualiza la vivienda editada en la lista
        const index = viviendas.value.findIndex(v => v.id === editingViviendaId.value);
        if (index !== -1) {
          viviendas.value[index] = response.data;

          // Refresh selectedFilters with the updated filters
          selectedFilters.value = response.data.filtros
            ? response.data.filtros.map(filtro => filtro.nombre)
            : [];
        }
        toggleEditForm();
      } catch (error) {
        console.error('Error al guardar la vivienda:', error);

        // Display a user-friendly error message
        if (error.response && error.response.data && error.response.data.message) {
          alert(`Error: ${error.response.data.message}`);
        } else {
          alert('Error al guardar la vivienda. Por favor, inténtelo de nuevo más tarde.');
        }
      }
    };

    const filterMunicipios = () => {
      filteredMunicipios.value = municipios.value.filter(municipio => 
        municipio.Municipio.toLowerCase().includes(searchQuery.value.toLowerCase())
      );
    };

    const selectMunicipio = (municipio) => {
      vivienda.localizacion = municipio;
      searchQuery.value = municipio;
      filteredMunicipios.value = [];
    };

    const handleClickOutside = (event) => {
      const dropdown = document.querySelector('.dropdown-menu.show');
      if (dropdown && !dropdown.contains(event.target)) {
        filteredMunicipios.value = [];
      }
    };

    const handleBlur = () => {
      setTimeout(() => {
        inputFocused.value = false;
      }, 100);
    };

    const filteredMunicipios = ref([]);

    onMounted(() => {
      fetchViviendas();
      fetchMunicipios();
      document.addEventListener('click', handleClickOutside);
      getUserId(); 
    });

    const getUserId = () => {
      const { profile,getProfile } = useProfile();
      getProfile(); // Obtener el perfil del usuario
      return profile.value.id; // Log the profile for debugging
    };
    
    return {
      viviendas,
      vivienda,
      images,
      showCreateForm,
      showEditForm,
      isEditing,
      changePrice,
      fetchViviendas,
      editVivienda,
      enableEditing,
      handleFileUpload,
      toggleCreateForm,
      toggleEditForm,
      submitCreateForm,
      submitEditForm,
      getUserId,
      selectedFilters,
      municipios,
      searchQuery,
      originalPrice,
      filteredMunicipios,
      filterMunicipios,
      selectMunicipio,
      inputFocused,
      handleBlur
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

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 10rem;
  padding: 0.5rem 0;
  margin: 0.125rem 0 0;
  font-size: 1rem;
  color: #212529;
  text-align: left;
  list-style: none;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.25rem;
}

.dropdown-menu.show {
  display: block;
}

.dropdown-item {
  display: block;
  width: 100%;
  padding: 0.25rem 1.5rem;
  clear: both;
  font-weight: 400;
  color: #212529;
  text-align: inherit;
  white-space: nowrap;
  background-color: transparent;
  border: 0;
  cursor: pointer;
}

.dropdown-item:hover {
  background-color: #f8f9fa;
}
</style>