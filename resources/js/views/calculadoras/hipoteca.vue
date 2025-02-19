<template>
  <div class="formulario-hipoteca">
    <h1 class="title">Calcular Hipoteca</h1>
    <form>
      <div class="select-container">
        <label for="provincia" class="form-label">Provincia:</label>
        <select id="provincia" v-model="form.provincia" class="form-control" @focus="hideIcon" @blur="showIcon">
          <option v-for="provincia in provincias" :key="provincia" :value="provincia">{{ provincia }}</option>
        </select>
        <i class="icon" v-show="iconVisible">▼</i>
      </div>
      <div class="select-container">
        <label for="tipoVivienda" class="form-label">Tipo de vivienda:</label>
        <select id="tipoVivienda" v-model="form.tipoVivienda" class="form-control" @focus="hideIcon" @blur="showIcon">
          <option value="Segunda Mano">Segunda Mano</option>
          <option value="Obra Nueva">Obra Nueva</option>
        </select>
        <i class="icon" v-show="iconVisible">▼</i>
      </div>
      <div class="select-container">
        <label for="usoVivienda" class="form-label">Uso de vivienda:</label>
        <select id="usoVivienda" v-model="form.usoVivienda" class="form-control" @focus="hideIcon" @blur="showIcon">
          <option value="Habitual">Habitual</option>
          <option value="Segunda Vivienda">Segunda Vivienda</option>
        </select>
        <i class="icon" v-show="iconVisible">▼</i>
      </div>
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
        <label for="ingresosMensuales" class="form-label">Ingresos mensuales de la unidad familiar:</label>
        <input type="number" id="ingresosMensuales" v-model="form.ingresosMensuales" class="form-control">
      </div>
      <div class="select-container">
        <label for="situacionLaboral" class="form-label">Situación laboral:</label>
        <select id="situacionLaboral" v-model="form.situacionLaboral" class="form-control" @focus="hideIcon" @blur="showIcon">
          <option value="Asalariado/a">Asalariado/a</option>
          <option value="Autonomo/a">Autonomo/a</option>
          <option value="Empleado/a público">Empleado/a público</option>
          <option value="Mixto (Asalariado/a Autonomo/a)">Mixto (Asalariado/a Autonomo/a)</option>
          <option value="Empresario/a">Empresario/a</option>
          <option value="Parado/a">Parado/a</option>
          <option value="Desempleado/a">Desempleado/a</option>
          <option value="Cooperativista">Cooperativista</option>
          <option value="Temporero/a">Temporero/a</option>
          <option value="Pensionista">Pensionista</option>
          <option value="Estudiante">Estudiante</option>
        </select>
        <i class="icon" v-show="iconVisible">▼</i>
      </div>
      <button type="submit" class="form-control button">Calcular</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        provincia: '',
        tipoVivienda: '',
        usoVivienda: '',
        precioVivienda: 10000,
        ahorroAportado: 0,
        ingresosMensuales: 0,
        situacionLaboral: ''
      },
      provincias: [
        'Álava', 'Albacete', 'Alicante', 'Almería', 'Asturias', 'Ávila', 'Badajoz', 'Baleares', 'Barcelona', 'Burgos', 
        'Cáceres', 'Cádiz', 'Cantabria', 'Castellón', 'Ciudad Real', 'Córdoba', 'Cuenca', 'Girona', 'Granada', 'Guadalajara', 
        'Guipúzcoa', 'Huelva', 'Huesca', 'Jaén', 'La Rioja', 'Las Palmas', 'León', 'Lleida', 'Lugo', 'Madrid', 'Málaga', 
        'Murcia', 'Navarra', 'Ourense', 'Palencia', 'Pontevedra', 'Salamanca', 'Santa Cruz de Tenerife', 'Segovia', 'Sevilla', 
        'Soria', 'Tarragona', 'Teruel', 'Toledo', 'Valencia', 'Valladolid', 'Vizcaya', 'Zamora', 'Zaragoza'
      ],
      iconVisible: true
    };
  },
  methods: {
    hideIcon() {
      this.iconVisible = false;
    },
    showIcon() {
      this.iconVisible = true;
    }
  }
};
</script>

<style scoped>
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

</style>
