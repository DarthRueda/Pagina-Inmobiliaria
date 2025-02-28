<template>
    <div class="row no-gutters">
        <ImageMosaic />
        <div class="col-9">
            <div class="price">€250,000</div>
            <div class="mortgage">
                <img src="" alt="Mortgage Icon" class="mortgage-icon" />
                <span>Calcula tu hipoteca</span>
            </div>
            <InfoPiso />
            <CaracteristicasPiso />
            <h2>Ubicacion vivienda</h2>
            <div class="ubicacion-block"></div>
        </div>
        <div class="col-3 col-border">
            <h3>Contactanos</h3>
            <h4>Introduce tus datos</h4>
            <form class="contact-form">
                <input type="text" placeholder="Nombre" class="form-input" />
                <input type="email" placeholder="Email" class="form-input" />
                <input type="tel" placeholder="Teléfono" class="form-input" />
                <button type="submit" class="contact-button">Contactar</button>
            </form>
        </div>
    </div>
</template>

<script>
import ImageMosaic from '@/components/ImageMosaic.vue'
import InfoPiso from '@/components/InfoPiso.vue'
import CaracteristicasPiso from '@/components/CaracteristicasPiso.vue'

export default {
    components: {
        ImageMosaic,
        InfoPiso,
        CaracteristicasPiso
    }
}
</script>

<style scoped>
.col-9 {
    margin-left: 37px;
    margin-right: 37px;
    width: 68%;
}
.col-3 {
    height: 20%;
    position: sticky;
    top: 0;
    margin-top: 10px;
}

.price {
    font-size: 24px;
    font-weight: bold;
    margin-top: 10px;
}
.mortgage {
    display: flex;
    align-items: center;
    margin-top: 5px;
}
.mortgage-icon {
    width: 20px;
    height: 28px;
    margin-right: 5px;
}
.mortgage span {
    font-size: 16px;
}
.ubicacion-block {
    width: 100%;
    height: 288px;
    background-color: #f0f0f0;
    margin-bottom: 20px;
}
.contact-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 20px;
    height: 20%;
}
.form-input {
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-right: 26px;
    margin-left: 26px;
}
.contact-button {
    padding: 10px;
    font-size: 16px;
    background-color: #835EAE;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 26px;
    margin-left: 26px;
}
.contact-button:hover {
    background-color: #64428C;
}
.row.no-gutters {
    margin-right: 0;
    margin-left: 0;
}
.row.no-gutters > [class*='col-'] {
    padding-right: 0;
    padding-left: 0;
}
.col-border {
    background-color: white;
    border: 1px solid #ccc;
    padding: 10px;
}

h3 {
    text-align: center;
}
h4{
    margin-right: 26px;
    margin-left: 26px;
}


</style>