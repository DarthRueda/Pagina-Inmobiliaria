<template>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <div class="text-center mb-4">
                        <h1 class="h1-title">{{ $t('register') }}</h1>
                        <h2 class="h2-subtitle">{{ $t('Registrate y disfruta de todas las ventajas ') }}</h2>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <form @submit.prevent="submitRegister">
                            <div class="">
                                <!-- Nombre -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ $t('Nombre') }}</label>
                                    <input v-model="registerForm.name" id="name" type="text" class="form-control" autofocus>
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.name">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ $t('Email') }}</label>
                                    <input v-model="registerForm.email" id="email" type="email" class="form-control" autocomplete="username">
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.email">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Telefono -->
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">{{ $t('Telefono') }}</label>
                                    <input v-model="registerForm.telefono" id="telefono" type="text" class="form-control">
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.telefono">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="password" class="form-label">
                                        {{ $t('Contraseña') }}
                                    </label>
                                    <input v-model="registerForm.password" id="password" type="password" class="form-control" autocomplete="current-password">
                                    <!-- Validation Errors -->
                                    <div class="text-danger-600 mt-1">
                                        <div v-for="message in validationErrors?.password">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">
                                        {{ $t('Confirmar Contraseña') }}
                                    </label>
                                    <input v-model="registerForm.password_confirmation" id="password_confirmation" type="password" class="form-control" autocomplete="current-password">
                                    <!-- Validation Errors -->
                                    <div class="text-danger-600 mt-1">
                                        <div v-for="message in validationErrors?.password_confirmation">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="flex items-center justify-end mt-4">
                                    <button class="btn btn-primary button" :class="{ 'opacity-25': processing }" :disabled="processing">
                                        {{ $t('Registrar-se') }}
                                    </button>
                                </div>
                                <div class="text-center mt-3">
                                    <router-link :to="{ name: 'auth.register.empresa' }">
                                        ¿Eres una empresa? Registrate aqui
                                    </router-link>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import useAuth from '@/composables/auth'

const { registerForm, validationErrors, processing, submitRegister } = useAuth();

</script>

<style>
.button {
    width: 100%;
    height: 48px;
    background-color: #835EAE;
    color: white;
    font-weight: bold;
    font-size: 20px;
    border: none;
    border-radius: 0;
    cursor: pointer;
    margin-top: 20px;
}

.button:hover {
    background-color: #64428C;
}

.form-control {
    border-radius: 0;
    height: 48px;
    font-size: 20px;
}

.form-label {
    font-size: 24px;
}

.form-check-label {
    font-size: 16px;
}

.card {
    border-radius: 0;
}

.h1-title {
    font-size: 36px;
}

.h2-subtitle {
    font-size: 24px;
}
</style>
