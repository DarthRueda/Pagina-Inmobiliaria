<template>
    <router-link :to="'/vivienda/' + vivienda.id" class="card-link">
        <div class="card">
            <div class="card-img-container">
                <img class="card-img" :src="vivienda.image" alt="Card image cap">
                <div class="circle-container">
                    <svg class="card-circle" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="40" />
                        <image href="images/inmuebles/corazon.svg" x="22" y="22" height="56px" width="56px"/>
                    </svg>
                </div>
            </div>
            <div class="card-body">
                <div class="card-top">
                    <div class="card-content">
                        <div class="card-text-content">
                            <h4 class="card-title">{{ vivienda.tipo }} en {{ vivienda.localizacion }}</h4>
                            <h5 class="card-subtitle">{{ vivienda.dimensiones }}m2 - {{ vivienda.habitaciones }} habitaciones - {{ vivienda.banyos }} baños</h5>
                            <p class="card-text">{{ vivienda.descripcion }}</p>  
                        </div>
                    </div>
                    <h5 class="card-price">{{ vivienda.precio }}</h5>
                </div>
                <h6>Actualizado hace 6 dias</h6>
                <div class="card-logo">
                    <img src="images/inmuebles/logo.svg" alt="Inmobiliaria Logo" class="logo-img">
                </div>
            </div>
        </div>
    </router-link>
</template>

<script>
export default {
    name: 'CardInmueble',
    props: {
        vivienda: {
            type: Object,
            required: true
        }
    }
};
</script>

<style scoped>
.card-link {
    text-decoration: none;
    color: inherit;
}

.card {
    display: flex;
    flex-direction: row; 
    align-items: center; 
    width: 100%;
    gap: 20px; /* Espacio entre la imagen y el contenido */
    border: 1px solid #835EAE;
    border-radius: 0px !important;
    margin: 0;
    padding: 0;
    position: relative;
    margin-bottom: 15px; /* Add this line */
}

.card-img-container {
    display: flex;
    align-items: center;
    position: relative;
}

.card-img {
    width: 300px;
    height: 290px;
    background-color: #835EAE;
    object-fit: cover; 
    border-radius: 0px !important;
}

.circle-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: -20px; /* Adjust this value to position the circle next to the image */
}

.card-circle {
    width: 40px;
    height: 40px;
    fill: white;
    stroke: black;
    stroke-width: 1px;
    margin-top: -160px; /* Move the circle a bit to the top */
}

.card-body {
    display: flex;
    flex-direction: column;
    justify-content: center; 
    margin: 15px;
}

.card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    max-height: 170px;
}

.card-content {
    display: flex;
    align-items: center;
    max-width: 600px;
    width: 100%;
    max-height: 150px;
}

.card-text-content {
    display: flex;
    flex-direction: column;
}

.card-price {
    margin-top: -40px;
    font-size: 24px;
}

.card-text {
    max-height: 150px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3; /* Número máximo de líneas antes de cortar */
    line-clamp: 3; /* Número máximo de líneas antes de cortar */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    word-break: break-word; /* Asegura que las palabras largas se dividan */
    font-size: 14px;
    font-weight: normal;
}

.card-title {
    font-size: 16px;
}

.card-subtitle {
    font-size: 14px;
    font-weight: bold;
}

.card-logo {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    width: 100%;
    margin-top: 10px;
}

.logo-img {
    width: 112px;
    height: 47px;
}

.card-text, h6 {
    color: grey;
    transition: color 0.3s ease;
}

.card:hover .card-text, .card:hover h6 {
    color: black;
}
</style>