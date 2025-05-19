<template>
  <div class="centered-form formulario-hipoteca">
    <button @click="volver" class="back-button"><i class="arrow-left"></i> Volver</button>
    <h1 class="h1-title">Características del inmueble</h1>
    <p class="h2-subtitle">Rellena todos los datos que conozcas; cuanta mas información tengamos, mejor te podremos asesorar.</p>
    <form>
      <div>
        <label for="address" class="form-label">Dirección de la vivienda:</label>
        <input type="text" id="address" v-model="direccion" class="form-control" />
      </div>
      <div>
        <label class="form-label">Tipo de vivienda:</label>
        <input type="radio" id="piso" value="piso" v-model="tipoVivienda" />
        <label for="piso" class="form-check-label">Piso</label>
        <input type="radio" id="casa" value="casa" v-model="tipoVivienda" />
        <label for="casa" class="form-check-label">Casa</label>
      </div>
      <div>
        <label for="surface" class="form-label">Superficie (m²):</label>
        <input type="number" id="surface" v-model="superficie" placeholder="117" class="form-control" />
      </div>
      <div>
        <label for="constructionYear" class="form-label">Año de última reforma:</label>
        <input type="number" id="constructionYear" v-model="añoReforma" placeholder="1978 (año de construcción)" @input="validarAño" class="form-control" />
      </div>
      <div>
        <label for="conservationStatus" class="form-label">Estado de conservación:</label>
        <div class="select-container">
          <select id="conservationStatus" v-model="estadoConservacion" class="form-control">
            <option value="unknown">Desconocido</option>
            <option value="bad">A reformar</option>
            <option value="normal">Normal</option>
            <option value="good">Bueno</option>
            <option value="excellent">Excelente</option>
          </select>
          <span class="icon">▼</span>
        </div>
      </div>
      <div>
        <label class="form-label">Habitaciones:</label>
        <div class="button-group centered-buttons">
          <button type="button" @click="establecerHabitaciones(1)" :class="{'button small-button': true, 'selected': habitaciones === 1}">1</button>
          <button type="button" @click="establecerHabitaciones(2)" :class="{'button small-button': true, 'selected': habitaciones === 2}">2</button>
          <button type="button" @click="establecerHabitaciones(3)" :class="{'button small-button': true, 'selected': habitaciones === 3}">3</button>
          <button type="button" @click="establecerHabitaciones(4)" :class="{'button small-button': true, 'selected': habitaciones === 4}">4</button>
          <button type="button" @click="establecerHabitaciones(5)" :class="{'button small-button': true, 'selected': habitaciones === 5}">+5</button>
        </div>
      </div>
      <div>
        <label class="form-label">Baños:</label>
        <div class="button-group centered-buttons">
          <button type="button" @click="establecerBaños(1)" :class="{'button small-button': true, 'selected': baños === 1}">1</button>
          <button type="button" @click="establecerBaños(2)" :class="{'button small-button': true, 'selected': baños === 2}">2</button>
          <button type="button" @click="establecerBaños(3)" :class="{'button small-button': true, 'selected': baños === 3}">3</button>
          <button type="button" @click="establecerBaños(4)" :class="{'button small-button': true, 'selected': baños === 4}">4</button>
          <button type="button" @click="establecerBaños(5)" :class="{'button small-button': true, 'selected': baños === 5}">+5</button>
        </div>
      </div>
      <div>
        <label class="form-label">Extras:</label>
        <div class="button-group centered-buttons">
          <button type="button" @click="alternarExtra('ascensor')" :class="{'button extra-button': true, 'selected': extras.includes('ascensor')}">Ascensor</button>
          <button type="button" @click="alternarExtra('garaje')" :class="{'button extra-button': true, 'selected': extras.includes('garaje')}">Garaje</button>
          <button type="button" @click="alternarExtra('piscina')" :class="{'button extra-button': true, 'selected': extras.includes('piscina')}">Piscina</button>
          <button type="button" @click="alternarExtra('zonasAjardinadas')" :class="{'button extra-button': true, 'selected': extras.includes('zonasAjardinadas')}">Zonas ajardinadas</button>
          <button type="button" @click="alternarExtra('zonasDeportivas')" :class="{'button extra-button': true, 'selected': extras.includes('zonasDeportivas')}">Zonas deportivas</button>
          <button type="button" @click="alternarExtra('trastero')" :class="{'button extra-button': true, 'selected': extras.includes('trastero')}">Trastero</button>
        </div>
      </div>
      <div>
        <button type="button" @click="calcular" class="button">Calcular</button>
      </div>
    </form>
    <div v-if="mostrarOverlay" class="overlay">
      <div class="overlay-content">
        <div class="price-box-container">
          <div class="price-box">
            <h2>Precio venta</h2>
            <p>{{ precioVenta }} €</p>
          </div>
          <div class="price-box">
            <h2>Precio alquiler</h2>
            <p>{{ precioAlquiler }} €</p>
          </div>
        </div>
        <div class="button-container">
          <button @click="cerrarOverlay" class="button">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.centered-form {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.formulario-hipoteca {
  margin-left: 130px;
  margin-right: 130px;
}

.form-control {
  border-radius: 0;
  height: 48px;
  font-size: 20px;
  margin-top: 10px;
  margin-bottom: 10px;
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

.precio-display {
  font-size: 20px;
  margin-bottom: 10px;
}

.slider {
  -webkit-appearance: none;
  appearance: none;
  width: 100%;
  height: 8px;
  background: #ddd;
  outline: none;
  opacity: 0.7;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  background: #835EAE;
  cursor: pointer;
  border-radius: 50%;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  background: #835EAE;
  cursor: pointer;
  border-radius: 50%;
}

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

.small-button {
  width: 10%;
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

.small-button:hover {
  background-color: #64428C;
}

.extra-button {
  width: auto; /* Adjusted width to fit the whole text */
  min-width: 150px; /* Ensure a minimum width */
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

.extra-button:hover {
  background-color: #64428C;
}

.button-group {
  display: flex;
  gap: 10px;
}

.centered-buttons {
  justify-content: center;
}

.select-container {
  position: relative;
}

.select-container .icon {
  position: absolute;
  right: 10px;
  top: 78%;
  transform: translateY(-50%);
  pointer-events: none;
  font-size: 20px;
  color: #835EAE;
}

.title {
  text-align: center;
  margin-top: 20px;
  margin-bottom: 20px;
}

.resultados {
  font-family: 'Inter', sans-serif;
  font-size: 24px;
  margin-top: 20px;
}

.resultados h2 {
  font-size: 28px;
  font-weight: 700;
}

.resultados p {
  font-size: 24px;
  margin: 10px 0;
}

@media (max-width: 600px) {
  .formulario-hipoteca {
    margin-left: 20px;
    margin-right: 20px;
  }

  .form-control {
    font-size: 16px;
    height: 40px;
  }

  .form-label {
    font-size: 20px;
  }

  .form-check-label {
    font-size: 14px;
  }

  .h1-title {
    font-size: 28px;
  }

  .h2-subtitle {
    font-size: 20px;
  }

  .button, .small-button, .extra-button {
    font-size: 16px;
    height: 40px;
  }

  .button-group {
    flex-direction: row;
    flex-wrap: wrap;
    gap: 5px;
  }

  .select-container .icon {
    font-size: 16px;
  }

  .resultados {
    font-size: 20px;
  }

  .resultados h2 {
    font-size: 24px;
  }

  .resultados p {
    font-size: 20px;
  }

  .back-button {
    margin: 10px 0;
    font-size: 14px;
    padding: 8px 12px;
  }
}

.selected {
  background-color: #64428C;
  border: 2px solid #835EAE;
}

.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.overlay-content {
  background: white;
  padding: 40px; /* Increased padding to make the box bigger */
  text-align: center;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 80%; /* Adjusted width */
}

.price-box-container {
  display: flex;
  justify-content: space-between; /* Align boxes side by side */
  width: 100%;
}

.overlay-content .price-box {
  padding: 20px;
  margin: 10px;
  border: 1px solid #000; /* Added border */
  width: 45%; /* Adjusted width to fit side by side */
  box-sizing: border-box;
}

.button-container {
  width: 100%;
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

.overlay-content h2 {
  font-size: 24px;
  margin-bottom: 20px;
}

.overlay-content p {
  font-size: 24px;
  margin-bottom: 20px;
}

@media (max-width: 500px) {
  .price-box-container{
    width:125%
  }

  .overlay-content h2{
    font-size: 15px;
  }

  .overlay-content p{
    font-size: 15px;
  }

  .overlay-content .price-box{
    padding: 5px;
    margin: 5px;
  }

}

.back-button {
  align-self: flex-start;
  margin-top: 10px; 
  background-color: #835EAE;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 10px 15px;
  font-size: 16px;
  cursor: pointer;
  display: flex;
  align-items: center;
}

.back-button:hover {
  background-color: #64428C;
}

.arrow-left {
  display: inline-block;
  width: 10px;
  height: 10px;
  border-top: 2px solid white;
  border-left: 2px solid white;
  transform: rotate(-45deg);
  margin-right: 8px;
}

@media (max-width: 768px) {
  .formulario-hipoteca {
    margin-left: 30px;
    margin-right: 30px;
    padding-top: 30px; /* Añadir padding superior para compensar el navbar */
    padding-bottom: 30px;
  }
  
  .back-button {
    margin-top: 20px; 
  }
}

</style>

<script>
export default {
  data() {
    return {
      direccion: '',
      tipoVivienda: '',
      superficie: '',
      añoReforma: '',
      estadoConservacion: 'unknown',
      habitaciones: 0,
      baños: 0,
      extras: [],
      mostrarOverlay: false,
      precioVenta: 0,
      precioAlquiler: 0
    };
  },
  mounted() {
    // Forzar el scroll al inicio cuando el componente se monta
    window.scrollTo(0, 0);
  },
  methods: {
    establecerHabitaciones(numero) {
      this.habitaciones = numero;
    },
    establecerBaños(numero) {
      this.baños = numero;
    },
    alternarExtra(extra) {
      const indice = this.extras.indexOf(extra);
      if (indice > -1) {
        this.extras.splice(indice, 1);
      } else {
        this.extras.push(extra);
      }
    },
    validarAño() {
      if (this.añoReforma < 1978) {
        this.añoReforma = 1978;
      } else if (this.añoReforma > 2024) {
        this.añoReforma = 2024;
      }
    },
    calcular() {
      let precioBasePorM2;
      if (this.tipoVivienda === 'casa') {
        precioBasePorM2 = this.obtenerEnteroAleatorio(2000, 5000);
      } else if (this.tipoVivienda === 'piso') {
        precioBasePorM2 = this.obtenerEnteroAleatorio(1000, 3000);
      }

      let precio = precioBasePorM2 * this.superficie;
      precio += this.habitaciones * 500;
      precio += this.baños * 650;
      precio += this.extras.length * 400;

      const porcentajeAño = this.obtenerPorcentajeAño(this.añoReforma);
      const porcentajeConservacion = this.obtenerPorcentajeConservacion(this.estadoConservacion);

      precio += precio * (porcentajeAño / 100);
      precio += precio * (porcentajeConservacion / 100);

      this.precioVenta = precio.toFixed(2);
      this.precioAlquiler = (precio * 0.005).toFixed(2);

      this.mostrarOverlay = true;
    },
    cerrarOverlay() {
      this.mostrarOverlay = false;
    },
    obtenerEnteroAleatorio(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    },
    obtenerPorcentajeAño(año) {
      if (año >= 1978 && año <= 1989) return 0;
      if (año >= 1990 && año <= 1999) return 5;
      if (año >= 2000 && año <= 2009) return 10;
      if (año >= 2010 && año <= 2019) return 15;
      if (año >= 2020 && año <= 2024) return 20;
      return 0;
    },
    obtenerPorcentajeConservacion(estado) {
      if (estado === 'bad') return -15;
      if (estado === 'normal') return 0;
      if (estado === 'good') return 10;
      if (estado === 'excellent') return 20;
      return 0;
    },
    volver() {
      this.$router.go(-1);
    }
  }
};
</script>
