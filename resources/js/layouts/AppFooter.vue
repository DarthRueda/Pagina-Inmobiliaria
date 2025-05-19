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
            <div class="row full-width logo-copyright-row">
                <div class="col-md-4 col-sm-12 text-center logo-container">
                    <img src="/images/footer/logo2.svg" alt="Logo" class="footer-logo">
                </div>
                <div class="col-md-4 col-sm-12 text-center copyright-container">
                    <span>©2025 Copyright</span>
                </div>
                <div class="col-md-4 col-sm-12 text-center social-icons-container">
                    <div class="social-icons-wrapper">
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
            </div>
            <div class="row full-width policy-row">
                <div class="col-md-4 col-sm-12 text-center policy-item">
                    <span>Politica de Cookies</span>
                </div>
                <div class="col-md-4 col-sm-12 text-center policy-item">
                    <span class="aviso-legal">Aviso Legal</span>
                </div>
                <div class="col-md-4 col-sm-12 text-center policy-item">
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
    width: 100%;
}

.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.full-width {
    width: 100%;
}

.col-md-4 {
    flex: 0 0 33.3333%;
    padding: 0 10px;
}

.text-center {
    text-align: center;
}

.social-icons-wrapper {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
}

.social-icon {
    width: 26px;
    height: 26px;
    transition: transform 0.2s;
}

.social-icon:hover {
    transform: scale(1.2);
}

.footer-logo {
    max-width: 100%;
    height: auto;
}

/* Media queries para responsive */
@media (max-width: 768px) {
    .col-md-4 {
        flex: 0 0 100%;
        margin-bottom: 15px;
    }
    
    .row {
        flex-direction: column;
    }
    
    .social-icons-container {
        margin: 15px 0;
    }
    
    .social-icons-wrapper {
        gap: 20px;
    }
    
    .social-icon {
        width: 32px;
        height: 32px;
    }
    
    .policy-item {
        margin: 10px 0;
    }
    
    .logo-copyright-row > div,
    .policy-row > div {
        margin-bottom: 15px;
    }
}

@media (max-width: 480px) {
    .layout-footer {
        padding: 15px 10px;
    }
    
    .social-icons-wrapper {
        gap: 25px;
    }
    
    .policy-row {
        margin-top: 10px;
    }
}
</style>
