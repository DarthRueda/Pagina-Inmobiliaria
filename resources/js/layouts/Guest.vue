<template>
    <div>
        <Navbar/>
        <router-view></router-view>
        <Footer/>
    </div>
</template>

<script setup>
import Navbar from './Nav.vue'
import Footer from './AppFooter.vue'

</script>