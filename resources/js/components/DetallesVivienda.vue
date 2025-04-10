<template>
  <div v-if="vivienda">
    <div class="row no-gutters">
      <ImageMosaic :images="viviendaImages" />
    </div>
    <button class="back-button" @click="goBackToInmuebles">Volver a Inmuebles</button>
    <div class="row no-gutters">
      <div class="col-9">
        <div class="price">{{ vivienda.precio }}</div>
        <!-- Debug log -->
        <div v-if="false">{{ console.log('Disponibilidad:', vivienda.disponibilidad) }}</div>
        <div class="mortgage" 
             v-if="vivienda.disponibilidad && vivienda.disponibilidad.trim().toLowerCase() !== 'alquilar'" 
             @click="redirectToHipoteca" 
             @mouseover="hoverMortgage" 
             @mouseleave="leaveMortgage">
          <svg class="mortgage-icon" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="Size=XL - 40"><path id="Icon colour" d="M31.25 0C33.2348 0 34.8594 1.54194 34.9913 3.49325L35 3.75V36.25C35 38.2348 33.4581 39.8594 31.5067 39.9913L31.25 40H8.75C6.76523 40 5.14059 38.4581 5.00865 36.5067L5 36.25V3.75C5 1.76523 6.54194 0.140592 8.49325 0.00865135L8.75 0H31.25ZM31.25 2.5H8.75C8.11717 2.5 7.59418 2.97026 7.51141 3.58038L7.5 3.75V36.25C7.5 36.8828 7.97026 37.4058 8.58038 37.4886L8.75 37.5H31.25C31.8828 37.5 32.4058 37.0297 32.4886 36.4196L32.5 36.25V3.75C32.5 3.11717 32.0297 2.59418 31.4196 2.51141L31.25 2.5ZM13.125 31.25L13.3293 31.261C14.2687 31.3628 15 32.1585 15 33.125C15 34.1605 14.1605 35 13.125 35C12.0895 35 11.25 34.1605 11.25 33.125C11.25 32.1585 11.9813 31.3628 12.9207 31.261L13.125 31.25ZM20.26 31.25L20.4643 31.261C21.4037 31.3628 22.135 32.1585 22.135 33.125C22.135 34.1605 21.2955 35 20.26 35C19.2245 35 18.385 34.1605 18.385 33.125C18.385 32.1585 19.1163 31.3628 20.0557 31.261L20.26 31.25ZM26.875 31.25L27.0793 31.261C28.0187 31.3628 28.75 32.1585 28.75 33.125C28.75 34.1605 27.9105 35 26.875 35C25.8395 35 25 34.1605 25 33.125C25 32.1585 25.7313 31.3628 26.6707 31.261L26.875 31.25ZM13.125 25L13.3293 25.011C14.2687 25.1128 15 25.9085 15 26.875C15 27.9105 14.1605 28.75 13.125 28.75C12.0895 28.75 11.25 27.9105 11.25 26.875C11.25 25.9085 11.9813 25.1128 12.9207 25.011L13.125 25ZM20.26 25L20.4643 25.011C21.4037 25.1128 22.135 25.9085 22.135 26.875C22.135 27.9105 21.2955 28.75 20.26 28.75C19.2245 28.75 18.385 27.9105 18.385 26.875C18.385 25.9085 19.1163 25.1128 20.0557 25.011L20.26 25ZM26.875 25L27.0793 25.011C28.0187 25.1128 28.75 25.9085 28.75 26.875C28.75 27.9105 27.9105 28.75 26.875 28.75C25.8395 28.75 25 27.9105 25 26.875C25 25.9085 25.7313 25.1128 26.6707 25.011L26.875 25ZM13.125 18.75L13.3293 18.761C14.2687 18.8628 15 19.6585 15 20.625C15 21.6605 14.1605 22.5 13.125 22.5C12.0895 22.5 11.25 21.6605 11.25 20.625C11.25 19.6585 11.9813 18.8628 12.9207 18.761L13.125 18.75ZM20.26 18.75L20.4643 18.761C21.4037 18.8628 22.135 19.6585 22.135 20.625C22.135 21.6605 21.2955 22.5 20.26 22.5C19.2245 22.5 18.385 21.6605 18.385 20.625C18.385 19.6585 19.1163 18.8628 20.0557 18.761L20.26 18.75ZM26.875 18.75L27.0793 18.761C28.0187 18.8628 28.75 19.6585 28.75 20.625C28.75 21.6605 27.9105 22.5 26.875 22.5C25.8395 22.5 25 21.6605 25 20.625C25 19.6585 25.7313 18.8628 26.6707 18.761L26.875 18.75ZM27.5 5C28.7995 5 29.8674 5.99148 29.9886 7.25923L30 7.5V12.5C30 13.7995 29.0085 14.8674 27.7408 14.9886L27.5 15H12.5C11.2005 15 10.1326 14.0085 10.0114 12.7408L10 12.5V7.5C10 6.20051 10.9915 5.13259 12.2592 5.01144L12.5 5H27.5ZM27.5 7.5H12.5V12.5H27.5V7.5Z" fill="#000000"></path></g></svg>
          <span>Calcula tu hipoteca</span>
        </div>
        <InfoPiso :info="vivienda" />
        <CaracteristicasPiso :caracteristicas="vivienda" />
        
        <div v-for="filtro in vivienda.filtros"> 
          <Chip>{{filtro.nombre}}</Chip>
        </div>

        <h2>Ubicacion vivienda</h2>
        <div class="ubicacion-block">
          <Map class="map-style" :municipio="vivienda.localizacion" />
        </div>

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
  </div>
  <div v-else>
    <p>Cargando detalles...</p>
  </div>
