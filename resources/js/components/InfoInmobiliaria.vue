<template>
    <div class="info-inmobiliaria row">
        <div class="column col-4 center">
            <img src="path/to/image.jpg" alt="Inmobiliaria Image" class="image">
        </div>
        <div class="column col-4">
            <h1 class="title">Lorem Ipsum</h1>
            <h2 class="subtitle">Lorem ipsum dolor sit amet</h2>
            <h2 class="subtitle light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut elit a sapien imperdiet sodales vel vitae erat. Suspendisse eget ligula et dolor ultricies malesuada.</h2>
        </div>
        <div class="column col-4 center">
            <a href="#" class="link">Pagina Web</a>
            <a href="#" class="link">Telefono</a>
            <button class="contact-button">Contacta</button>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue';

export default defineComponent({
  props: {
    info: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    const info = ref(props.info);
    return {
      info
    };
  }
});
</script>

<style scoped>
.info-inmobiliaria {
    width: calc(100% - 38px);
    margin: 0 19px;
    box-sizing: border-box;
    background-color: #D9D9D9;
    position: relative;
    z-index: 1; 
    margin-top: -60px;
    margin-bottom: 30px;
}

.column {
    padding: 10px;
    display: flex;
    flex-direction: column;
}

.column.center {
    align-items: center;
}

.image {
    width: 138px;
    height: 116px;
}

.title {
    font-size: 36px;
    margin-bottom: -10px;
}

.subtitle {
    font-size: 14px;
    margin-bottom: -10px;
}

.subtitle.light {
    font-weight: lighter;
    margin-bottom: 10px;
}

.link {
    display: block;
    margin-bottom: 10px;
}

.contact-button {
    margin-top: 10px;
}
</style>
