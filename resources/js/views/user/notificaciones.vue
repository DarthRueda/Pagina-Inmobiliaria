<template>
    <div class="container-fluid mt-5">
        <div class="row">
            <!-- Panel de opciones del usuario -->
            <div class="col-md-3">
                <PanelUsuarioOpciones />
            </div>
            <!-- Contenido de notificaciones -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12">
                        <h3>Notificaciones</h3>
                        <div v-if="notifications.length > 0">
                            <div 
                                v-for="(notification, index) in notifications.slice().reverse()"
                                :key="index"
                                class="card p-3 mb-3 notification-card"
                                :class="{ 'no-leida': !notification.leida }"
                                @click="markAsRead(notification)"
                            >
                                <p class="mb-0">{{ notification.mensaje }}</p>
                            </div>
                        </div>
                        <div v-else class="alert alert-info">No tienes notificaciones.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PanelUsuarioOpciones from "@/components/PanelUsuarioOpciones.vue";
import useProfile from "@/composables/profile";
import axios from "axios";

export default {
    components: {
        PanelUsuarioOpciones,
    },
    data() {
        return {
            userProfile: null, // Información del perfil del usuario
            notifications: [], // Lista de notificaciones
        };
    },
    async mounted() {
        await this.getProfile(); // Obtiene el perfil del usuario
        await this.getNotifications(); // Obtiene las notificaciones del usuario
    },
    methods: {
        async getProfile() {
            const { profile, getProfile } = useProfile();
            await getProfile();
            this.userProfile = profile.value;
        },
        async getNotifications() {
            try {
                const userId = this.userProfile.id;
                const response = await axios.get(`/api/notificaciones/${userId}`);
                this.notifications = response.data;
            } catch (error) {
                console.error("Error al obtener las notificaciones:", error);
            }
        },
        async markAsRead(notification) {
            if (!notification.leida) {
                try {
                    await axios.post(`/api/notificaciones/${notification.id}/leida/${this.userProfile.id}`);
                    notification.leida = true; // Actualiza el estado en el frontend
                } catch (error) {
                    console.error("Error al marcar como leída:", error);
                }
            }
        },
    },
};
</script>

<style scoped>
.notification-card {
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    cursor: pointer;
    transition: background-color 0.3s;
}

.notification-card.no-leida {
    background-color: #ddf3ff;
    border-left: 5px solid rgb(0, 191, 255);
}
</style>
