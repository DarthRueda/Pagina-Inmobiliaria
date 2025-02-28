<template>
    <div class="row no-gutters">
        <div class="col-6">
            <div class="main-image"></div>
        </div>
        <div class="col-6">
            <div class="row no-gutters">
                <div class="col-6 secondary-image"></div>
                <div class="col-6 secondary-image"></div>
            </div>
            <div class="row no-gutters">
                <div class="col-6 secondary-image"></div>
                <div class="col-6 secondary-image"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ImageMosaic'
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
}

.main-image {
    border: 1px solid #000;
    height: 357px;
    width: 100%;
}

.secondary-image {
    border: 1px solid #000;
    height: 178.5px;
    width: 50%;
}
</style>
