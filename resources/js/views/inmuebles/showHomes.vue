<template>
    <div>
        <h1>Mostrar Inmuebles</h1>



        <div class="list-inmuebles">
            <button>Comprar</button>
            <button>Alquilar</button>
            <CardInmuebles />
        </div>

        <div class="filters">
            <h2>Filtros</h2>
            <div>
                <label for="price">Precio</label>
                <input type="number" id="price" />
            </div>
            <div>
                <label for="rooms">Habitaciones</label>
                <input type="number" id="rooms" />
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
/* Add your styles here */
</style>