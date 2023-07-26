import FastGlob from 'fast-glob'
import { resolve } from 'path';
import autoprefixer from 'autoprefixer';

const reload = {
    name: 'reload',
    handleHotUpdate({ file, server }) {
        if (!file.includes('temp') && (file.endsWith(".php") || file.endsWith(".latte") || file.endsWith(".ts") || file.endsWith(".scss"))) {
            server.ws.send({
                type: 'full-reload',
                path: '*',
            });
        }
    }
}

export default {
    plugins: [reload],
    css: {
        postcss: {
            plugins: [autoprefixer],
        },
        preprocessorOptions: {
            scss: {
                outputStyle: 'compressed',
                quietDeps: true,
                outFile: 'www/assets/main.css',
            },
        },
    },
    server: {
        watch: {
            usePolling: true,
        },
        hmr: {
            host: 'localhost',
            port: 8000,
        },
        manifest: true,
        outDir: "www",
        emptyOutDir: false,
    },
    build: {
        manifest: true,
        outDir: "www",
        emptyOutDir: false,
        cssCodeSplit: false,
        rollupOptions: {
            input: FastGlob.sync(['./frontend/scripts/*.{js,ts}', './frontend/styles/*.{scss}']).map(entry => resolve(process.cwd(), entry))
        }
    }
}
