<template>
  <div>
    <h1>Módulos del Usuario</h1>
    <ul>
      <li v-for="modulo in modulos" :key="modulo.id">
        {{ modulo.nombre }}
      </li>
    </ul>
  </div>
</template>

<script>
import Vue from 'vue';
import axios from 'axios';

export default {
  data() {
    return {
      modulos: [],
      usuario: null
    };
  },
  created() {
    this.fetchModulos();
  },
  methods: {
    fetchModulos() {
      axios.get('/api/autoavaluacio')
        .then(response => {
          this.modulos = response.data.modulos;
        })
        .catch(error => {
          console.error('Error fetching modulos:', error);
        });

        axios.get('api/AutoavaluacioController')
        .then(response => {
          this.usuario = response.data;
        })
        .catch(error => {
          console.error('Error fetching modulos:', error);
        });
    }
  }
}
</script>
