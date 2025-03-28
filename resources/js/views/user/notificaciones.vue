<template>
    <div class="panelusuario mt-50">
        <div class="row">
            <!-- Columna para las opciones -->
            <div class="col-md-3">
                <PanelUsuarioOpciones />
            </div>
            <!-- Columna para el contenido -->
            <div class="col-md-9">
                <div class="row">
                    <!-- Notificaciones -->
                    <div v-if="notifications.length > 0" class="col-9">
                        <h3>Notificaciones</h3>
                        <div
                            v-for="(notification, index) in notifications"
                            :key="index"
                            class="notification-card"
                        >
                            <p>{{ notification.mensaje }}</p>
                        </div>
                    </div>
                    <div v-else class="col-12">
                        <p>No tienes notificaciones.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PanelUsuarioOpciones from "@/components/PanelUsuarioOpciones.vue";
import useProfile from "@/composables/profile";
import axios from "axios"; // Importar axios para hacer las solicitudes HTTP

export default {
    components: {
        PanelUsuarioOpciones,
    },
    data() {
        return {
            userProfile: null, // Guardar el perfil del usuario
            notifications: [], // Almacenar las notificaciones
        };
    },
    async mounted() {
        await this.getProfile();
        await this.getNotifications(); // Obtener las notificaciones cuando el componente se monta
    },
    methods: {
        // Método para obtener el perfil del usuario
        async getProfile() {
            const { profile, getProfile } = useProfile();
            await getProfile(); // Obtener el perfil del usuario
            this.userProfile = profile.value; // Guardamos el perfil en el componente
        },

        // Método para obtener las notificaciones del usuario
        async getNotifications() {
            try {
                const userId = this.userProfile.id; // Usamos el ID del perfil del usuario
                const response = await axios.get(`/api/notificaciones/${userId}`);
                this.notifications = response.data; // Asignamos las notificaciones al array
            } catch (error) {
                console.error("Error al obtener las notificaciones:", error);
            }
        },
    },
};
</script>

<style scoped>
.notification-card {
    background-color: #f8f9fa;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
}

.notification-card p {
    margin: 0;
    font-size: 14px;
    color: #333;
}

h3 {
    font-size: 18px;
    color: #333;
    margin-bottom: 20px;
}
</style>
