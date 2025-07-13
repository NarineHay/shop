
import '../assets/css/bootstrap.min.css';
import '../assets/css/font-awesome.min.css';
import '../assets/css/linear-icon.css';
import '../assets/css/plugins.css';
import '../assets/css/default.css';
import '../assets/css/style.css';
import '../assets/css/responsive.css';


import $ from 'jquery';
window.$ = window.jQuery = $;

import '../assets/js/vendor/modernizr-3.5.0.min.js';
// import '../assets/js/vendor/jquery-1.12.4.min.js';  // если надо, но можно опустить — ты уже импортировал jQuery
import '../assets/js/bootstrap.min.js';
import '../assets/js/plugins.js';
import '../assets/js/ajax-mail.js';
// import '../assets/js/main.js';



import '../css/app.css';
import './bootstrap';


import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
// import { initMeanMenu } from './main.js'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
            // document.addEventListener('inertia:finish', () => {
            //     initMeanMenu()
            // })
    },
    progress: {
        color: '#4B5563',
    },
});
