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
            'resources/js/main.js',
            'resources/js/apply_document_type/apply_document_type.js',
            'resources/js/applytype/applytype.js',
            'resources/js/employees/employees.js',
            'resources/js/client/edit.js',
            'resources/js/folders/folder.js', // Update the entry module here
            'resources/js/deparmentsandcities.json',
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
