<template>
    <div class="card">
        <img class="card-img" src="" alt="Card image cap">
        <div class="card-body">
            <div class="card-top">
                <div class="card-content">
                    <div class="card-text-content">
                        <h5 class="card-title">Casa en Molins de Rei</h5>
                        <p class="card-text">Estupendisima casa con cocina, salón, comedor, habitaciones, suelo nuevo, paredes e incluso techo y puertas,
                            no te lo pierdas, es tupendisima casa con cocina, salón, comedor, habitaciones, suelo nuevo, paredes e incluso techo y puertas,
                            no te lo pierdas, es una oportunidad únicaEstupendisima casa con cocina, salón, comedor, habitaciones, suelo nuevo, paredes e incluso techo y puertas,
                            no te lo pierdas, es una oportunidad única</p>  
                    </div>
                </div>
                <h5 class="card-price">340.000</h5>
            </div>
            <h6>Inmobiliaria Me quiero ir a casa </h6>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CardInmueble',
    methods: {
        handleButtonClick() {
            alert('¡Botón clickeado!');
        }
    }
}
</script>

<style scoped>
.card {
    display: flex;
    flex-direction: row; 
    align-items: center; 
    width: 1200px;
    gap: 20px; /* Espacio entre la imagen y el contenido */
    border: 1px solid #835EAE;
    border-radius: 0px !important;
    margin: 0;
    padding: 0;
    position: relative; /* Para posicionar el círculo */
}

.card::before {
    content: "";
    width: 40px; /* Tamaño del círculo */
    height: 40px;
    background-color: white; /* Color de fondo del círculo */
    border: 1px solid black;
    border-radius: 50%; /* Para hacerlo circular */
    position: absolute; /* Para posicionar el círculo */
    left: 280px; /* Ajusta la posición respecto a la imagen */
    top: 10%; /* Ajusta la posición respecto a la imagen */
    z-index: 2; /* Para que esté por encima de la imagen */
    display: flex;
    justify-content: center;
    align-items: center;
    background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAiIGhlaWdodD0iMzAiIHZpZXdCb3g9InhtbG5zOnZpZGVvL3htbG5zLWFuY2hvcj0ibm9uZSIgeG1sbnM9Imh0dHBzOi8vZGV2ZWxvcGVycy5vcmcvbmlmZXN0eS8yMDEzMDAxIj4KPHBhdGggZD0iTTEuNTg2IDMuMDY4TDQuNTg2IDIuNzA4TDExLjUwNCAxMi4yNTQiIHoiLz4KPC9zdmc+Cg=='); /* Aquí pones tu SVG codificado en Base64 */
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    cursor: pointer; /* Cambiar el cursor a 'pointer' para que se vea como un botón */
}

.card-img {
    width: 300px;
    height: 200px;
    background-color: #835EAE;
    object-fit: cover; 
    border-radius: 0px !important;
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
    margin: 30px;
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
}
</style>
