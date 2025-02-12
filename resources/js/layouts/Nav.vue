<template>
    <nav class="navbar navbar-expand-md navbar-light shadow-sm">
        <div class="container">
            <router-link to="/" class="navbar-brand">
                <img src="/images/Header/logotipo.svg" alt="Logo" height="50">
            </router-link>
            <a class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
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
                </ul>
            </div>
        </div>
    </nav>
</template>

<style>
.navbar {
    height: 94px;
    background-color: #835EAE;
}

.navbar .nav-link, .navbar .navbar-brand {
    color: white;
}

.navbar .nav-link:hover, .navbar .navbar-brand:hover {
    color: white;
}
</style>

<script setup>

import useAuth from "@/composables/auth";
import { authStore } from "../store/auth";

const { processing, logout } = useAuth();
</script>
