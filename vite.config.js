import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/master.css',
                'resources/css/attendance-create.css',
                'resources/css/attendance-edit.css',
                'resources/css/attendance-index.css',
                'resources/css/departments-create.css',
                'resources/css/departments-edit.css',
                'resources/css/departments-index.css',
                'resources/css/employee-create.css',
                'resources/css/employee-edit.css',
                'resources/css/employee-index.css',
                'resources/css/positions-create.css',
                'resources/css/positions-edit.css',
                'resources/css/positions-index.css',
                'resources/css/salaries-create.css',
                'resources/css/salaries-edit.css',
                'resources/css/salaries-index.css',
            ],
            refresh: true,
        }),
    ],
});
