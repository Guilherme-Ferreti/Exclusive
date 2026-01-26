import 'vue-toastification/dist/index.css';
import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { createPinia } from 'pinia';
import { register as registerSwiper } from 'swiper/element/bundle';
import { createApp, DefineComponent, h } from 'vue';
import Toast, { PluginOptions } from 'vue-toastification';
import AppLayout from './layouts/AppLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const toastOptions: PluginOptions = {
  transition: 'Vue-Toastification__fade',
};

createInertiaApp({
  title: (title) => (title ? `${title} - ${appName}` : appName),
  resolve: async (name) => {
    const pages = import.meta.glob('./pages/**/*.vue', { eager: true });
    const page = pages[`./pages/${name}.vue`] as DefineComponent;

    page.default.layout = page.default.layout || AppLayout;

    return page;
  },
  setup({ el, App, props, plugin }) {
    registerSwiper();
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(createPinia())
      .use(Toast, toastOptions)
      .mount(el);
  },
  progress: {
    color: '#4B5563',
  },
});
