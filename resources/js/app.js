import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

window.startApp = function() {
    console.log("Start App");
    Alpine.start();
}
