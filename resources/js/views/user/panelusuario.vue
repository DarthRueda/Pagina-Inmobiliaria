<template>
    <div class="panelusuario mt-50">
        <div class="row">
            <div class="col-3 ml-20">
                <div class="options-box">
                    <div class="option">
                        <img src="/images/panelusuario/casa.svg" alt="icon" width="27" height="27">
                        <span>Mis propiedades</span>
                    </div>
                    <div class="option">
                        <img src="/images/panelusuario/corazon.svg" alt="icon" width="27" height="27">
                        <span>Favoritos</span>
                    </div>
                    <div class="option">
                        <img src="/images/panelusuario/usuario.svg" alt="icon" width="27" height="27">
                        <span>Editar mis datos</span>
                    </div>
                    <div class="option">
                        <img src="/images/panelusuario/papelera.svg" alt="icon" width="27" height="27">
                        <span>Eliminar Cuenta</span>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <h1 class="mb-30">Panel de Usuario</h1>
                <div class="form-group mb-50">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" class="form-control" v-model="profile.name">
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="input1">Email</label>
                        <input type="text" id="email" class="form-control" v-model="profile.email">
                    </div>
                    <div class="form-group col-6">
                        <label for="input2">Telefono</label>
                        <input type="text" id="telefono" class="form-control" v-model="profile.telefono">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    // import { onMounted, ref } from 'vue';
    // import useAuth from '../../composables/auth';

    // const { getUser, user } = useAuth();

    // const usuario = ref({
    // name: '',
    // email: '',
    // telefono: ''
    // });

    // onMounted(async () => {
    // await getUser();
    // usuario.value.name = user.name;
    // usuario.value.email = user.email;
    // usuario.value.telefono = user.telefono;
    // });
    import { onMounted, reactive, watchEffect } from "vue";
    import { useForm, useField, defineRule } from "vee-validate";
    import { required, min } from "@/validation/rules"
    import useProfile from "@/composables/profile";
    defineRule('required', required)
    // defineRule('email', email)
    defineRule('min', min);

    const schema = {
        name: 'required|min:3',
        email: 'required',
    }
    // Create a form context with the validation schema
    const { validate, errors } = useForm({ validationSchema: schema })
    // Define actual fields for validation
    const { value: name } = useField('name', null, { initialValue: '' });
    const { value: email } = useField('email', null, { initialValue: '' });
    const { value: telefono } = useField('telefono', null, { initialValue: '' });
    const { profile: profileData, getProfile, updateProfile, validationErrors, isLoading } = useProfile()
    const profile = reactive({
        name,
        email,
        telefono,
    })
    onMounted(() => {
        getProfile()
    })

    watchEffect(() => {
        profile.name = profileData.value.name
        profile.email = profileData.value.email
        profile.telefono = profileData.value.telefono
    })
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
</style>