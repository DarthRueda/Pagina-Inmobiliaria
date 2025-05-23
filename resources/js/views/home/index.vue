<template>
    <div class="Banner">
        <div class="container">
            <div class="row">
                <h1><b>ENCUENTRA CASA EN UNOS CLICKS</b></h1>
            </div>
            <div>
            </div>
            <div class="search-container">
                <div class="search-options">
                    <button 
                        class="option-button" 
                        :class="{ selected: selectedOption === 'comprar' }" 
                        @click="selectOption('comprar')"
                    >
                        Comprar
                        <svg v-if="selectedOption === 'comprar'" class="triangle" viewBox="0 0 10 5">
                            <path d="M0 0 L5 5 L10 0 Z" />
                        </svg>
                    </button>
                    <button 
                        class="option-button" 
                        :class="{ selected: selectedOption === 'alquilar' }" 
                        @click="selectOption('alquilar')"
                    >
                        Alquilar
                        <svg v-if="selectedOption === 'alquilar'" class="triangle" viewBox="0 0 10 5">
                            <path d="M0 0 L5 5 L10 0 Z" />
                        </svg>
                    </button>
                </div>
                <div class="search-bar position-relative">
                    <input 
                        type="text" 
                        placeholder="Ubicación" 
                        class="search-input" 
                        v-model="searchQuery" 
                        @input="filterMunicipios"
                    >
                    <ul v-if="filteredMunicipios.length" class="dropdown-menu municipios-dropdown show">
                        <li
                            v-for="municipio in filteredMunicipios"
                            :key="municipio.idMunicipio"
                            @click="selectMunicipio(municipio.Municipio)"
                            class="dropdown-item"
                        >
                            {{ municipio.Municipio }}
                        </li>
                    </ul>
                    <button class="search-button" @click="redirectToShowHomes"><b>Buscar</b></button>
                </div>
            </div>
        </div>
    </div>
    <div class="Seccion1">
        <div class="bloque-hipoteca">
            <div class="row">
                <div class="col-6">
                    <img src="/images/Home/hipoteca.png" class="bloque-image" style="float: center;">
                </div>
                <div class="col-6 text-section">
                    <div class="icon-text">
                        <img src="/images/Home/calculadora.png" class="icon-image">
                        <span class="text-content">Calculadora de hipoteca</span>
                    </div>
                    <span class="text-bold">Simula tu hipoteca</span>
                    <span class="text-regular">Descubre cuánto puedes pagar por tu próxima vivienda con nuestra calculadora de hipotecas fácil y rápida.</span>
                    <button class="section-button" @click="redirectToHipoteca">¡Haz tu simulación ahora!</button>
                </div>
            </div>
        </div>
        <div class="bloque-casa">
            <div class="row">
                <div class="col-6">
                    <img src="/images/Home/casa.png" class="bloque-image">
                </div>
                <div class="col-6 text-section">
                    <div class="icon-text">
                        <img src="/images/Home/etiqueta.png" class="icon-image">
                        <span class="text-content">Calcula cuanto vale tu casa</span>
                    </div>
                    <span class="text-bold">Quanto vale mi casa?</span>
                    <span class="text-regular">Calcula su precio según las características y otros pisos de la zona. Acompañarte es darte todas las herramientas gratuitas.</span>
                    <button class="section-button" @click="redirectToPrecioCasa">¡Valora tu vivienda ahora!</button>
                </div>
            </div>
        </div>
        <div class="bloque-inmobiliaria">
            <div class="row">
                <div class="col-6">
                    <img src="/images/Home/inmobiliaria.png" class="bloque-image">
                </div>
                <div class="col-6 text-section">
                    <div class="icon-text">
                        <img src="/images/Home/trato.png" class="icon-image">
                        <span class="text-content">Descubre nuestros socios de confianza</span>
                    </div>
                    <span class="text-bold">Inmobiliarias Profesionales</span>
                    <span class="text-regular">Encuentra las mejores propiedades con el respaldo de inmobiliarias certificadas y expertas. ¡Tu hogar ideal está aquí!</span>
                    <button class="section-button">¡Descubre las agencias!</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
    name: 'HomeIndex',
    setup() {
        const selectedOption = ref('comprar');
        const router = useRouter();
        const searchQuery = ref('');
        const filteredMunicipios = ref([]);
        const municipios = ref([]);
        const selectedMunicipio = ref('');

        const selectOption = (option) => {
            selectedOption.value = option;
        };

        const redirectToHipoteca = () => {
            router.push('/hipoteca');
        };

        const redirectToPrecioCasa = () => {
            router.push('/preciocasa');
        };

        const redirectToShowHomes = () => {
            if (selectedMunicipio.value) {
                router.push({ 
                    name: 'list-inmubles', 
                    query: { 
                        municipio: selectedMunicipio.value, 
                        disponibilidad: selectedOption.value === 'comprar' ? 'Comprar' : 'Alquilar' 
                    } 
                });
            } else {
                router.push('/inmuebles');
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
            searchQuery.value = municipio;
            selectedMunicipio.value = municipio;
            filteredMunicipios.value = [];
        };

        const handleClickOutside = (event) => {
            if (!event.target.closest('.search-bar') && !event.target.closest('.municipios-dropdown')) {
                filteredMunicipios.value = [];
            }
        };

        onMounted(() => {
            fetchMunicipios();
            document.addEventListener('click', handleClickOutside);
        });

        onBeforeUnmount(() => {
            document.removeEventListener('click', handleClickOutside);
        });

        return {
            selectedOption,
            selectOption,
            redirectToHipoteca,
            redirectToPrecioCasa,
            redirectToShowHomes,
            searchQuery,
            filteredMunicipios,
            filterMunicipios,
            selectMunicipio,
            selectedMunicipio,
            handleClickOutside
        };
    }
};
</script>

