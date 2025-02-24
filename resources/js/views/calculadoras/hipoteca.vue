<template>
  <div class="formulario-hipoteca">
    <h1 class="title">Calcular Hipoteca</h1>
    <form @submit.prevent="calcularHipoteca">
      <div>
        <label for="precioVivienda" class="form-label">Precio Vivienda:</label>
        <input type="text" :value="form.precioVivienda + '€'" class="form-control" readonly>
        <input type="range" id="precioVivienda" v-model="form.precioVivienda" class="form-control slider" min="10000" max="2000000" step="1000">
      </div>
      <div>
        <label for="ahorroAportado" class="form-label">Ahorro Aportado:</label>
        <input type="text" :value="form.ahorroAportado + '€'" class="form-control" readonly>
        <input type="range" id="ahorroAportado" v-model="form.ahorroAportado" class="form-control slider" :max="form.precioVivienda" step="1000">
      </div>
      <div>
        <label for="terminioAnos" class="form-label">Terminio en años:</label>
        <input type="text" :value="form.terminioAnos + ' años'" class="form-control" readonly>
        <input type="range" id="terminioAnos" v-model="form.terminioAnos" class="form-control slider" min="5" max="40" step="1">
      </div>
      <button type="submit" class="form-control button">Calcular</button>
    </form>
    <div v-if="resultados" class="resultados">
      <h2>Resultados</h2>
      <p>Impuestos y despensas: {{ formatNumber(impuestosYDespensas) }}€</p>
      <p>Importe del prestamo: {{ formatNumber(importePrestamo) }}€</p>
      <p>Quota mensual: {{ formatNumber(cuotaMensual) }}€</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        precioVivienda: 10000,
        ahorroAportado: 0,
        terminioAnos: 5,
        tipoInteres: 5
      },
      resultados: false,
      impuestosYDespensas: 0,
      importePrestamo: 0,
      cuotaMensual: 0
    };
  },
  methods: {
    calcularHipoteca() {
      const notaria = 1105;
      const registre = 588;
      const gestoria = 300;
      const impuestos = this.form.precioVivienda / 10;

      this.impuestosYDespensas = notaria + registre + gestoria + impuestos;
      this.importePrestamo = this.form.precioVivienda - this.form.ahorroAportado;
      this.cuotaMensual = this.importePrestamo / (this.form.terminioAnos * 12);

      this.resultados = true;
    },
    formatNumber(value) {
      return value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.').replace('.', ',');
    }
  }
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');

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
</style>
