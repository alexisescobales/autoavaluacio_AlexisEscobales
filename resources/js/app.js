import { createApp } from 'vue';
import Moduls from './components/Moduls.vue';

const app = createApp(Moduls);

const modulsElement = document.getElementById('moduls');
const usuarioData = modulsElement.getAttribute('data-usuario');
const usuario = JSON.parse(usuarioData);

app.mount('#moduls', { usuario });
