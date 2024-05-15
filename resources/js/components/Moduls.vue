<template>
  <div>
    <h1>Usuario Autenticado</h1>
    <p>Nombre: {{ usuario.nom }}</p>
    <p>Email: {{ usuario.correu }}</p>
    <!-- Muestra otras propiedades del usuario según sea necesario -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      usuario: null
    };
  },
  created() {
    // Obtener los datos del usuario del atributo 'data-usuario' del div
    const modulsElement = document.getElementById('moduls');
    const usuarioData = modulsElement.getAttribute('data-usuario');
    this.usuario = JSON.parse(usuarioData);
  }
}

</script>
