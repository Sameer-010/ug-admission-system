/**
 * ✅ resources/js/app.js
 * Full working setup for Bootstrap + Alpine
 */
import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js'; // ✅ Ensures dropdowns work

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

console.log('%c✅ JS Loaded: Bootstrap + Alpine working', 'color: green');
