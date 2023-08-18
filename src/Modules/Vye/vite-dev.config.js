import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import vueJsx from "@vitejs/plugin-vue-jsx";
import viteSvgIcons from "vite-plugin-svg-icons";
import { resolve } from "path";

// https://vitejs.dev/config/
export default defineConfig({
    base: "",
    // server: {
    //     host: '172.16.230.2',
    // },
    plugins: [
        vue(),
        vueJsx({}),
        viteSvgIcons({
            iconDirs: [resolve(process.cwd(), "./Views/Vue/src/icons/svg")],
            symbolId: "icon-[dir]-[name]"
        })
    ],

    resolve: {
        alias: {
            "@": resolve(__dirname, "./Views/Vue/src")
        },
        extensions: [".js", ".vue", ".json", ".ts"]
    },

    optimizeDeps: {
        include: ["@/../lib/vuedraggable/dist/vuedraggable.umd.js", "quill"]
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
        rollupOptions: {
            input: {
                main: resolve(__dirname, "Views/Vue/index.html")
            }
        }
    }
});
