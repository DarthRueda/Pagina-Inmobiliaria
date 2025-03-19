<template>
    <div style="background-color: #f8f9fa;">
        <h1>Inmuebles</h1>
        <div class="container">
            <div class="filters col-md-3" style="background-color: white;">
                <div class="filter-block">
                </div>
                <div class="form-group">
                    <label for="location">Poblacion</label>
                    <input type="text" id="location" v-model="filters.location" @input="applyFilters" />
                </div>
                <div class="form-group">
                    <label for="price">Precio</label>
                    <input type="number" id="price-min" placeholder="Mínimo" style="width: 131px; margin-right: 10px;" v-model.number="filters.priceMin" @input="applyFilters" />
                    <input type="number" id="price-max" placeholder="Máximo" style="width: 131px;" v-model.number="filters.priceMax" @input="applyFilters" />
                </div>
                <div class="form-group">
                    <label for="surface">Superficie</label>
                    <select id="surface" v-model="filters.surface" @change="applyFilters">
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
                        <input type="checkbox" id="tipo-habitatge-piso" v-model="filters.tipo.piso" @change="applyFilters" /> Piso
                        <input type="checkbox" id="tipo-habitatge-casa" v-model="filters.tipo.casa" @change="applyFilters" /> Casa
                    </div>
                </div>
                <div class="form-group">
                    <label for="habitaciones">Habitaciones</label>
                    <div class="checkbox-group">
                        <input type="checkbox" id="habitaciones-1" v-model="filters.habitaciones['1']" @change="applyFilters" /> 1
                        <input type="checkbox" id="habitaciones-2" v-model="filters.habitaciones['2']" @change="applyFilters" /> 2
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="habitaciones-3" v-model="filters.habitaciones['3']" @change="applyFilters" /> 3
                        <input type="checkbox" id="habitaciones-4" v-model="filters.habitaciones['4']" @change="applyFilters" /> 4
                    </div>
                </div>
                <div class="form-group">
                    <label for="banos">Baños</label>
                    <div class="checkbox-group">
                        <input type="checkbox" id="banos-1" v-model="filters.banos['1']" @change="applyFilters" /> 1
                        <input type="checkbox" id="banos-2" v-model="filters.banos['2']" @change="applyFilters" /> 2
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="banos-3" v-model="filters.banos['3']" @change="applyFilters" /> 3
                        <input type="checkbox" id="banos-4" v-model="filters.banos['4']" @change="applyFilters" /> 4
                    </div>
                </div>
                <div class="form-group">
                    <label for="caracteristicas">Características</label>
                    <div class="checkbox-group grid">
                        <label><input type="checkbox" id="caracteristicas-aire-acondicionado" v-model="filters.caracteristicas.aire_acondicionado" @change="applyFilters" /> Aire acondicionado</label>
                        <label><input type="checkbox" id="caracteristicas-terraza" v-model="filters.caracteristicas.terraza" @change="applyFilters" /> Terraza</label>
                        <label><input type="checkbox" id="caracteristicas-trastero" v-model="filters.caracteristicas.trastero" @change="applyFilters" /> Trastero</label>
                        <label><input type="checkbox" id="caracteristicas-electrodomesticos" v-model="filters.caracteristicas.electrodomesticos" @change="applyFilters" /> Electrodomésticos</label>
                        <label><input type="checkbox" id="caracteristicas-balcon" v-model="filters.caracteristicas.balcon" @change="applyFilters" /> Balcón</label>
                        <label><input type="checkbox" id="caracteristicas-puerta-blindada" v-model="filters.caracteristicas.puerta_blindada" @change="applyFilters" /> Puerta Blindada</label>
                        <label><input type="checkbox" id="caracteristicas-calefaccion" v-model="filters.caracteristicas.calefaccion" @change="applyFilters" /> Calefacción</label>
                        <label><input type="checkbox" id="caracteristicas-jardin" v-model="filters.caracteristicas.jardin" @change="applyFilters" /> Jardín</label>
                        <label><input type="checkbox" id="caracteristicas-patio" v-model="filters.caracteristicas.patio" @change="applyFilters" /> Patio</label>
                        <label><input type="checkbox" id="caracteristicas-piscina" v-model="filters.caracteristicas.piscina" @change="applyFilters" /> Piscina</label>
                        <label><input type="checkbox" id="caracteristicas-suite-con-bano" v-model="filters.caracteristicas.suite_con_bano" @change="applyFilters" /> Suite - con baño</label>
                        <label><input type="checkbox" id="caracteristicas-serv-porteria" v-model="filters.caracteristicas.serv_porteria" @change="applyFilters" /> Serv. portería</label>
                        <label><input type="checkbox" id="caracteristicas-internet" v-model="filters.caracteristicas.internet" @change="applyFilters" /> Internet</label>
                        <label><input type="checkbox" id="caracteristicas-lavadero" v-model="filters.caracteristicas.lavadero" @change="applyFilters" /> Lavadero</label>
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
import { ref, reactive, onMounted } from 'vue';
import CardInmueble from '../../components/CardInmueble.vue';
import axios from 'axios';

export default {
    name: 'ShowHomes',
    components: {
        CardInmueble
    },
    setup() {
        const viviendas = ref([]);
        const filters = reactive({
            location: '',
            priceMin: null,
            priceMax: null,
            surface: '',
            tipo: {
                piso: false,
                casa: false
            },
            habitaciones: {
                '1': false,
                '2': false,
                '3': false,
                '4': false
            },
            banos: {
                '1': false,
                '2': false,
                '3': false,
                '4': false
            },
            caracteristicas: {
                aire_acondicionado: false,
                terraza: false,
                trastero: false,
                electrodomesticos: false,
                balcon: false,
                puerta_blindada: false,
                calefaccion: false,
                jardin: false,
                patio: false,
                piscina: false,
                suite_con_bano: false,
                serv_porteria: false,
                internet: false,
                lavadero: false
            }
        });

        const fetchViviendas = async () => {
            try {
                const response = await axios.get('/api/viviendas', { params: filters });
                viviendas.value = response.data;
            } catch (error) {
                console.error('Error fetching viviendas:', error);
            }
        };

        const applyFilters = () => {
            fetchViviendas();
        };

        onMounted(() => {
            fetchViviendas();
        });

        return {
            viviendas,
            filters,
            applyFilters
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