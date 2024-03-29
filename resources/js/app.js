import './bootstrap';
import '../css/app.css';
// Import icon libraries
import "@quasar/extras/material-icons/material-icons.css";

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { Quasar } from 'quasar'
// Import Quasar css
import '../css/quasar.css'
import Notifications from '@kyvg/vue3-notification'
import { modal } from 'momentum-modal'
import CanDirective from "@/Data/Directives/Can";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Notifications)
            .use(Quasar)
            .use(modal, {
                resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
            })
            .directive('can', CanDirective)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
