import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import inertia from '@inertiajs/vite';

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
    wayfinder({
      formVariants: true,
    }),
  ],
});
