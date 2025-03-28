<template>
        <div class="card">
            <div class="like-container">
                <button @click.stop="darLike" class="like-button">
                    <svg class="card-circle" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="40" />
                        <image :href="isLiked ? 'images/inmuebles/corazon-lleno.png' : 'images/inmuebles/corazon.svg'" 
                            x="22" y="22" height="56px" width="56px"/>
                    </svg>
                </button>
            </div>
            <router-link :to="'/vivienda/' + vivienda.id" class="card-link">
                <div class="card-img-container">
                    <img class="card-img" :src="vivienda.image" alt="Card image cap">
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
            </router-link>
        </div>
    
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import useProfile from "@/composables/profile";
import useLikes from "@/composables/likes";

export default {
    name: 'CardInmueble',
    props: {
        vivienda: {
            type: Object,
            required: true
        }
    },
    setup(props, { emit }) {
        const { profile } = useProfile();
        const { toggleLike, checkLike } = useLikes();
        
        const userId = computed(() => profile.value?.id);
        const viviendaId = computed(() => props.vivienda.id);
        const isLiked = ref(false);
        const vivienda = ref(props.vivienda);

        onMounted(async () => {
            if (userId.value) {
                isLiked.value = await checkLike(userId.value, viviendaId.value);
            }
        });

        const darLike = async () => {
            if (!userId.value) {
                alert("Debes estar logueado para dar like.");
                return;
            }

            isLiked.value = await toggleLike(userId.value, viviendaId.value);

            // Emitir evento de eliminación de like
            if (!isLiked.value) {
                emit('removeLike', props.vivienda.id); // Emitir el ID de la vivienda
            }
        };

        return { isLiked, darLike, vivienda };
    }
};
</script>



<style scoped>
.card-link {
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: row; 
    align-items: center; 
    width: 100%;
    margin: 0;
    padding: 0;
    position: relative;
    z-index: 1; /* Asegura que el enlace esté por debajo del botón */

}

.card {
    border: 1px solid #835EAE;
    border-radius: 0px !important;
    margin: 0;
    padding: 0;
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

.like-container {
    position: absolute;
    top: 25px;
    left: 335px;
    z-index: 10; 
    pointer-events: auto;
}

.like-button {
  background: none;
  border: none;
  cursor: pointer;
  position: absolute;
  top: 10px;
  right: 10px;
}

.card-circle {
  width: 40px;
  height: 40px;
  fill: white;
  stroke: #835EAE;
  stroke-width: 1px;
}

.like-button:hover {
  transform: scale(1.1);

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