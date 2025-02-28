<template>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <h1 class="h1-title">{{ $t('¿Has olvidado tu contraseña?') }}</h1>
                    <h2 class="h2-subtitle">{{ $t('Escribe aqui el correo de tu cuenta para poder recuperar tu acceso') }}</h2>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <form @submit.prevent="submitForgotPassword">
                            <div class="">
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ $t('email') }}</label>
                                    <input v-model="forgotForm.email" id="email" type="email" class="form-control" required autofocus autocomplete="username">
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.email">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Buttons -->
                                <div class="flex items-center justify-end mt-4">
                                    <button class="button" :class="{ 'opacity-25': processing }" :disabled="processing">
                                        {{ $t('Reseta tu contraseña') }}
                                    </button>
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

const { forgotForm, validationErrors, processing, submitForgotPassword } = useAuth();
</script>

<style scoped>
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
