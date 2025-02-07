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
                <div class="search-bar">
                    <input type="text" placeholder="Ubicación" class="search-input">
                    <button class="search-button"><b>Buscar</b></button>
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
                    <button class="section-button">¡Haz tu simulación ahora!</button>
                </div>
            </div>
        </div>
        <div class="bloque-casa">
            <div class="row">
                <div class="col-6 text-section">
                    <div class="icon-text">
                        <img src="/images/Home/etiqueta.png" class="icon-image">
                        <span class="text-content">Calcula cuanto vale tu casa</span>
                    </div>
                    <span class="text-bold">Quanto vale mi casa?</span>
                    <span class="text-regular">Calcula su precio según las características y otros pisos de la zona. Acompañarte es darte todas las herramientas gratuitas.</span>
                    <button class="section-button">¡Valora tu vivienda ahora!</button>
                </div>
                <div class="col-6">
                    <img src="/images/Home/casa.png" class="bloque-image">
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

<style>
/*CSS HOME */
.Banner {
    background-image: url("/images/Home/imagen_incio.png");
    text-align: center;
    background-size: cover;
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
}

.search-bar {
    background-color: white;
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 800px;
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
    margin-left: 80px;
    margin-right: 80px;
}

.bloque-hipoteca .col-6 img,
.bloque-casa .col-6 img,
.bloque-inmobiliaria .col-6 img {
    width: 402px;
    height: 308px;
    margin-left: 0;
}

.bloque-hipoteca,
.bloque-casa,
.bloque-inmobiliaria {
    padding-top: 52px;
}

.text-section {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
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
</style>
<script>
export default {
    data() {
        return {
            selectedOption: 'comprar'
        };
    },
    methods: {
        selectOption(option) {
            this.selectedOption = option;
        }
    }
};
</script>