import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    build: {
        manifest: true,
        rtl: true,
        outDir: 'public/build/',
        cssCodeSplit: true,
        rollupOptions: {
            input: {
                main: 'resources/js/app.js', // Punto de entrada para el JS
                styles: 'resources/css/app.css' // Punto de entrada para el CSS
            }
        },
    },
    optimizeDeps: {
        include: ['axios'],
    },
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/css/app.css'],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/css',
                    dest: 'css'
                },
                {
                    src: 'resources/fonts',
                    dest: ''
                },
                {
                    src: 'resources/images',
                    dest: ''
                },
                {
                    src: 'resources/js',
                    dest: ''
                },
                {
                    src: 'resources/maps',
                    dest: ''
                },
                {
                    src: 'resources/scss',
                    dest: ''
                },
            ],
        }),
    ],
});
