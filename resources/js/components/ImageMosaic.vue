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
export default {
    name: 'ImageMosaic',
    props: {
        images: {
            type: Array,
            required: true
        }
    },
    computed: {
        mainImage() {
            return this.images.length > 0 ? this.images[0] : null;
        },
        secondaryImages() {
            return this.images.slice(1);
        }
    }
}
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