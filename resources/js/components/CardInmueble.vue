<template>
    <div class="card">
        <img class="card-img" src="" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Casa en Molins de Rei</h5>
            <p class="card-text">Estupendisima casa con cocina, salón, comedor, habitaciones, suelo nuevo, paredes e incluso techo y puertas,
                no te lo pierdas, es una oportunidad única.
            </p>
            <h5>340.000</h5>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CardInmueble',
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
}
</style>
