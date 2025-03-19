<template>
    <div class="row no-gutters">
        <div class="col-6">
            <div class="main-image" v-if="mainImage">
                <img :src="mainImage" alt="Main Image" />
            </div>
        </div>
        <div class="col-6">
            <div class="row no-gutters">
                <div class="col-6 secondary-image" v-for="(image, index) in secondaryImages" :key="index">
                    <img :src="image" alt="Secondary Image" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent, computed } from 'vue';

export default defineComponent({
  name: 'ImageMosaic',
  props: {
    images: {
      type: Array,
      required: true
    }
  },
  setup(props) {
    const images = ref(props.images);

    const mainImage = computed(() => {
      return images.value.length > 0 ? images.value[0] : null;
    });

    const secondaryImages = computed(() => {
      return images.value.slice(1);
    });

    return {
      mainImage,
      secondaryImages
    };
  }
});
</script>

<style scoped>
.row.no-gutters {
    margin-right: 0;
    margin-left: 0;
}

.col-6 {
    padding-right: 0;
    padding-left: 0;
    padding: 0;
}

.main-image img,
.secondary-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>