<template>
    <div>
        <h1>Listado de Viviendas</h1>
        <Button label="Crear Vivienda" icon="pi pi-plus" @click="$router.push({ name: 'viviendas.create' })" />
        <DataTable :value="viviendas" :paginator="true" :rows="10" :loading="loading">
            <Column field="id" header="ID" />
            <Column field="localizacion" header="Localización" />
            <Column field="precio" header="Precio" />
            <Column field="tipo" header="Tipo" />
            <Column header="Acciones">
                <template #body="slotProps">
                    <Button icon="pi pi-pencil" @click="$router.push({ name: 'viviendas.edit', params: { id: slotProps.data.id } })" />
                    <Button icon="pi pi-trash" class="p-button-danger" @click="deleteVivienda(slotProps.data.id)" />
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'ViviendasIndex',
    setup() {
        const viviendas = ref([]);
        const loading = ref(false);

        const fetchViviendas = async () => {
            loading.value = true;
            try {
                const response = await axios.get('/api/viviendas');
                viviendas.value = response.data;
            } catch (error) {
                console.error('Error fetching viviendas:', error);
            } finally {
                loading.value = false;
            }
        };

        const deleteVivienda = async (id) => {
            if (confirm('¿Estás seguro de que deseas eliminar esta vivienda?')) {
                try {
                    await axios.delete(`/api/vivienda/${id}`);
                    viviendas.value = viviendas.value.filter(v => v.id !== id);
                } catch (error) {
                    console.error('Error deleting vivienda:', error);
                }
            }
        };

        onMounted(fetchViviendas);

        return { viviendas, loading, deleteVivienda };
    }
};
</script>