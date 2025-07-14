import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            crypto: 'crypto-browserify',
            buffer: 'buffer',
            process: 'process/browser',
        },
    },
    define: {
        global: 'globalThis',
        'process.env': {},
    },
    optimizeDeps: {
        include: ['crypto-browserify', 'buffer', 'process'],
    },
});
