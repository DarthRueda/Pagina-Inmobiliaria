<template>
    <div class="inmobiliaria">
        <ImageInmobiliaria />
        <InfoInmobiliaria :info="inmobiliaria" />
        <div class="container">
            <div class="list-inmuebles col-md-9">
                <!-- Display viviendas using CardInmuebles -->
                <CardInmuebles
                    v-for="vivienda in viviendas"
                    :key="vivienda.id"
                    :vivienda="vivienda"
                    class="card-inmueble"
                />
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import ImageInmobiliaria from '@/components/ImageInmobiliaria.vue';
import InfoInmobiliaria from '@/components/InfoInmobiliaria.vue';
import CardInmuebles from '@/components/CardInmueble.vue';
import axios from 'axios';

export default {
    name: 'Inmobiliaria',
    components: {
        ImageInmobiliaria,
        InfoInmobiliaria,
        CardInmuebles,
    },
    setup() {
        const route = useRoute();
        const inmobiliaria = ref(null);
        const viviendas = ref([]);

        const fetchInmobiliaria = async (id) => {
            try {
                const response = await axios.get(`/api/inmobiliaria/${id}`);
                inmobiliaria.value = response.data.inmobiliaria;
                viviendas.value = response.data.viviendas;
            } catch (error) {
                console.error('Error fetching inmobiliaria:', error);
            }
        };

        onMounted(() => {
            const id = route.params.id;
            fetchInmobiliaria(id);
        });

        return {
            inmobiliaria,
            viviendas,
        };
    },
};
</script>

<style scoped>
.container {
    margin-top: 20px;
}
.list-inmuebles {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}
.card-inmueble {
    flex: 1 1 calc(33.333% - 20px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}
</style>