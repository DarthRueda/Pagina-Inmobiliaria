<template>
    <div class="panelusuario-page">
        <div class="panelusuario mt-50">
            <div class="row">
                <div class="col-md-3">
                    <PanelUsuarioOpciones/>
                </div>
                <div class="col-md-9">
                    <form @submit.prevent="submitForm">
                        <h1 class="mb-30">Panel de Usuario</h1>

                        <div class="form-group mb-50">
                            <label for="nombre">Nombre</label>
                            <input 
                                type="text" 
                                id="nombre" 
                                class="form-control" 
                                v-model="profile.name" 
                                :disabled="!isEditing"
                            >
                            <div class="text-danger mt-1">{{ errors.name }}</div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.name" :key="message">
                                    {{ message }}
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="email">Email</label>
                                <input 
                                    type="text" 
                                    id="email" 
                                    class="form-control" 
                                    v-model="profile.email" 
                                    disabled
                                >
                                <div class="text-danger mt-1">{{ errors.email }}</div>
                                <div class="text-danger mt-1">
                                    <div v-for="message in validationErrors?.email" :key="message">
                                        {{ message }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="telefono">Teléfono</label>
                                <input 
                                    type="text" 
                                    id="telefono" 
                                    class="form-control" 
                                    v-model="profile.telefono" 
                                    :disabled="!isEditing"
                                >
                                <div class="text-danger mt-1">{{ errors.telefono }}</div>
                                <div class="text-danger mt-1">
                                    <div v-for="message in validationErrors?.telefono" :key="message">
                                        {{ message }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fondo Section -->
                        <div v-if="profile.tipo === 1" class="form-group mb-50">
                            <label for="fondo">Fondo</label>
                            <input 
                                type="file" 
                                id="fondo" 
                                class="form-control" 
                                @change="uploadFondo"
                                :disabled="!isEditing"
                            >
                            <img v-if="profile.fondo" :src="profile.fondo" alt="Fondo" class="img-thumbnail mt-2" />
                        </div>

                        <!-- Logo Section -->
                        <div v-if="profile.tipo === 1" class="form-group mb-50">
                            <label for="logo">Logo</label>
                            <input 
                                type="file" 
                                id="logo" 
                                class="form-control" 
                                @change="uploadLogo"
                                :disabled="!isEditing"
                            >
                            <img v-if="profile.logo" :src="profile.logo" alt="Logo" class="img-thumbnail mt-2" />
                        </div>

                        <div class="mb-3 mt-4">
                            <button v-if="!isEditing" class="btn btn-warning" @click="enableEditing">
                                Editar
                            </button>
                            <div v-if="isEditing">
                                <button :disabled="isLoading" class="btn btn-primary">
                                    <div v-show="isLoading"></div>
                                    <span v-if="isLoading">Procesando...</span>
                                    <span v-else>Actualizar</span>
                                </button>
                                <button type="button" class="btn btn-secondary ml-2" @click="cancelEditing">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, reactive, watchEffect } from "vue";
import { useForm, useField, defineRule } from "vee-validate";
import { required, min } from "@/validation/rules";
import useProfile from "@/composables/profile";
import PanelUsuarioOpciones from "@/components/PanelUsuarioOpciones.vue";


defineRule("required", required);
defineRule("min", min);


const schema = {
    name: "required|min:3",
    email: "required",
};


const { validate, errors } = useForm({ validationSchema: schema });
const { value: name } = useField("name", null, { initialValue: "" });
const { value: email } = useField("email", null, { initialValue: "" });
const { value: telefono } = useField("telefono", null, { initialValue: "" });


const { profile: profileData, getProfile, updateProfile, validationErrors, isLoading } = useProfile();


const profile = reactive({
    name,
    email,
    telefono,
});


const originalProfile = reactive({
    name: "",
    email: "",
    telefono: "",
});


const isEditing = ref(false);


onMounted(() => {
    getProfile();
});


watchEffect(() => {
    profile.name = profileData.value.name;
    profile.email = profileData.value.email;
    profile.telefono = profileData.value.telefono;
    profile.tipo = profileData.value.tipo;

    originalProfile.name = profileData.value.name;
    originalProfile.email = profileData.value.email;
    originalProfile.telefono = profileData.value.telefono;
});


function submitForm() {
    validate().then((form) => {
        if (form.valid) updateProfile(profile);
    });
}


function enableEditing() {
    isEditing.value = true;
}

function cancelEditing() {
    profile.name = originalProfile.name;
    profile.email = originalProfile.email;
    profile.telefono = originalProfile.telefono;
    isEditing.value = false;
}

// Fondo y logo
async function uploadFondo(event) {
    const file = event.target.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('fondo', file);

        try {
            const response = await axios.post('/api/user/upload-fondo', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
            profile.fondo = response.data.fondo_url;
        } catch (error) {
            console.error('Error uploading fondo:', error);
        }
    }
}

async function uploadLogo(event) {
    const file = event.target.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('logo', file);

        try {
            const response = await axios.post('/api/user/upload-logo', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
            profile.logo = response.data.logo_url;
        } catch (error) {
            console.error('Error uploading logo:', error);
        }
    }
}
</script>

<style scoped>
.panelusuario-page {
    display: flex;
    flex-direction: column;
    min-height: 60vh; /* Asegura que la página ocupe toda la altura de la ventana */
}

.panelusuario {
    flex: 1; /* Hace que el contenido principal ocupe el espacio disponible */
}

.row {
    margin-right: 0;
    margin-left: 0;
}

.form-group {
    margin-bottom: 15px;
}
.form-control {
    width: 100%;
}
.form-row {
    display: flex;
    justify-content: space-between;
    width: 100%;
}
.form-group.col-6 {
    width: 48%;
    padding: 0;
}
.ml-20 {
    margin-left: 20px;
    width: 23%;
}
.mt-50 {
    margin-top: 50px;
}
.mb-30 {
    margin-bottom: 30px;
}
.mb-50 {
    margin-bottom: 50px;
}
.ml-2 {
    margin-left: 10px;
}

.form-control:disabled {
    background-color: #e9ecef;
    color: #6c757d;
    cursor: not-allowed;
    user-select: none;
    border: 1px solid #ced4da;
}

.form-control:not(:disabled) {
    background-color: #fff;
    color: #000;
    cursor: text;
    user-select: auto;
}

@media (min-width: 768px) {
    .col-md-3, .col-md-9 {
        float: none;
    }
}
</style>
