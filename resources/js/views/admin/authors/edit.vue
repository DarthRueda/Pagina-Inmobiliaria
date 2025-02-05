<template>
    <div class="grid">
    <div class="col-12">
        <div class="card">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Editar Autores</h2></div>
                </div>
 
 
                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" class="form-control" id="id"  readonly>
                </div>
 
 
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control"  id="name">
                </div>
 
 
                <div class="mb-3">
                    <label for="surname" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="surname">
                    <Message v-for = "error in errors.surname" severity="error" text="error"></Message>
                </div>
 
 
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email">
                </div>
 
 
                <button type="submit" class="btn btn-primary" @click="updateAuthor" >Guardar cambios</button>
 
 
            </div>
 
 
        </div>
    </div>
 </div>
</template>

<script setup>
import {ref, onMounted} from "vue";
import {useRoute} from "vue-router";
import {Message, useToast} from "primevue";
import * as yup from "yup";
import Axios from "axios";




const route = useRoute();
const toast = useToast();
const authors = ref([]);


const schema = yup.object().shape({
    id: yup.number().required(),
    name: yup.string().required(),
    surname: yup.string().required(),
    email: yup.string().email().required()
});

onMounted(() => {
    console.log("route.params.id");
    console.log(route.params.id);

    Axios.get('/api/author/' + route.params.id)
        .then(response => {
            console.log(response.data);
            authors.value = response.data;
        });
});

const updateAuthor = async() => {
    Axios.put('/api/author/' + route.params.id, authors.value)
        .then(response => {
            authors.value = response.data.data;
            console.log(response.data.data);
            toast.add({severity:'success', summary: 'Success', detail: 'Author updated successfully'});
        })
}

</script>