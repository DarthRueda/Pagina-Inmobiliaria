<template>
    <div>
        <h1>Mostrar Inmuebles</h1>
        <button>Comprar</button>
        <button>Alquilar</button>

        <div class="container">
            <div class="filters col-md-3">
                <h2>Filtros</h2>
                <div>
                    <label for="price">Precio</label>
                    <input type="number" id="price" />
                </div>
                <div>
                    <label for="rooms">Habitaciones</label>
                    <input type="checkbox" id="rooms" /> 1
                    <input type="checkbox" id="rooms" />2
                    <input type="checkbox" id="rooms" />3
                    <input type="checkbox" id="rooms" />4+
                </div>
                <div>
                    <label for="bathrooms">Baños</label>
                    <input type="number" id="bathrooms" />
                </div>
                <div>
                    <label for="garage">Garage</label>
                    <input type="checkbox" id="garage" />
                </div>
                <div>
                    <label for="garden">Jardín</label>
                    <input type="checkbox" id="garden" />
                </div>
                <div>
                    <label for="pool">Piscina</label>
                    <input type="checkbox" id="pool" />
                </div>
                <div>
                    <label for="elevator">Ascensor</label>
                    <input type="checkbox" id="elevator" />
                </div>
                <div>
                    <label for="air-conditioning">Aire acondicionado</label>
                    <input type="checkbox" id="air-conditioning" />
                </div>
                <div>
                    <label for="heating">Calefacción</label>
                    <input type="checkbox" id="heating" />
                </div>
                <div>
                    <label for="furnished">Amueblado</label>
                    <input type="checkbox" id="furnished" />
                </div>
                <div>
                    <label for="security">Seguridad</label>
                    <input type="checkbox" id="security" />
                </div>
                <div>
                    <label for="new">Obra nueva</label>
                    <input type="checkbox" id="new" />
                </div>
                <div>
                    <label for="second-hand">Segunda mano</label>
                    <input type="checkbox" id="second-hand" />
                </div>
            </div>

            <div class="list-inmuebles col-md-9">
                <CardInmuebles />
            </div>
        </div>
    </div>
</template>

<script>
import CardInmuebles from '../../components/CardInmueble.vue';

export default {
    name: 'ShowHomes',
    components: {
        CardInmuebles
    }
};
</script>

<style scoped>
.container {
    display: flex;
    margin: 0;
    padding: 0;
}
.filters {
    margin-right: 20px;
}
</style>