<style>
/*CSS HOME */
.Banner {
    background-image: url("/images/Home/imagen_incio.png");
    text-align: center;
    background-size: cover;
    background-position: center;
    height: 440px;
}

.Banner h1 {
    margin-top: 120px;
    color: rgb(255, 255, 255);
}

.search-container {
    margin-top: 40px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.search-options {
    display: flex;
    justify-content: flex-start;
    width: 100%;
    max-width: 800px;
}

.option-button {
    background-color: white;
    padding: 10px 20px;
    width: 130px;
    height: 39px;
    cursor: pointer;
    border: none;
    position: relative;
}

.option-button.selected {
    background-color: #D3AC70;
    color: white;
    position: relative;
}

.option-button .triangle {
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 10px;
    height: 5px;
    fill: #D3AC70;
    z-index: 1010;
}

.search-bar {
    background-color: white;
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 800px;
    position: relative;
}

.search-input {
    margin-top: 20px;
    margin-bottom: 20px;
    margin-left: 35px;
    margin-right: 13px;
    width: 646px;
    padding: 10px;
    border: 1px solid #ccc;
    background-color: white;
    color: gray;
    box-shadow: 0 4px 2px -2px gray, 0 1px 1px rgba(0, 0, 0, 0.1);
}

.search-button {
    padding: 10px 20px;
    background-color: #835EAE;
    color: white;
    cursor: pointer;
    margin-right: 31px;
    margin-left: auto;
    border: none;
    box-shadow: 0 4px 2px -2px gray;
}

.search-button:hover {
    background-color: #64428C;
}

.Seccion1 {
    background-color: #F4F4FB;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0 80px;
}

.row {
    margin-left: 0;
    margin-right: 0;
    display: flex;
    align-items: center;
}

.bloque-hipoteca .row,
.bloque-casa .row,
.bloque-inmobiliaria .row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    width: 100%;
    margin-bottom: 60px; 
}

.bloque-casa .row {
    flex-direction: row-reverse;
}

.bloque-hipoteca .col-6 img,
.bloque-casa .col-6 img,
.bloque-inmobiliaria .col-6 img {
    width: 402px;
    height: 308px;
    margin-right: 40px; 
}

.bloque-hipoteca,
.bloque-casa,
.bloque-inmobiliaria {
    padding-top: 52px;
}

.text-section {
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 402px;
    margin-left: 40px; 
}

.icon-text {
    display: flex;
    align-items: center;
    margin-bottom: 18px;
}

.icon-image {
    width: 48px !important;
    height: 51px !important;
    margin-right: 10px;
}

.text-content {
    font-size: 20px;
}

.text-bold {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
}

.text-regular {
    font-size: 20px;
    margin-bottom: 20px;
}

.section-button {
    width: 281px;
    height: 48px;
    background-color: #835EAE;
    color: white;
    font-weight: bold;
    font-size: 20px;
    border: none;
    cursor: pointer;
    margin-top: 20px;
}

.section-button:hover {
    background-color: #64428C;
}

