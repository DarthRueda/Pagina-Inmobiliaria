<template>
  <div class="centered-form formulario-hipoteca">
    <h1 class="h1-title">Características del inmueble</h1>
    <p class="h2-subtitle">Rellena todos los datos que conozcas; cuanta mas información tengamos, mejor te podremos asesorar.</p>
    <form>
      <div>
        <label for="address" class="form-label">Dirección de la vivienda:</label>
        <input type="text" id="address" v-model="address" class="form-control" />
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
        <input type="number" id="surface" v-model="surface" placeholder="117" class="form-control" />
      </div>
      <div>
        <label for="constructionYear" class="form-label">Año de última reforma:</label>
        <input type="number" id="constructionYear" v-model="constructionYear" placeholder="1978 (año de construcción)" @input="validateYear" class="form-control" />
      </div>
      <div>
        <label for="conservationStatus" class="form-label">Estado de conservación:</label>
        <div class="select-container">
          <select id="conservationStatus" v-model="conservationStatus" class="form-control">
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
          <button type="button" @click="setRooms(1)" class="button small-button">1</button>
          <button type="button" @click="setRooms(2)" class="button small-button">2</button>
          <button type="button" @click="setRooms(3)" class="button small-button">3</button>
          <button type="button" @click="setRooms(4)" class="button small-button">4</button>
          <button type="button" @click="setRooms(5)" class="button small-button">+5</button>
        </div>
      </div>
      <div>
        <label class="form-label">Baños:</label>
        <div class="button-group centered-buttons">
          <button type="button" @click="setBathrooms(1)" class="button small-button">1</button>
          <button type="button" @click="setBathrooms(2)" class="button small-button">2</button>
          <button type="button" @click="setBathrooms(3)" class="button small-button">3</button>
          <button type="button" @click="setBathrooms(4)" class="button small-button">4</button>
          <button type="button" @click="setBathrooms(5)" class="button small-button">+5</button>
        </div>
      </div>
      <div>
        <label class="form-label">Extras:</label>
        <div class="button-group centered-buttons">
          <button type="button" @click="toggleExtra('ascensor')" class="button extra-button">Ascensor</button>
          <button type="button" @click="toggleExtra('garaje')" class="button extra-button">Garaje</button>
          <button type="button" @click="toggleExtra('piscina')" class="button extra-button">Piscina</button>
          <button type="button" @click="toggleExtra('zonasAjardinadas')" class="button extra-button">Zonas ajardinadas</button>
          <button type="button" @click="toggleExtra('zonasDeportivas')" class="button extra-button">Zonas deportivas</button>
          <button type="button" @click="toggleExtra('trastero')" class="button extra-button">Trastero</button>
        </div>
      </div>
    </form>
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
  width: 50%;
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
}
</style>

<script>
export default {
  data() {
    return {
      address: '',
      tipoVivienda: '',
      surface: '',
      constructionYear: '',
      conservationStatus: 'unknown',
      rooms: 0,
      bathrooms: 0,
      extras: []
    };
  },
  methods: {
    setRooms(number) {
      this.rooms = number;
    },
    setBathrooms(number) {
      this.bathrooms = number;
    },
    toggleExtra(extra) {
      const index = this.extras.indexOf(extra);
      if (index > -1) {
        this.extras.splice(index, 1);
      } else {
        this.extras.push(extra);
      }
    },
    validateYear() {
      if (this.constructionYear < 1978) {
        this.constructionYear = 1978;
      } else if (this.constructionYear > 2024) {
        this.constructionYear = 2024;
      }
    }
  }
};
</script>
