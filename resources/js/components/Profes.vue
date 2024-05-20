<template>
  <div class="container">
    <h1>Bienvenido {{ usuario.nom }} {{ usuario.cognom }}</h1>
    <h2>Lista de Alumnos</h2>
    <ul class="alumnos-list">
      <li v-for="alumno in alumnos" :key="alumno.id" @click="toggleModulos(alumno)">
        <!-- Muestra la información de cada alumno -->
        <p>{{ alumno.nom }} {{ alumno.cognom }}</p>
        <p>{{ alumno.correu }}</p>
        <!-- Agrega más detalles según sea necesario -->
        <!-- Muestra los módulos si están visibles -->
        <ul v-if="alumno.showModulos" class="modulos-list">
          <li v-for="modulo in alumno.modulos" :key="modulo.id" @click.stop="toggleResultadosAprendizaje(modulo, alumno.id, alumno)">
            {{ modulo.nom }}
            <!-- Muestra los resultados si están visibles -->
            <ul v-if="modulo.showResultados" class="resultados-list">
              <li v-for="resultado in resultadosAprendizaje" :key="resultado.id" class="resultado-item">
                <p class="resultado-title">{{ resultado.descripcio }}</p>
                <ul class="criterios-list">
                  <li v-for="criterio in resultado.criterisAvaluacio" :key="criterio.id" class="criterio-item">
                    {{ criterio.descripcio }}
                    <!-- Cambia la lista de rubricas por un select deshabilitado -->
                    <select v-model="criterio.nota" disabled>
                      <option v-for="(rubrica, index) in criterio.rubricas" :key="index" :value="rubrica.nivell">
                        {{ rubrica.nivell }} - {{ rubrica.descripcio }}
                      </option>
                    </select>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
    <!-- Muestra los resultados de aprendizaje y criterios -->
  </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      usuario: null,
      alumnos: [],
      modulos: [],
      resultadosAprendizaje: []
    };
  },
  created() {
    const profesElement = document.getElementById('profes');
    const usuarioData = profesElement.getAttribute('data-usuario');
    this.usuario = JSON.parse(usuarioData);
    this.fetchAlumnos();
  },
  methods: {
    fetchAlumnos() {
      axios.get('/autoavaluacio_AlexisEscobales/public/api/getUsuaris')
        .then(response => {
          this.alumnos = response.data.map(alumno => ({
            ...alumno,
            showModulos: false, // Agrega una propiedad para controlar la visibilidad de los módulos
            modulos: [] // Inicializa la lista de módulos
          }));
        })
        .catch(error => {
          console.error('Error fetching alumnos:', error);
        });
    },
    toggleModulos(alumno) {
      alumno.showModulos = !alumno.showModulos;
      if (alumno.showModulos && alumno.modulos.length === 0) {
        axios.get(`/autoavaluacio_AlexisEscobales/public/api/AutoavaluacioApi/modulos/${alumno.id}`)
          .then(response => {
            alumno.modulos = response.data.map(modulo => ({
              ...modulo,
              showResultados: false // Inicializa la lista de resultados de aprendizaje
            }));
          })
          .catch(error => {
            console.error('Error fetching modulos:', error);
          });
      }
    },
    toggleResultadosAprendizaje(modulo, alumnoId, alumno) {
      modulo.showResultados = !modulo.showResultados;
      if (modulo.showResultados) {
        axios.get(`/autoavaluacio_AlexisEscobales/public/api/AutoavaluacioApi/ra/${modulo.id}/${alumnoId}`)
          .then(response => {
            this.resultadosAprendizaje = response.data;
            this.resultadosAprendizaje.forEach(resultado => {
              resultado.criterisAvaluacio.forEach(criterio => {
                // Asegúrate de que 'nota' esté correctamente inicializado
                this.$set(criterio, 'nota', criterio.nota || null);
              });
            });
          })
          .catch(error => {
            console.error('Error fetching resultados de aprendizaje:', error);
          });
      }
    }
  }
}

</script>

<style scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
}

.alumnos-list {
  list-style-type: none;
  padding: 0;
}

.alumnos-list li {
  margin-bottom: 10px;
  padding: 10px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.modulos-list {
  list-style-type: none;
  padding: 0;
}

.modulos-list li {
  padding: 5px;
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

select {
  width: 100%;
  padding: 5px;
  border: 1px solid #ccc;
}
</style>

