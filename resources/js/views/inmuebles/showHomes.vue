<template>
    <div style="background-color: #f8f9fa;">
        <h1>Inmuebles</h1>
        <div class="container">
            <div class="filters col-md-3" style="background-color: white;">
                <div class="filter-block">
                </div>
                <div class="form-group position-relative">
                    <label for="poblacion">Población</label>
                    <div class="input-group">
                        <input
                          type="text"
                          v-model="searchQuery"
                          @input="filterMunicipios"
                          @focus="inputFocused = true"
                          @blur="handleBlur"
                          class="form-control"
                          placeholder="Buscar municipio"
                        />
                        <div class="input-group-append">
                            <button v-if="searchQuery" @click="clearMunicipioFilter" class="btn btn-secondary btn-sm">X</button>
                        </div>
                    </div>
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
                <div class="form-group">
                    <label for="price">Precio</label>
                    <input type="number" id="price-min" v-model="priceMin" placeholder="Mínimo" style="width: 131px; margin-right: 10px;" @change="applyFilters" />
                    <input type="number" id="price-max" v-model="priceMax" placeholder="Máximo" style="width: 131px;" @change="applyFilters" />
                </div>
                <div class="form-group">
                    <label for="surface">Superficie</label>
                    <select id="surface" v-model="selectedSurface" @change="applyFilters">
                        <option value="">Cualquier</option>
                        <option value="50">50 m²</option>
                        <option value="60">60 m²</option>
                        <option value="70">70 m²</option>
                        <option value="80">80 m²</option>
                        <option value="90">90 m²</option>
                        <option value="100">100 m²</option>
                        <option value="125">125 m²</option>
                        <option value="150">150 m²</option>
                        <option value="200">200 m²</option>
                        <option value="250">250 m²</option>
                        <option value="300">300 m²</option>
                        <option value="350">350 m²</option>
                        <option value="400">400 m²</option>
                        <option value="450">450 m²</option>
                        <option value="500">500 m²</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo-habitatge">Tipo de habitatge</label>
                    <div class="checkbox-group">
                        <input type="checkbox" id="tipo-habitatge-piso" value="Piso" v-model="selectedTipo" @change="applyFilters" /> Piso
                        <input type="checkbox" id="tipo-habitatge-casa" value="Casa" v-model="selectedTipo" @change="applyFilters" /> Casa
                    </div>
                </div>
                <div class="form-group">
                    <label for="habitaciones">Habitaciones</label>
                    <div class="checkbox-group">
                        <input type="checkbox" id="habitaciones-1" value="1" v-model="selectedHabitaciones" @change="applyFilters" /> 1
                        <input type="checkbox" id="habitaciones-2" value="2" v-model="selectedHabitaciones" @change="applyFilters" /> 2
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="habitaciones-3" value="3" v-model="selectedHabitaciones" @change="applyFilters" /> 3
                        <input type="checkbox" id="habitaciones-4" value="4" v-model="selectedHabitaciones" @change="applyFilters" /> 4
                    </div>
                </div>
                <div class="form-group">
                    <label for="banos">Baños</label>
                    <div class="checkbox-group">
                        <input type="checkbox" id="banos-1" value="1" v-model="selectedBanyos" @change="applyFilters" /> 1
                        <input type="checkbox" id="banos-2" value="2" v-model="selectedBanyos" @change="applyFilters" /> 2
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="banos-3" value="3" v-model="selectedBanyos" @change="applyFilters" /> 3
                        <input type="checkbox" id="banos-4" value="4" v-model="selectedBanyos" @change="applyFilters" /> 4
                    </div>
                </div>
                <div class="form-group">
                    <label for="caracteristicas">Características</label>
                    <div class="checkbox-group grid">
                        <label><input type="checkbox" value="Aire acondicionado" v-model="selectedFilters" @change="applyFilters" /> Aire acondicionado</label>
                        <label><input type="checkbox" value="Terraza" v-model="selectedFilters" @change="applyFilters" /> Terraza</label>
                        <label><input type="checkbox" value="Trastero" v-model="selectedFilters" @change="applyFilters" /> Trastero</label>
                        <label><input type="checkbox" value="Electrodomésticos" v-model="selectedFilters" @change="applyFilters" /> Electrodomésticos</label>
                        <label><input type="checkbox" value="Balcón" v-model="selectedFilters" @change="applyFilters" /> Balcón</label>
                        <label><input type="checkbox" value="Puerta Blindada" v-model="selectedFilters" @change="applyFilters" /> Puerta Blindada</label>
                        <label><input type="checkbox" value="Calefacción" v-model="selectedFilters" @change="applyFilters" /> Calefacción</label>
                        <label><input type="checkbox" value="Jardín" v-model="selectedFilters" @change="applyFilters" /> Jardín</label>
                        <label><input type="checkbox" value="Patio" v-model="selectedFilters" @change="applyFilters" /> Patio</label>
                        <label><input type="checkbox" value="Piscina" v-model="selectedFilters" @change="applyFilters" /> Piscina</label>
                        <label><input type="checkbox" value="Suite - con baño" v-model="selectedFilters" @change="applyFilters" /> Suite - con baño</label>
                        <label><input type="checkbox" value="Serv. portería" v-model="selectedFilters" @change="applyFilters" /> Serv. portería</label>
                        <label><input type="checkbox" value="Internet" v-model="selectedFilters" @change="applyFilters" /> Internet</label>
                        <label><input type="checkbox" value="Lavadero" v-model="selectedFilters" @change="applyFilters" /> Lavadero</label>
                    </div>
                </div>
            </div>

            <div class="list-inmuebles col-md-9">
                <div class="tipo-de-inmueble">      
                    <button>Comprar</button>
                    <button>Alquilar</button>
                </div>
                <CardInmueble v-for="vivienda in viviendas" :key="vivienda.id" :vivienda="vivienda" class="card-inmueble" />
            </div>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <nav aria-label="Page navigation">
                <ul class="paginacion">
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import CardInmueble from '../../components/CardInmueble.vue';
import axios from 'axios';

