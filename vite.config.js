import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/main.css',
                'resources/css/app.css',
                'resources/js/main.js',
                'resources/js/app.js',
                'resources/js/admin.js',
                'resources/css/admin.css',
            ],
            refresh: true,
        }),
    ],
});
