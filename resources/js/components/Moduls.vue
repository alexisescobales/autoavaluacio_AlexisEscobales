<template>
  <div class="container">
    <h1>Usuario Autenticado</h1>
    <p>Nombre: {{ usuario.nom }}</p>
    <p>Email: {{ usuario.correu }}</p>
    <h2>Módulos Matriculados</h2>
    <ul class="module-list">
      <li v-for="modulo in modulos" :key="modulo.id" @click="fetchResultadosAprendizaje(modulo)">
        {{ modulo.nom }}
      </li>
    </ul>
    <h2>Resultados de Aprendizaje</h2>
    <ul class="resultados-list">
      <li v-for="resultado in resultadosAprendizaje" :key="resultado.id" class="resultado-item">
        <p class="resultado-title">{{ resultado.descripcio }}</p>
        <ul class="criterios-list">
          <li v-for="criterio in resultado.criterisAvaluacio" :key="criterio.id" class="criterio-item">
            {{ criterio.descripcio }}
          </li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      usuario: null,
      modulos: [],
      resultadosAprendizaje: []
    };
  },
  created() {
    const modulsElement = document.getElementById('moduls');
    const usuarioData = modulsElement.getAttribute('data-usuario');
    this.usuario = JSON.parse(usuarioData);

    this.fetchModulos(this.usuario.id);
  },
  methods: {
    fetchModulos(id) {
      axios.get(`/autoavaluacio_AlexisEscobales/public/api/AutoavaluacioApi/modulos/${id}`)
        .then(response => {
          this.modulos = response.data;
        })
        .catch(error => {
          console.error('Error fetching modulos:', error);
        });
    },
    fetchResultadosAprendizaje(modulo) {
      axios.get(`/autoavaluacio_AlexisEscobales/public/api/AutoavaluacioApi/ra/${modulo.id}`)
        .then(response => {
          this.resultadosAprendizaje = response.data;
        })
        .catch(error => {
          console.error('Error fetching resultados de aprendizaje:', error);
        });
    }
  }
}
</script>

<style scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
}

.module-list {
  list-style-type: none;
  padding: 0;
}

.module-list li {
  cursor: pointer;
  margin-bottom: 5px;
  padding: 10px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.resultados-list {
  list-style-type: none;
  padding: 0;
}

.resultado-item {
  margin-bottom: 20px;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.resultado-title {
  margin-bottom: 10px;
  font-weight: bold;
}

.criterios-list {
  list-style-type: none;
  padding: 0;
}

.criterio-item {
  margin-bottom: 5px;
}
</style>