export default {
    name: 'ShowHomes',
    components: {
        CardInmueble
    },
    setup() {
        const route = useRoute();
        const viviendas = ref([]);
        const selectedFilters = ref([]);
        const selectedHabitaciones = ref([]);
        const selectedBanyos = ref([]);
        const selectedTipo = ref([]);
        const priceMin = ref(null);
        const priceMax = ref(null);
        const selectedSurface = ref(null);
        const searchQuery = ref(route.query.municipio || '');
        const filteredMunicipios = ref([]);
        const municipios = ref([]);
        const selectedMunicipio = ref(route.query.municipio || '');
        const inputFocused = ref(false);

        const fetchViviendas = async () => {
            try {
                const response = await axios.get('/api/viviendas');
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

        const applyFilters = async () => {
            try {
                const response = await axios.get('/api/viviendas/filterByCaracteristicas', {
                    params: {
                        filters: selectedFilters.value,
                        habitaciones: selectedHabitaciones.value,
                        banyos: selectedBanyos.value,
                        tipo: selectedTipo.value,
                        price_min: priceMin.value,
                        price_max: priceMax.value,
                        surface: selectedSurface.value,
                        municipio: selectedMunicipio.value
                    }
                });
                viviendas.value = response.data.filter(vivienda => !selectedMunicipio.value || vivienda.localizacion === selectedMunicipio.value);
            } catch (error) {
                console.error('Error applying filters:', error);
            }
        };

        const filterMunicipios = () => {
            filteredMunicipios.value = municipios.value.filter(municipio => 
                municipio.Municipio.toLowerCase().includes(searchQuery.value.toLowerCase())
            );
        };

        const selectMunicipio = (municipio) => {
            searchQuery.value = municipio;
            selectedMunicipio.value = municipio;
            filteredMunicipios.value = [];
            applyFilters();
        };

        const clearMunicipioFilter = () => {
            searchQuery.value = '';
            selectedMunicipio.value = '';
            applyFilters();
        };

        const handleBlur = () => {
            setTimeout(() => {
                inputFocused.value = false;
            }, 100);
        };

        onMounted(() => {
            fetchViviendas();
            fetchMunicipios();
            if (selectedMunicipio.value) {
                applyFilters();
            }
        });

        watch([selectedFilters, selectedHabitaciones, selectedBanyos, selectedTipo, priceMin, priceMax, selectedSurface], applyFilters);

        return {
            viviendas,
            selectedFilters,
            selectedHabitaciones,
            selectedBanyos,
            selectedTipo,
            priceMin,
            priceMax,
            selectedSurface,
            applyFilters,
            searchQuery,
            filteredMunicipios,
            filterMunicipios,
            selectMunicipio,
            clearMunicipioFilter,
            selectedMunicipio,
            inputFocused,
            handleBlur
        };
    }
};
</script>

<style scoped>
.container {
    display: flex;
    margin: 0;
    padding: 0;
}
.filters {
    margin-right: 20px;
    margin-left: 20px;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    border: none; 
    height: 80%;
}

.filters * {
    margin-left: 10px;
}

.filter-block {
    width: 266px;
    height: 194px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
}

.tipo-de-inmueble {
    margin-bottom: 20px;
}

.tipo-de-inmueble button {
    font-size: 24px;
    border: none;
    background-color: transparent;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-size: 12px;
    font-weight: bold;
}

.form-group input[type="number"] {
    width: 131px;
    margin-right: 10px;
}

h1 {
    margin-left: 20px;
    margin-top: 20px;
    margin-bottom: 20px;
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

input[type="checkbox"] {
    width: 16px;
    height: 16px;
}

.input-group{
    margin: 0px;
    width: 80%;
}

.input-group-append {
    margin-left: -1px;
    margin-top: 2px; /* Add this line */
}

.card-inmueble {
    margin-bottom: 15px; /* Add this line */
}

.checkbox-group.grid label {
    display: flex;
    align-items: center;
    gap: 5px;
    font-weight: bold;
    margin-top: 10px;
}

.pagination {
    display: inline-block;
}

.page-item {
    border: 2px solid black;
    width: 40px;
    height: 40px;
    display: inline-block;
    justify-content: center;
    align-items: center;
    margin-right: 8px;
}

.page-link {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
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

.btn-secondary {
    background-color: red; 
    border-color: red; 
}

@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }
    .filters {
        margin-bottom: 20px;
    }
    .list-inmuebles {
        width: 100%;
    }
}
</style>