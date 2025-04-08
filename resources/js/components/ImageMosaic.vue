<template>
  <div>
    <div class="row no-gutters">
      <div class="col-6">
        <div class="main-image" v-if="mainImage" @click="openModal(0)">
          <img :src="mainImage" alt="Main Image" />
        </div>
      </div>
      <div class="col-6">
        <div class="row no-gutters">
          <div
            class="col-6 secondary-image"
            v-for="(image, index) in limitedSecondaryImages"
            :key="index"
            @click="openModal(index + 1)"
          >
            <img :src="image" alt="Secondary Image" />
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Image Carousel -->
    <div v-if="isModalOpen" class="modal-overlay" @click="closeModal">
      <div class="modal-content" @click.stop>
        <button class="close-button" @click="closeModal">X</button>
        <div class="carousel">
          <button class="prev-button" @click="prevImage">‹</button>
          <img :src="images[currentImageIndex]" alt="Carousel Image" />
          <button class="next-button" @click="nextImage">›</button>
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
      required: true,
    },
  },
  setup(props) {
    const images = ref(props.images);

    // Main image is the first image in the array
    const mainImage = computed(() => {
      return images.value.length > 0 ? images.value[0] : null;
    });

    // Secondary images are all images except the first one
    const secondaryImages = computed(() => {
      return images.value.slice(1);
    });

    // Limit the number of secondary images displayed in the mosaic
    const limitedSecondaryImages = computed(() => {
      return secondaryImages.value.slice(0, 4); // Show up to 4 secondary images
    });

    const isModalOpen = ref(false);
    const currentImageIndex = ref(0);

    const openModal = (index) => {
      currentImageIndex.value = index;
      isModalOpen.value = true;
    };

    const closeModal = () => {
      isModalOpen.value = false;
    };

    const nextImage = () => {
      currentImageIndex.value =
        (currentImageIndex.value + 1) % images.value.length;
    };

    const prevImage = () => {
      currentImageIndex.value =
        (currentImageIndex.value - 1 + images.value.length) %
        images.value.length;
    };

    return {
      mainImage,
      secondaryImages,
      limitedSecondaryImages,
      isModalOpen,
      currentImageIndex,
      openModal,
      closeModal,
      nextImage,
      prevImage,
    };
  },
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
  cursor: pointer;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  position: relative;
  background: white;
  padding: 20px;
  border-radius: 8px;
  max-width: 80%;
  max-height: 80%;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.close-button {
  position: absolute;
  top: 10px;
  right: 10px;
  background: transparent;
  border: none;
  font-size: 20px;
  cursor: pointer;
  color: black;
  padding: 0px;
}

.carousel {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
}

.carousel img {
  max-width: 80%;
  max-height: 80%;
  object-fit: contain;
}

.prev-button,
.next-button {
  background: transparent;
  border: none;
  font-size: 30px;
  cursor: pointer;
  color: black;
  margin: 0 10px;
}
</style>