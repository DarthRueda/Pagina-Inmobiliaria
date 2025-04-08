<template>
  <div id="map"></div>
</template>

<script>
import L from 'leaflet';

export default {
name: 'Map',
props: {
  municipio: {
    type: String,
    required: false,
  },
},
data() {
  return {
    map: null,
  };
},
watch: {
  municipio: {
    immediate: true,
    handler(newMunicipio) {
      if (newMunicipio) {
        this.searchLocation(newMunicipio);
      }
    },
  },
},
mounted() {
  // Inicializar el mapa
  this.map = L.map('map', { zoomControl: false }).setView([40.416775, -3.703790], 4);

  // Añadir capa de mapa base
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  }).addTo(this.map);
},
methods: {
  async searchLocation(location) {
    try {
      const response = await fetch(
        `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(location)}&addressdetails=1&limit=1`
      );
      const data = await response.json();

      if (data.length > 0) {
        const { lat, lon } = data[0];
        this.map.setView([lat, lon], 12);
      } else {
        console.warn('No se encontró la ubicación:', location);
      }
    } catch (error) {
      console.error('Error al buscar la ubicación:', error);
    }
  },
},
};
</script>

