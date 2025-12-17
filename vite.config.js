import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['tailwindcss'],
                },
            },
        },
        cssCodeSplit: true,
        sourcemap: false,
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
            },
        },
    },
    server: {
        watch: {
            ignored: [
                '**/storage/framework/views/**',
                '**/storage/logs/**',
                '**/node_modules/**',
                '**/vendor/**',
            ],
        },
        hmr: {
            overlay: false,
        },
    },
    optimizeDeps: {
        include: ['tailwindcss'],
    },
});
