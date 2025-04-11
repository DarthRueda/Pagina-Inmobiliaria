<template>
    <nav class="navbar navbar-expand-md navbar-light shadow-sm fixed-top">
        <div class="container">
            <router-link to="/" class="navbar-brand">
                <img src="/images/Header/logotipo.svg" alt="Logo" height="50">
            </router-link>
            <div class="nav-buttons">
                <button class="btn btn-link text-white" @click="redirectToShowHomes('Comprar')">Comprar</button>
                <button class="btn btn-link text-white" @click="redirectToShowHomes('Alquilar')">Alquilar</button>
            </div>
            <a class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="color: white;">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mt-2 mt-lg-0 ms-auto">
                    <template v-if="!authStore().user?.name">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/login">{{ $t('login') }}</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/register">{{ $t('register') }}</router-link>
                        </li>
                    </template>
                    <li v-if="authStore().user?.name" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ authStore().user?.name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li v-if="authStore().user?.roles?.some(role => role.name.toLowerCase() === 'admin')">
                                <router-link class="dropdown-item" to="/admin">Admin</router-link>
                            </li>
                            <li><router-link to="/panelusuario" class="dropdown-item">Perfil</router-link></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style>
.navbar {
    height: 94px;
    background-color: #835EAE;
    position: fixed; 
    top: 0;
    width: 100%;
    z-index: 1030; 
    display: flex;
    
}

.navbar .nav-link, .navbar .navbar-brand {
    color: white;
}

.navbar .nav-link:hover, .navbar .navbar-brand:hover {
    color: white;
}

.nav-buttons {
    display: flex;
    gap: 15px;
    margin-left: 20px;
    margin-top: 20px;
}

.nav-buttons .btn {
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    padding: 0;
    text-decoration: none; /* Remove underline */
    position: relative;
}

body {
    padding-top: 94px; /* Ajusta el contenido para que no quede oculto detrás del nav */
}

@media (max-width: 768px) {
    .navbar {
        height: auto; /* Permite que el navbar se ajuste automáticamente a su contenido */
        padding: 10px 15px; /* Añade un poco de espacio interno */
        flex-wrap: wrap; /* Permite que los elementos se ajusten en varias líneas */
    }

    .nav-buttons {
        margin-top: 10px; /* Reduce el margen superior */
        justify-content: center; /* Centra los botones horizontalmente */
    }

    body {
        padding-top: auto; /* Ajusta dinámicamente el espacio superior según la altura del navbar */
    }
}

@media (max-width: 500px) {
    .navbar {
        height: auto; /* Ajusta la altura automáticamente */
    }
}
</style>

<script setup>

import useAuth from "@/composables/auth";
import { authStore } from "../store/auth";
import { useRouter, useRoute } from 'vue-router';

const { processing, logout } = useAuth();
const router = useRouter();
const route = useRoute();

const redirectToShowHomes = (disponibilidad) => {
    if (route.name === 'list-inmubles' && route.query.disponibilidad !== disponibilidad) {
        router.push({ name: 'list-inmubles', query: { disponibilidad } }).then(() => {
            window.location.reload();
        });
    } else {
        router.push({ name: 'list-inmubles', query: { disponibilidad } });
    }
};
</script>
