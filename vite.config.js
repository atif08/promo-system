import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import sass from 'sass';



export default defineConfig({
    plugins: [
        // laravel({
        //     input: [
        //         'resources/sass/app.scss',
        //         'resources/js/app.js',
        //         'resources/scss/bootstrap.scss',
        //         'resources/scss/icons.scss',
        //         'resources/libs/jquery/jquery.min.js',
        //         'resources/libs/bootstrap/js/bootstrap.min.js',
        //         'resources/libs/metismenu/metisMenu.min.js',
        //         'resources/libs/simplebar/simplebar.min.js',
        //         // 'resources/libs/node-waves/node-waves.min.js',
        //         // 'resources/libs/waypoints/waypoints.min.js',
        //         // 'resources/libs/jquery-counterup/jquery-counterup.min.js',
        //     ],
        //     buildDirectory: 'bundle',
        //     refresh: true,
        // })
    ]
});
