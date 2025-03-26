import { ref } from 'vue';
import axios from 'axios';

export default function useLikes() {
    const likes = ref([]);


    const getLikes = async (userId) => {
        try {
            const response = await axios.get(`/api/likes/${userId}`);
            likes.value = response.data;
        } catch (error) {
            console.error("Error al obtener likes:", error);
        }
    }

    const checkLike = async (userId, viviendaId) => {
        try {
            const response = await axios.get(`/api/likes/check/${userId}/${viviendaId}`);
            return response.data.liked;
        } catch (error) {
            console.error("Error al verificar like:", error);
            return false;
        }
    };

    const toggleLike = async (userId, viviendaId) => {
        try {
            const response = await axios.post('/api/likes/toggle', { userId, viviendaId });
            return response.data.liked;
        } catch (error) {
            console.error("Error al dar like:", error);
            return false;
        }
    };

    return { likes, checkLike, toggleLike, getLikes };
}
