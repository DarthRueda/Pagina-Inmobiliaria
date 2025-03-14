<template>
    <div class="panelusuario mt-50">
      <div class="row">
        <!-- Columna para las opciones -->
        <div class="col-md-3">
          <PanelUsuarioOpciones @enable-editing="enableEditing" />
        </div>
        <!-- Columna para el contenido -->
        <div class="col-md-9">
          <!-- Aquí puedes mostrar más contenido si lo necesitas -->
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import PanelUsuarioOpciones from "@/components/PanelUsuarioOpciones.vue";
  
  export default {
    components: {
      PanelUsuarioOpciones
    },
    methods: {
      enableEditing() {
        console.log("Habilitar edición");
        // Aquí puedes agregar lógica para habilitar la edición
      }
    }
  };
  </script>
  
  <style scoped>
  .row {
    margin-right: 0;
    margin-left: 0;
  }
  
  .ml-20 {
    margin-left: 20px;
    width: 23%;
  }
  .mt-50 {
    margin-top: 50px;
  }
  .mb-30 {
    margin-bottom: 30px;
  }
  .mb-50 {
    margin-bottom: 50px;
  }
  .ml-2 {
    margin-left: 10px;
  }
  </style>
  