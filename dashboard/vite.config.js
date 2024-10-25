import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy'

export default defineConfig({
    build: {
        manifest: true,
        outDir: 'public/build/',
        cssCodeSplit: true,

    },
    plugins: [
        laravel([
            'resources/css/main.css',
            'resources/js/main.js', // Update the entry module here
        ]),
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/css',
                    dest: ''
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
                {
                    src: 'resources/plugins',
                    dest: ''
                },
                {
                    src: 'resources/sass',
                    dest: ''
                },
            ],
        })
    ],
});
