<template>
    <div class="grid">
        <div class="col-12 md:col-4 lg:col-4 xl:col-4">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar">
                                <FileUpload
                                    name="picture"
                                    url="/api/users/updateimg"
                                    @before-upload="onBeforeUpload"
                                    @upload="onTemplatedUpload($event)"
                                    accept="image/*"
                                    :maxFileSize="1500000"
                                    @select="onSelectedFiles"
                                    pt:content:class="fu-content"
                                    pt:buttonbar:class="fu-header"
                                    pt:root:class="fu"
                                    class="fu"
                                >
                                    <template #header="{ chooseCallback, uploadCallback, clearCallback, files, uploadedFiles }">
                                        <div class="flex flex-wrap justify-content-between align-items-center flex-1 gap-2">
                                            <div class="flex gap-2">
                                                <Button @click="chooseCallback()" icon="pi pi-images" rounded outlined></Button>
                                                <Button @click="uploadEvent(uploadCallback, uploadedFiles)" icon="pi pi-cloud-upload" rounded outlined severity="success" :disabled="!files || files.length === 0"></Button>
                                                <Button @click="clearCallback()" icon="pi pi-times" rounded outlined severity="danger" :disabled="!files || files.length === 0"></Button>
                                            </div>
                                            <p class="mt-4 mb-0">Drag and drop files to here to upload.</p>
                                        </div>
                                    </template>

                                    <template #content="{ files, uploadedFiles, removeUploadedFileCallback, removeFileCallback }">
                                        <img v-if="files.length > 0" v-for="(file, index) of files" :key="file.name + file.type + file.size" role="presentation" :alt="file.name" :src="file.objectURL" class="object-fit-cover w-100 h-100 img-profile" />
                                        <div v-else>
                                            <img v-if="uploadedFiles.length > 0" :key="uploadedFiles[uploadedFiles.length-1].name + uploadedFiles[uploadedFiles.length-1].type + uploadedFiles[uploadedFiles.length-1].size" role="presentation" :alt="uploadedFiles[uploadedFiles.length-1].name" :src="uploadedFiles[uploadedFiles.length-1].objectURL" class="object-fit-cover w-100 h-100 img-profile" />
                                        </div>
                                    </template>

                                    <template #empty>
                                        <img v-if="user.avatar" :src=user.avatar alt="Avatar" class="object-fit-cover w-100 h-100 img-profile">
                                        <img v-if="!user.avatar" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Avatar Default" class="object-fit-cover w-100 h-100 img-profile">
                                    </template>
                                </FileUpload>
                            </div>

                            <h5 class="user-name">{{ user.name }}</h5>
                            <h6 class="user-email">{{ user.email }}</h6>
                        </div>

                        <div class="about">
                            <div class="form-group">
                                <label for="roles">Roles</label>
                                <MultiSelect id="roles" v-model="user.role_id" display="chip" :options="roleList" optionLabel="name" dataKey="id" placeholder="Seleciona los roles" appendTo="self" class="w-100" />
                            </div>

                            <div class="text-right">
                                <button :disabled="isLoading" class="btn btn-primary w-100" @click="submitForm">
                                    <div v-show="isLoading" class=""></div>
                                    <span v-if="isLoading">Processing...</span>
                                    <span v-else>Guardar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 md:col-8 lg:col-8 xl:col-8">
            <div class="card mb-3">
                <div class="card-body">
                    {{ user.avatar }}
                    <h6 class="mb-2 text-primary">Personal Details</h6>

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input v-model="user.name" type="text" class="form-control" id="name">
                        <div class="text-danger mt-1">{{ errors.name }}</div>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.name">
                                {{ message }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input v-model="user.telefono" type="text" class="form-control" id="telefono">
                        <div class="text-danger mt-1">{{ errors.telefono }}</div>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.telefono">
                                {{ message }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre_comercial">Nombre Comercial</label>
                        <input v-model="user.nombre_comercial" type="text" class="form-control" id="nombre_comercial">
                        <div class="text-danger mt-1">{{ errors.nombre_comercial }}</div>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.nombre_comercial">
                                {{ message }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input v-model="user.email" type="email" class="form-control" id="email">
                        <div class="text-danger mt-1">{{ errors.email }}</div>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.email">
                                {{ message }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input v-model="user.direccion" type="text" class="form-control" id="direccion">
                        <div class="text-danger mt-1">{{ errors.direccion }}</div>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.direccion">
                                {{ message }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="codigo_postal">Código Postal</label>
                        <input v-model="user.codigo_postal" type="text" class="form-control" id="codigo_postal">
                        <div class="text-danger mt-1">{{ errors.codigo_postal }}</div>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.codigo_postal">
                                {{ message }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="localidad">Localidad</label>
                        <input v-model="user.localidad" type="text" class="form-control" id="localidad">
                        <div class="text-danger mt-1">{{ errors.localidad }}</div>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.localidad">
                                {{ message }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select v-model="user.tipo" class="form-control" id="tipo">
                            <option :value="0">Usuario</option>
                            <option :value="1">Inmobiliaria</option>
                        </select>
                        <div class="text-danger mt-1">{{ errors.tipo }}</div>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.tipo">
                                {{ message }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input v-model="user.password" type="password" class="form-control" id="password">
                        <div class="text-danger mt-1">{{ errors.password }}</div>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.password">
                                {{ message }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <Toast />
</template>

<script setup>
import { onMounted, reactive, ref, watchEffect } from "vue";
import { useRoute } from "vue-router";
import { usePrimeVue } from 'primevue/config';
import useRoles from "@/composables/roles";
import useUsers from "@/composables/users";
import { useToast } from 'primevue/usetoast';

const $primevue = usePrimeVue();
const toast = useToast();
const { roleList, getRoleList } = useRoles();
const { updateUser, getUser, user: postData, createUserDB, deleteUserDB, changeUserPasswordDB, createUserProceduredDB, validationErrors, isLoading } = useUsers();

import { useForm, useField, defineRule } from "vee-validate";
import { required, min } from "@/validation/rules"
defineRule('required', required)
defineRule('min', min);

// Define a validation schema
const schema = {
    name: 'required',
    email: 'required',
    password: 'min:8'
}

// Create a form context with the validation schema
const { validate, errors, resetForm } = useForm({ validationSchema: schema })
// Define actual fields for validation
const { value: name } = useField('name', null, { initialValue: '' });
const { value: email } = useField('email', null, { initialValue: '' });
const { value: telefono } = useField('telefono', null, { initialValue: '' });
const { value: nombre_comercial } = useField('nombre_comercial', null, { initialValue: '' });
const { value: password } = useField('password', null, { initialValue: '' });
const { value: role_id } = useField('role_id', null, { initialValue: '', label: 'role' });
const { value: direccion } = useField('direccion', null, { initialValue: '' });
const { value: codigo_postal } = useField('codigo_postal', null, { initialValue: '' });
const { value: localidad } = useField('localidad', null, { initialValue: '' });
const { value: tipo } = useField('tipo', null, { initialValue: '' });

const user = reactive({
    name,
    email,
    telefono,
    nombre_comercial,
    password,
    role_id,
    direccion,
    codigo_postal,
    localidad,
    tipo
})

const route = useRoute()
function submitForm() {
    validate().then(form => { if (form.valid) updateUser(user) })
}

onMounted(() => {
    getRoleList()
    getUser(route.params.id)
})
// https://vuejs.org/api/reactivity-core.html#watcheffect
watchEffect(() => {
    user.id = postData.value.id
    user.name = postData.value.name
    user.email = postData.value.email
    user.telefono = postData.value.telefono
    user.nombre_comercial = postData.value.nombre_comercial
    user.role_id = postData.value.role_id
    user.avatar = postData.value.avatar
    user.direccion = postData.value.direccion
    user.codigo_postal = postData.value.codigo_postal
    user.localidad = postData.value.localidad
    user.tipo = postData.value.tipo
})

const totalSize = ref(0);
const totalSizePercent = ref(0);
const files = ref([]);

const onBeforeUpload = (event) => {
    event.formData.append('id', user.id)
};
const onRemoveTemplatingFile = (file, removeFileCallback, index) => {
    removeFileCallback(index);
    totalSize.value -= parseInt(formatSize(file.size));
    totalSizePercent.value = totalSize.value / 10;
};

const onClearTemplatingUpload = (clear) => {
    clear();
    totalSize.value = 0;
    totalSizePercent.value = 0;
};

const onSelectedFiles = (event) => {
    files.value = event.files;

    if (event.files.length > 1) {
        event.files = event.files.splice(0, event.files.length - 1);
    }

    files.value.forEach((file) => {
        totalSize.value += parseInt(formatSize(file.size));
    });
};

const uploadEvent = async (callback, uploadedFiles) => {
    totalSizePercent.value = totalSize.value / 10;
    await callback();
};

const createUserDBView = async (id) => {
    createUserDB(id).then(response => {
            toast.add({ severity: 'info', summary: 'Base de datos creada', detail: 'Base de datos creada correctamente.', life: 3000 });
        })
        .catch(error => {
            toast.add({ severity: 'warning', summary: 'Error al crear la base de datos', detail: error.response.data.message, life: 3000 });
            console.log(error.response.data.message)
        })
}

const changeUserPasswordDBView = async (id) => {
    changeUserPasswordDB(id).then(response => {
            toast.add({ severity: 'info', summary: 'Base de datos modificada', detail: 'Contraseña cambiada correctamente.', life: 3000 });
        })
        .catch(error => {
            toast.add({ severity: 'danger', summary: 'Error al cambiar la contraseña', detail: error.response.data.message, life: 3000 });
        })
}

const createUserProceduredDBView = async (id) => {
    createUserProceduredDB(id).then(response => {
            toast.add({ severity: 'info', summary: 'Base de datos creada', detail: 'Base de datos creada correctamente.', life: 3000 });
        })
        .catch(error => {
            toast.add({ severity: 'warning', summary: 'Error al crear la base de datos', detail: error.response.data.message, life: 3000 });
            console.log(error.response.data.message)
        })
}

const deleteUserDBView = async (id) => {
    deleteUserDB(id).then(response => {
            toast.add({ severity: 'info', summary: 'Base de datos creada', detail: 'Base de datos creada correctamente.', life: 3000 });
        })
        .catch(error => {
            toast.add({ severity: 'warning', summary: 'Error al crear la base de datos', detail: error.response.data.message, life: 3000 });
            console.log(error.response.data.message)
        })
}

const onTemplatedUpload = (event) => {
};

const formatSize = (bytes) => {
    const k = 1024;
    const dm = 3;
    const sizes = $primevue.config.locale.fileSizeTypes;

    if (bytes === 0) {
        return `0 ${sizes[0]}`;
    }

    const i = Math.floor(Math.log(bytes) / Math.log(k));
    const formattedSize = parseFloat((bytes / Math.pow(k, i)).toFixed(dm));

    return `${formattedSize} ${sizes[i]}`;
};
</script>

<style>
.fu-content {
    padding: 0px !important;
    border: 0px !important;
    border-radius: 6px;
}

.fu-header {
    border: 0px !important;
    border-radius: 6px;
}

.fu {
    display: flex;
    flex-direction: column-reverse;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
}

.img-profile {
    border-top-right-radius: 6px;
    border-top-left-radius: 6px;
    aspect-ratio: 1/1;
}

.form-group {
    margin-bottom: 1rem;
}

label {
    margin-bottom: 0.3rem;
}
</style>