</template>

<script>
import { ref, onMounted, defineComponent } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';
import ImageMosaic from '@/components/ImageMosaic.vue';
import InfoPiso from '@/components/InfoPiso.vue';
import CaracteristicasPiso from '@/components/CaracteristicasPiso.vue';
import Map from '@/components/Map.vue';

export default defineComponent({
  components: {
    ImageMosaic,
    InfoPiso,
    CaracteristicasPiso,
    Map,
  },
  setup() {
    const route = useRoute();
    const router = useRouter();
    const vivienda = ref(null);
    const viviendaImages = ref([]);

    const fetchVivienda = async (id) => {
      try {
        const response = await axios.get(`/api/vivienda/${id}`);
        vivienda.value = response.data;
        viviendaImages.value = response.data.media.map(media => media.original_url);
      } catch (error) {
        console.error("Error al obtener los detalles de la vivienda", error);
      }
    };

    const redirectToHipoteca = () => {
      if (vivienda.value) {
        const sanitizedPrecio = vivienda.value.precio.toString().replace(/[.,]/g, '');
        router.push({ path: '/hipoteca', query: { precioVivienda: sanitizedPrecio } });
      }
    };

    const hoverMortgage = (event) => {
      event.target.style.cursor = 'pointer';
      event.target.style.textDecoration = 'underline';
    };

    const leaveMortgage = (event) => {
      event.target.style.textDecoration = 'none';
    };

    const goBackToInmuebles = () => {
      router.push({ name: 'list-inmubles' });
    };

    onMounted(() => {
      const viviendaId = route.params.id;
      fetchVivienda(viviendaId);
    });

    return {
      vivienda,
      viviendaImages,
      fetchVivienda,
      redirectToHipoteca,
      hoverMortgage,
      leaveMortgage,
      goBackToInmuebles
    };
  }
});
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
h4 {
  margin-right: 26px;
  margin-left: 26px;
}

.map-style {
  width: 100%;
  height: 288px
}

.back-button {
  margin-top: 10px;
  padding: 10px 20px;
  font-size: 16px;
  background-color: #835EAE;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 200px;
  align-self: center;
}

.back-button:hover {
  background-color: #64428C;
}

@media (max-width: 500px) {
  #map{
    width: 133%;;
  }
  .col-3 {
    width: 100%;
  }
}

@media (max-width: 400px) {

}
</style>