<!-- <template>
    <div class="panelusuario mt-50">
        <div class="row">
            <div class="col-3 ml-20">
                <div class="options-box">
                    <div class="option">
                        <a href="/test">
                            <img src="/images/panelusuario/casa.svg" alt="icon" width="27" height="27">
                            <span>Mis propiedades</span>
                        </a>
                    </div>
                    <div class="option">
                        <a href="/favoritos">
                            <img src="/images/panelusuario/corazon.svg" alt="icon" width="27" height="27">
                            <span>Favoritos</span>
                        </a>
                    </div>
                    <div class="option">
                        <a href="/editar-datos">
                            <img src="/images/panelusuario/usuario.svg" alt="icon" width="27" height="27">
                            <span>Editar mis datos</span>
                        </a>
                    </div>
                    <div class="option">
                        <a href="/eliminar-cuenta">
                            <img src="/images/panelusuario/papelera.svg" alt="icon" width="27" height="27">
                            <span>Eliminar Cuenta</span>
                        </a>
                    </div>
                </div>
            </div>
            <form @submit.prevent="submitForm" class="col-9">
                    <h1 class="mb-30">Panel de Usuario</h1>

                    <div class="form-group mb-50">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" class="form-control" v-model="profile.name">
                        <div class="text-danger mt-1">
                            {{ errors.name }}
                        </div>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.name">
                                {{ message }}
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="email">Email</label>
                            <input type="text" id="email" class="form-control" v-model="profile.email">
                            <div class="text-danger mt-1">
                                {{ errors.email }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.email">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="telefono">Teléfono</label>
                            <input type="text" id="telefono" class="form-control" v-model="profile.telefono">
                            <div class="text-danger mt-1">
                                {{ errors.telefono }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.telefono">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 mt-4">
                        <button :disabled="isLoading" class="btn btn-primary">
                            <div v-show="isLoading"></div>
                            <span v-if="isLoading">Procesando...</span>
                            <span v-else>Actualizar</span>
                        </button>
                    </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { onMounted, reactive, watchEffect } from "vue";
import { useForm, useField, defineRule } from "vee-validate";
import { required, min } from "@/validation/rules";
import useProfile from "@/composables/profile";

defineRule('required', required);
defineRule('min', min);

const schema = {
    name: 'required|min:3',
    email: 'required',
};

const { validate, errors } = useForm({ validationSchema: schema });
const { value: name } = useField('name', null, { initialValue: '' });
const { value: email } = useField('email', null, { initialValue: '' });
const { value: telefono } = useField('telefono', null, { initialValue: '' });

const { profile: profileData, getProfile, updateProfile, validationErrors, isLoading } = useProfile();

const profile = reactive({
    name,
    email,
    telefono,
});

onMounted(() => {
    getProfile();
});

watchEffect(() => {
    profile.name = profileData.value.name;
    profile.email = profileData.value.email;
    profile.telefono = profileData.value.telefono;
});

function submitForm() {
        validate().then(form => { if (form.valid) updateProfile(profile) })
    }
</script>

<style scoped>
.row {
    margin-right: 0;
    margin-left: 0;
}
.options-box {
    border: 1px solid #ccc;
    padding: 10px;
}
.option {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}
.option img {
    margin-right: 10px;
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
</style> -->


<template>
    <div class="panelusuario mt-50">
        <div class="row">
            <div class="col-3 ml-20">
                <div class="options-box">
                    <div class="option">
                        <a href="/test">
                            <img src="/images/panelusuario/casa.svg" alt="icon" width="27" height="27" />
                            <span>Mis propiedades</span>
                        </a>
                    </div>
                    <div class="option">
                        <a href="/favoritos">
                            <img src="/images/panelusuario/corazon.svg" alt="icon" width="27" height="27" />
                            <span>Favoritos</span>
                        </a>
                    </div>
                    <div class="option">
                        <a href="#" @click.prevent="enableEditing">
                            <img src="/images/panelusuario/usuario.svg" alt="icon" width="27" height="27" />
                            <span>Editar mis datos</span>
                        </a>
                    </div>
                    <div class="option">
                        <a href="/eliminar-cuenta">
                            <img src="/images/panelusuario/papelera.svg" alt="icon" width="27" height="27" />
                            <span>Eliminar Cuenta</span>
                        </a>
                    </div>
                </div>
            </div>
            <form @submit.prevent="submitForm" class="col-9">
                <h1 class="mb-30">Panel de Usuario</h1>

                <div class="form-group mb-50">
                    <label for="nombre">Nombre</label>
                    <input
                        type="text"
                        id="nombre"
                        class="form-control"
                        v-model="profile.name"
                        :readonly="!isEditing"
                        :tabindex="!isEditing ? -1 : 0"
                        @focus="onFocus($event)"
                    />
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
                        <!-- El email siempre es readonly -->
                        <input
                            type="text"
                            id="email"
                            class="form-control"
                            v-model="profile.email"
                            readonly
                            tabindex="-1"
                            @focus="onFocus($event)"
                        />
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
                            :readonly="!isEditing"
                            :tabindex="!isEditing ? -1 : 0"
                            @focus="onFocus($event)"
                        />
                        <div class="text-danger mt-1">{{ errors.telefono }}</div>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.telefono" :key="message">
                                {{ message }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 mt-4" v-if="isEditing">
                    <button :disabled="isLoading" class="btn btn-primary">
                        <div v-show="isLoading"></div>
                        <span v-if="isLoading">Procesando...</span>
                        <span v-else>Actualizar</span>
                    </button>
                    <button type="button" class="btn btn-secondary ml-2" @click="cancelEditing">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, reactive, watchEffect } from "vue";
import { useForm, useField, defineRule } from "vee-validate";
import { required, min } from "@/validation/rules";
import useProfile from "@/composables/profile";

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
  // Restaurar valores originales y desactivar edición
  profile.name = originalProfile.name;
  profile.email = originalProfile.email;
  profile.telefono = originalProfile.telefono;
  isEditing.value = false;
}

// Si no se está en edición, forzamos que el input pierda el foco
function onFocus(event) {
  if (!isEditing.value) {
    event.target.blur();
  }
}
</script>

<style scoped>
/* Estilos generales */
.row {
  margin-right: 0;
  margin-left: 0;
}
.options-box {
  border: 1px solid #ccc;
  padding: 10px;
}
.option {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}
.option img {
  margin-right: 10px;
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

/* Estilos para campos readonly */
.form-control[readonly] {
  background-color: #e9ecef; /* Gris claro */
  color: #6c757d; /* Texto gris */
  cursor: not-allowed; /* Muestra el icono de prohibido */
  user-select: none; /* Impide la selección de texto */
  border: 1px solid #ced4da;
}

/* Estilos para campos editables */
.form-control:not([readonly]) {
  background-color: #fff;
  color: #000;
  cursor: text;
  user-select: auto;
}
</style>

