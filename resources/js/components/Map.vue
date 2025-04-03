<template>
  <div>
    <!-- <input
      type="text"
      v-model="location"
      placeholder="Introduce una ubicación"
      @keyup.enter="searchLocation"
    /> -->
    <div id="map" style="height: 194px; width: 266px;"></div>
  </div>
</template>

<script>
import L from 'leaflet';

export default {
  name: 'Map',
  data() {
    return {
      map: null,
      location: '',
    };
  },
  mounted() {
    // Inicializar el mapa
    this.map = L.map('map', { zoomControl: false }).setView([40.416775, -3.703790], 10);

    // Añadir capa de mapa base
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    }).addTo(this.map);

    // Eliminar el control de zoom
    this.map.zoomControl.remove();
  },
  methods: {
    async searchLocation() {
      if (!this.location) return;

      try {
        // Llamar a la API de Nominatim para obtener las coordenadas y los límites (bbox)
        const response = await fetch(
          `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(
            this.location
          )}&addressdetails=1&limit=1`
        );
        const data = await response.json();

        if (data.length > 0) {
          const { lat, lon, boundingbox } = data[0];

          // Si hay un bounding box (límite geográfico), usarlo para ajustar el zoom
          if (boundingbox) {
            const [south, north, west, east] = boundingbox;
            const bounds = [[south, west], [north, east]];

            // Ajustar el zoom para que cubra toda el área del bbox
            this.map.fitBounds(bounds);

            // Si el zoom está demasiado ajustado, podemos reducirlo un poco manualmente
            const currentZoom = this.map.getZoom();
            if (currentZoom < 10) {
              this.map.setZoom(10); // Ajuste mínimo para evitar zooms muy grandes
            }
          } else {
            // Si no hay bounding box, simplemente centramos el mapa en la ubicación con un zoom fijo
            this.map.setView([lat, lon], 12); // Ajuste de zoom
          }
        } else {
          alert('No se encontró la ubicación.');
        }
      } catch (error) {
        console.error('Error al buscar la ubicación:', error);
      }
    },
  },
};
</script>
