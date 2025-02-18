<template>
    <div class="panelusuario mt-50">
        <div class="row">
            <div class="col-3 ml-20">
                <div class="options-box">
                    <div class="option">
                        <img src="/images/panelusuario/casa.svg" alt="icon" width="27" height="27">
                        <span>Mis propiedades</span>
                    </div>
                    <div class="option">
                        <img src="/images/panelusuario/corazon.svg" alt="icon" width="27" height="27">
                        <span>Favoritos</span>
                    </div>
                    <div class="option">
                        <img src="/images/panelusuario/usuario.svg" alt="icon" width="27" height="27">
                        <span>Editar mis datos</span>
                    </div>
                    <div class="option">
                        <img src="/images/panelusuario/papelera.svg" alt="icon" width="27" height="27">
                        <span>Eliminar Cuenta</span>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <h1 class="mb-30">Panel de Usuario</h1>
                <div class="form-group mb-50">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" class="form-control">
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="input1">Email</label>
                        <input type="text" id="email" class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="input2">Telefono</label>
                        <input type="text" id="telefono" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
</script>

<style scoped>
.row{
    margin-right: 0;
    margin-left: 0;
}
.options-box {
    border: 1px solid #ccc;
    padding: 10px;
}

.option {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.option img {
    margin-right: 10px;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
}

.form-row {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

.form-group.col-6 {
    width: 48%;
    padding: 0;
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
</style>