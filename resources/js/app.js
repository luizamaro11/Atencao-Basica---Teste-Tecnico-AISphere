import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Indicador de força de senha — disponível globalmente para as views Blade
import { initPasswordStrength } from './password-strength';
window.initPasswordStrength = initPasswordStrength;

