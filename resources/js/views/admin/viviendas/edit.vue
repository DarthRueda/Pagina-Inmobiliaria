<template>
    <div>
        <h1>Editar Vivienda</h1>
        <form @submit.prevent="submitEditForm" class="form-container">
            <div class="form-group">
                <label for="precio">Precio</label>
                <input v-model="vivienda.precio" type="number" class="form-control" id="precio" required />
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
            <div v-if="!showImageEdit">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <button type="button" @click="toggleImageEdit" class="btn btn-warning ml-2">Editar Imágenes</button>
                <button type="button" @click="cancelEdit" class="btn btn-secondary ml-2">Cancelar</button>

            </div>
        </form>
    </div>

    <!-- Editar una Imagen -->
    <div v-if="showImageEdit" class="overlay">
          <div class="overlay-content">
            <h3>Editar Imágenes</h3>
            <div class="thumbnail-row">
              <img
                v-for="image in vivienda.media"
                :key="image.id"
                :src="image.url"
                class="thumbnail"
                @click="selectImage(image)"
              />
            </div>
            <div v-if="selectedImage" class="selected-image-container">
              <img :src="selectedImage.url" class="selected-image" />
              <button @click="deleteImage(selectedImage)" class="btn btn-danger mt-3">
                Eliminar Imagen
              </button>
            </div>
            <div class="form-group mt-3">
              <h4 class="add-images-title">Añadir Nuevas Imágenes</h4>
              <input type="file" id="newImages" multiple @change="handleNewImageUpload" class="file-input" />
            </div>
            <button @click="submitImageChanges" class="btn btn-primary mt-3">Guardar Cambios</button>
            <button @click="toggleImageEdit" class="btn btn-secondary mt-3">Cerrar</button>
          </div>
        </div>
    
</template>

<script>
import { ref, reactive, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

export default {
    name: 'ViviendasEdit',
    setup() {
        const route = useRoute();
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
            media: [], // Asegúrate de inicializar el array de imágenes
        });
        const images = ref([]);
        const selectedFilters = ref([]);
        const municipios = ref([]);
        const searchQuery = ref('');
        const inputFocused = ref(false);
        const filteredMunicipios = ref([]);
        const showImageEdit = ref(false);
        const selectedImage = ref(null);
        const newImages = ref([]);

        const fetchVivienda = async () => {
            try {
                const response = await axios.get(`/api/vivienda/${route.params.id}`);
                const data = response.data;

                // Limpia el precio eliminando caracteres no numéricos
                data.precio = parseInt(data.precio.replace(/[.,€]/g, ''));

                Object.assign(vivienda, data);
                selectedFilters.value = data.filtros.map(filtro => filtro.nombre);

                


                // Asegúrate de que las imágenes estén en el formato correcto
                vivienda.media = data.media || [];
            } catch (error) {
                console.error('Error fetching vivienda:', error);
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

        const handleFileUpload = (event) => {
            images.value = event.target.files;
        };

        const handleBlur = () => {
            setTimeout(() => {
                inputFocused.value = false;
            }, 100);
        };

        const submitEditForm = async () => {
            try {
                const formData = new FormData();
                Object.keys(vivienda).forEach(key => formData.append(key, vivienda[key]));
                formData.append('filters', JSON.stringify(selectedFilters.value));
                for (let i = 0; i < images.value.length; i++) {
                    formData.append('images[]', images.value[i]);
                }
                await axios.post(`/api/vivienda/${route.params.id}`, formData, {
                    headers: { 'Content-Type': 'multipart/form-data' },
                });
                alert('Vivienda actualizada con éxito');
                window.history.back();
            } catch (error) {
                console.error('Error al actualizar la vivienda:', error);
            }
        };

        const toggleImageEdit = () => {
            showImageEdit.value = !showImageEdit.value;
            if (!showImageEdit.value) {
                selectedImage.value = null;
                newImages.value = [];
            }
        };

        const selectImage = (image) => {
            selectedImage.value = image;
        };

        const deleteImage = async (image) => {
            if (confirm("¿Estás seguro de que deseas eliminar la imagen?")) {
                try {
                    await axios.delete(`/api/vivienda/${route.params.id}/media/${image.id}`);
                    vivienda.media = vivienda.media.filter((img) => img.id !== image.id);
                    selectedImage.value = null;
                } catch (error) {
                    console.error("Error al eliminar la imagen:", error);
                }
            }
        };

        const handleNewImageUpload = (event) => {
            newImages.value = Array.from(event.target.files);
        };

        const submitImageChanges = async () => {
            try {
                const formData = new FormData();
                newImages.value.forEach((image) => formData.append("images[]", image));
                const response = await axios.post(`/api/vivienda/${route.params.id}/media`, formData, {
                    headers: { "Content-Type": "multipart/form-data" },
                });
                vivienda.media.push(...response.data);
                toggleImageEdit();
            } catch (error) {
                console.error("Error al guardar las imágenes:", error);
            }
        };

        const cancelEdit = () => {
            window.history.back();
        };


        onMounted(() => {
            fetchVivienda();
            fetchMunicipios();
        });

        return {
            vivienda,
            images,
            selectedFilters,
            municipios,
            searchQuery,
            inputFocused,
            filteredMunicipios,
            filterMunicipios,
            selectMunicipio,
            handleFileUpload,
            handleBlur,
            submitEditForm,
            showImageEdit,
            selectedImage,
            newImages,
            toggleImageEdit,
            selectImage,
            deleteImage,
            handleNewImageUpload,
            submitImageChanges,
            cancelEdit,
        };
    },
};
</script>

<style scoped>
.row {
  margin-right: 0;
  margin-left: 0;
}

.form-group {
  margin-bottom: 15px;
}

.btn {
  margin-top: 10px;
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

.form-container {
  width: 100%;
  max-height: 100%;
  overflow-y: auto;
  overflow-x: hidden;
}

.thumbnail {
    width: 100px;
    height: 100px;
    object-fit: cover;
    cursor: pointer;
    border: 2px solid transparent;
}

.thumbnail.selected {
    border-color: #007bff;
}

.thumbnail:hover {
    border-color: #007bff;
}

.selected-image-container {
    margin-top: 20px;
    text-align: center;
}

.selected-image {
    max-width: 100%;
    max-height: 300px;
    border: 1px solid #ddd;
}

.add-images-title {
    text-align: center;
    margin-bottom: 15px;
    font-size: 1.5rem;
    font-weight: bold;
}

.file-input {
    display: block;
    margin: 0 auto;
    text-align: center;
}
</style>
