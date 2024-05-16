<template>
  <div class="container">
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
            <!-- Cambia la lista de rubricas por un select -->
            <select v-model="criterio.nota" @change="updateNota(criterio)">
              <option v-for="(rubrica, index) in criterio.rubricas" :key="index" :value="rubrica.nivell">
                {{ rubrica.nivell }} - {{ rubrica.descripcio }}
              </option>
            </select>
            <!-- Mostrar la nota asociada al criterio -->
            <p>Nota: {{ criterio.nota }}</p>
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
      resultadosAprendizaje: [],
      criterio: {}
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
      axios.get(`/autoavaluacio_AlexisEscobales/public/api/AutoavaluacioApi/ra/${modulo.id}/${this.usuario.id}`)
        .then(response => {
          this.resultadosAprendizaje = response.data;
          // Inicializar selectedRubrica con un objeto vacío para cada criterio
          this.resultadosAprendizaje.forEach(resultado => {
            resultado.criterisAvaluacio.forEach(criterio => {
              // Asegúrate de que cada criterio tenga una propiedad de nota inicializada
              this.$set(criterio, 'nota', null);
            });
          });
        })
        .catch(error => {
          console.error('Error fetching resultados de aprendizaje:', error);
        });
    },
    updateNota(criterio) {
  axios.put('/autoavaluacio_AlexisEscobales/public/api/AutoavaluacioApi/update-notas/${this.usuario.id}', criterio)
    .then(response => {
      console.log('Nota actualizada:', response.data);
    })
    .catch(error => {
      console.error('Error updating nota:', error);
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

/* Estilo adicional para el select */
select {
  width: 100%;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
}
</style>
