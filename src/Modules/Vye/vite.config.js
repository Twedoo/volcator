import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import vueJsx from "@vitejs/plugin-vue-jsx";
import viteSvgIcons from "vite-plugin-svg-icons";
import { resolve } from "path";
import commonjs from "@rollup/plugin-commonjs";
import externalGlobals from "rollup-plugin-external-globals";
// import eslintPlugin from 'vite-plugin-eslint';

// https://vitejs.dev/config/
export default defineConfig({
    base: "",
    plugins: [
        vue(),
        vueJsx({}),
        viteSvgIcons({
            iconDirs: [resolve(process.cwd(), "./Views/Vue/src/icons/svg")],
            symbolId: "icon-[dir]-[name]"
        })
        // eslintPlugin()
    ],

    resolve: {
        alias: {
            "@": resolve(__dirname, "./Views/Vue/src")
        },
        extensions: [".js", ".vue", ".json", ".ts"]
    },

    optimizeDeps: {
        include: ["./Views/Vue/lib/vuedraggable/dist/vuedraggable.umd.js", "quill", "feathers-vuex > fast-copy"]
    },
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `
                @use "@/styles/element/index.scss" as *;
                @import "@/styles/global.scss";
                `
            }
        }
    },
    build: {
        outDir: "./Media/dist",
        manifest: true,
        chunkSizeWarningLimit: 7600,
        commonjsOptions: {
            exclude: [
                "./Views/Vue/lib/vuedraggable/dist/vuedraggable.umd.js,"
            ],
            include: []
        },
        rollupOptions: {
            output: {
                entryFileNames: () => "app.js"
            },
            input: {
                main: resolve(__dirname, "./Views/Vue/index.html")
            }
        }
    }
});
