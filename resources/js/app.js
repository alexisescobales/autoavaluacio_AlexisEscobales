import { createApp } from 'vue';
import Moduls from './components/Moduls.vue';
import Profes from './components/Profes.vue';

document.addEventListener('DOMContentLoaded', () => {
    // Función para montar el componente Moduls
    const mountModuls = () => {
        const modulsElement = document.getElementById('moduls');
        if (modulsElement) {
            const usuarioDataModuls = modulsElement.getAttribute('data-usuario');
            const usuarioModuls = JSON.parse(usuarioDataModuls);
            const appModuls = createApp(Moduls);
            appModuls.mount('#moduls', { usuario: usuarioModuls });
        }
    };

    // Función para montar el componente Profes
    const mountProfes = () => {
        const profesElement = document.getElementById('profes');
        if (profesElement) {
            const usuarioDataProfes = profesElement.getAttribute('data-usuario');
            const usuarioProfes = JSON.parse(usuarioDataProfes);
            const appProfes = createApp(Profes);
            appProfes.mount('#profes', { usuario: usuarioProfes });
        }
    };

    // Llama a las funciones de montaje para ambos componentes
    mountModuls();
    mountProfes();
});
