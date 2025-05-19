<template>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <h1 class="h1-title">{{ $t('Iniciar Sesión') }}</h1>
                    <h2 class="h2-subtitle">{{ $t('Inicia sesión y disfruta de todas las ventajas ') }}</h2>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body">

                        <form @submit.prevent="submitLogin">
                            <div class="">
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ $t('email') }}</label>
                                    <input v-model="loginForm.email" id="email" type="email" class="form-control" required autofocus autocomplete="username">
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.email">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="password" class="form-label">
                                        {{ $t('Contraseña') }}
                                    </label>
                                    <input v-model="loginForm.password" id="password" type="password" class="form-control" required autocomplete="current-password">
                                    <!-- Validation Errors -->
                                    <div class="text-danger-600 mt-1">
                                        <div v-for="message in validationErrors?.password">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Remember me -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" v-model="loginForm.remember" id="flexCheckIndeterminate">
                                    <label class="form-check-label" for="flexCheckIndeterminate">
                                        {{ $t('Recuerdame') }}
                                    </label>
                                </div>

                                <!-- Buttons -->
                                <div class="flex items-center justify-end mt-4">
                                    <button class="btn btn-primary button" :class="{ 'opacity-25': processing }" :disabled="processing">
                                        {{ $t('Inicia Session') }}
                                    </button>
                                </div>
                            </div>
                            <router-link :to="{name: 'auth.forgot-password'}">{{ $t('¿Has olvidado tu contraseña?')}}</router-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

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

<script setup>

import useAuth from '@/composables/auth'

const { loginForm, validationErrors, processing, submitLogin } = useAuth();

</script>
