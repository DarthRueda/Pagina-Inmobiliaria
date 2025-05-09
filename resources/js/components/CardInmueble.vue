<template>
    <div class="card">
        <div class="like-container">
            <button @click.stop="darLike" class="like-button">
                <svg class="card-circle" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="40" />
                    <image :href="isLiked ? '/images/inmuebles/corazon-lleno.png' : '/images/inmuebles/corazon.svg'" 
                        x="22" y="22" height="56px" width="56px"/>
                </svg>
            </button>
        </div>
        <router-link :to="'/vivienda/' + vivienda.id" class="card-link">
            <div class="card-img-container">
                <img v-if="vivienda.image" class="card-img" :src="vivienda.image" alt="Card image cap">
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
                    <h5 class="card-price">
                        {{ vivienda.precio }}<span v-if="vivienda.disponibilidad === 'Alquilar'">/mes</span>
                    </h5>
                </div>
                <!-- Display the time since update -->
                <h6>{{ timeSinceCreation }}</h6>
            </div>
        </router-link>
        <router-link
            v-if="userTipo === 1 && userLogo"
            :to="'/inmobiliaria/' + vivienda.id_usuario"
            class="card-logo-link"
        >
            <div class="card-logo">
                <img :src="userLogo" alt="Inmobiliaria Logo" class="logo-img">
            </div>
        </router-link>
    </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import useProfile from "@/composables/profile";
import useLikes from "@/composables/likes";
import axios from 'axios';

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
        const userTipo = ref(null);
        const userLogo = ref(null);

        // Calculate the time since update
        const timeSinceCreation = computed(() => {
            const updatedAt = new Date(vivienda.value.updated_at); // Use updated_at instead of created_at
            const now = new Date();
            const diffInMs = now - updatedAt;
            const diffInHours = Math.floor(diffInMs / (1000 * 60 * 60));
            const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));

            if (diffInDays > 0) {
                return `Actualizado hace ${diffInDays} día${diffInDays > 1 ? 's' : ''}`;
            } else {
                return `Actualizado hace ${diffInHours} hora${diffInHours > 1 ? 's' : ''}`;
            }
        });

        onMounted(async () => {
            if (userId.value) {
                isLiked.value = await checkLike(userId.value, viviendaId.value);
            }

            // Fetch el tipo y logo del usuario
            fetchUserTipoAndLogo(vivienda.value.id_usuario);
        });

        const fetchUserTipoAndLogo = async (userId) => {
            try {
                const response = await axios.get(`/api/user/tipo/${userId}`);
                userTipo.value = response.data.tipo;
                userLogo.value = response.data.logo; // Guarda el logo del usuario
            } catch (error) {
                console.error('Error fetching user tipo and logo:', error);
            }
        };

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

        return { isLiked, darLike, vivienda, userTipo, userLogo, timeSinceCreation };
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
    z-index: 1; 
}

.card {
    border: 1px solid #835EAE;
    border-radius: 0px !important;
    margin: 0;
    padding: 0;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Stronger shadow */
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
    -webkit-line-clamp: 3;
    line-clamp: 3; 
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    word-break: break-word;
    font-size: 14px;
    font-weight: normal;
}

.card-title {
    font-size: 25px;
}

.card-subtitle {
    font-size: 14px;
    font-weight: bold;
}

.card-logo-link {
    text-decoration: none;
    position: absolute;
    bottom: 10px;
    right: 10px;
    z-index: 5;
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
    object-fit: contain;
}

.card-text, h6 {
    color: grey;
    transition: color 0.3s ease;
}

.card:hover .card-text, .card:hover h6 {
    color: black;
}
@media (max-width: 500px) {
    .card{
        width: 117%;
    }
    .card-title {
        font-size: 15px;
    }
    .card-img{
        width: 180px;
    }
    .like-container {
        left: 215px;
    }
    .card-price {
        font-size: 18px;
    }

}

@media (max-width: 400px) {
    .card{
        width: 117%;
    }
    .card-img{
        width: 160px;
    }
    .like-container {
        left: 195px;
    }
    .card-price {
        font-size: 17px;
    }
}
</style>