@media (max-width: 1000px) {
    .bloque-hipoteca .row,
    .bloque-casa .row,
    .bloque-inmobiliaria .row {
        flex-direction: column;
    }
    .bloque-hipoteca .col-6,
    .bloque-casa .col-6,
    .bloque-inmobiliaria .col-6 {
        width: 100%;
    }
    .bloque-hipoteca .col-6 img,
    .bloque-casa .col-6 img,
    .bloque-inmobiliaria .col-6 img {
        margin-bottom: 20px;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        max-width: 402px;
        height: auto;
    }
}

@media (max-width: 425px) {
    .bloque-hipoteca .row,
    .bloque-casa .row,
    .bloque-inmobiliaria .row {
        flex-direction: column;
        margin-left: 0;
        margin-right: 0;
    }
    .bloque-hipoteca .col-6,
    .bloque-casa .col-6,
    .bloque-inmobiliaria .col-6 {
        width: 100%;
        text-align: center;
    }
    .bloque-hipoteca .col-6 img,
    .bloque-casa .col-6 img,
    .bloque-inmobiliaria .col-6 img {
        margin-bottom: 20px;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        max-width: 402px;
        height: auto;
    }
}

.search-container .municipios-dropdown {
    position: absolute;
    top: calc(100% - 21px);
    left: 35px;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 620px; 
    padding: 0.5rem 0;
    margin: 0; 
    font-size: 1rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 0 0 0.25rem 0.25rem;
}

.search-container .municipios-dropdown.show {
    display: block;
}

.search-container .dropdown-item {
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

.search-container .dropdown-item:hover {
    background-color: #f8f9fa;
}

/*CSS HOME*/
@media (max-width: 425px) {
    .Seccion1 {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 0 10px; /* Reduce los márgenes laterales */
    }

    .bloque-hipoteca .row,
    .bloque-casa .row,
    .bloque-inmobiliaria .row {
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .bloque-hipoteca .col-6 img,
    .bloque-casa .col-6 img,
    .bloque-inmobiliaria .col-6 img {
        width: 100%;
        max-width: 300px; /* Ajusta el tamaño máximo de las imágenes */
        height: auto;
        margin-bottom: 20px;
    }

    .text-section {
        width: 100%;
        max-width: 300px; /* Alinea el ancho del texto con las imágenes */
        margin-left: 0;
        text-align: center;
    }

    .section-button {
        width: 100%;
        max-width: 300px; /* Ajusta el ancho del botón */
    }
}

@media (max-width: 768px) {
    .Banner h1 {
        margin-top: 80px;
        font-size: 24px;
        padding: 0 15px;
    }
    
    .search-container {
        width: 95%;
    }
    
    .search-options {
        width: 95%;
        
    }
    
    .search-bar {
        width: 95%;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .search-input {
        width: 90%;
        margin: 20px 5px 10px 5px;
    }
    
    .search-button {
        margin: 10px 5px 20px 5px;
    }
    
    .search-container .municipios-dropdown {
        top: calc(100% - 50px);
        left: 5%;
        width: 90%;
        min-width: auto;
    }
    
    .Seccion1 {
        padding: 0 20px;
    }
}

@media (max-width: 425px) {
    .Banner {
        height: 400px;
    }
    
    .Banner h1 {
        margin-top: 60px;
        font-size: 20px;
    }
    
    .search-container {
        width: 95%;
    }
    
    .option-button {
        width: 110px;
        padding: 10px 10px;
        font-size: 14px;
    }
    
    .search-bar {
        flex-direction: column;
        align-items: center;
    }
    
    .search-input {
        width: 90%;
        margin: 20px 0 10px 0;
    }
    
    .search-button {
        width: 90%;
        margin: 0 0 20px 0;
    }
    
    .Seccion1 {
        padding: 0 10px;
    }
    
    .text-section {
        width: 100%;
        max-width: 300px;
        margin-left: 0;
        text-align: center;
    }
    
    .section-button {
        width: 100%;
        max-width: 300px;
    }
    
    .bloque-hipoteca .col-6,
    .bloque-casa .col-6,
    .bloque-inmobiliaria .col-6 {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .icon-text {
        justify-content: center;
    }
    
    .text-content, .text-regular, .text-bold {
        text-align: center;
    }
}

/* Fix para el dropdown en todos los tamaños */
@media (max-width: 1024px) {
    .search-container .municipios-dropdown {
        min-width: auto;
        width: 90%;
        left: 5%;
    }
}
</style>
