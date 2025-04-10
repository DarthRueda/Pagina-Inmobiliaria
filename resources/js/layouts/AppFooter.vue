<script setup>
import { useLayout } from '../composables/layout';
import { computed } from 'vue';

const { layoutConfig } = useLayout();

const logoUrl = computed(() => {
    return `layout/images/${layoutConfig.darkTheme.value ? 'logo-white' : 'logo-dark'}.svg`;
});
</script>

<template>
    <div class="layout-footer">
        <div class="column">
            <div class="row full-width">
                <div class="col-4 text-center">
                    <img src="/images/footer/logo2.svg" alt="Logo">
                </div>
                <div class="col-4 text-center">
                    <span>©2025 Copyright</span>
                </div>
                <div class="col-4 text-center">
                    <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer">
                        <img src="/images/footer/facebook.svg" alt="Facebook" class="social-icon">
                    </a>
                    <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer">
                        <img src="/images/footer/instagram.svg" alt="Instagram" class="social-icon">
                    </a>
                    <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer">
                        <img src="/images/footer/youtube.svg" alt="YouTube" class="social-icon">
                    </a>
                    <a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer">
                        <img src="/images/footer/link.svg" alt="LinkedIn" class="social-icon">
                    </a>
                    <a href="https://www.tiktok.com" target="_blank" rel="noopener noreferrer">
                        <img src="/images/footer/tiktok.svg" alt="TikTok" class="social-icon">
                    </a>
                </div>
            </div>
            <div class="row full-width">
                <div class="col-4 text-center">
                    <span>Politica de Cookies</span>
                </div>
                <div class="col-4 text-center">
                    <span class="aviso-legal">Aviso Legal</span>
                </div>
                <div class="col-4 text-center">
                    <span>Protecció de dades</span>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped>
.layout-footer {
    padding: 20px;
    color: white;
    background-color: #835EAE;
}
.column {
    display: flex;
    flex-direction: column;
    width: 100%; // Ensure the column spans the entire width of the footer
}
.row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px; // Add some space between rows
}
.full-width {
    width: 100%; // Ensure the row spans the entire width of the footer
}
.col-4 {
    flex: 0 0 33.3333%;
    text-align: center; // Center the content of all columns
}
.col-4.text-center {
    display: flex;
    justify-content: center;
    gap: 5px; // Add gap between social icons
}
.text-center {
    text-align: center;
}
.aviso-legal {
    margin-top: 0; // Reset margin-top since it's now in a new row
}
.social-icon {
    width: 26px;
    height: 26px;
}
.social-icon:last-child {
    margin-right: 0;
}
</style>
