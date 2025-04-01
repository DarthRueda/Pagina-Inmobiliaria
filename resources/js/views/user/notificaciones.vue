<template>
    <div class="panelusuario mt-50">
        <div class="row">
            <div class="col-md-3">
                <PanelUsuarioOpciones />
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div v-if="notifications.length > 0" class="col-9">
                        <h3>Notificaciones</h3>
                        <div
                            v-for="(notification, index) in notifications"
                            :key="index"
                            class="notification-card"
                            :class="{ 'no-leida': !notification.leida }"
                            @click="markAsRead(notification)"
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
import axios from "axios";

export default {
    components: {
        PanelUsuarioOpciones,
    },
    data() {
        return {
            userProfile: null,
            notifications: [],
        };
    },
    async mounted() {
        await this.getProfile();
        await this.getNotifications();
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
        }
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
    cursor: pointer;
    transition: background-color 0.3s;
}

/* Notificaciones no leídas resaltadas en rojo */
.notification-card.no-leida {
    background-color: #ffdddd;
    border-left: 5px solid red;
}
</style>
