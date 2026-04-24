import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import inertia from '@inertiajs/vite';
import path from 'path';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/js/app.ts', 'resources/css/filament/admin/theme.css'],
      ssr: 'resources/js/ssr.ts',
      refresh: true,
    }),
    inertia(),
    tailwindcss(),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
        compilerOptions: {
          isCustomElement: (tag) => ['swiper-container', 'swiper-slide'].includes(tag),
        },
      },
    }),
  ],
  resolve: {
    alias: {
      'ziggy-js': path.resolve('vendor/tightenco/ziggy'),
    },
  },
});
