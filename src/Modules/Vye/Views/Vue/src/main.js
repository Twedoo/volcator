import { createApp } from "vue";
import axios from "axios";
import { createRouter, createWebHistory } from 'vue-router';

import App from "./App.vue";
import ElementPlus from "element-plus";
import "./iconfont/iconfont.css";
import Draggable from "@/../lib/vuedraggable/dist/vuedraggable.umd.js";
import { registerIcon } from "@/utils/el-icons";
import "virtual:svg-icons-register";
import 'globalthis/auto'; // Ajoutez cette ligne

import LayoutsWidgets from "@/components/form-designer/form-widget/layout-widget/index";
import ContainerWidgets from "@/components/form-designer/form-widget/container-widget/index";
import ContainerItems from "@/components/form-render/container-item/index";

import router from '@/router'
import { addDirective } from "@/utils/directive";
import { installI18n } from "@/utils/i18n";
import { loadExtension } from "@/extension/extension-loader";

if (typeof window !== "undefined") {
    window.axios = axios;
}

const vfApp = createApp(App);

vfApp.use(ElementPlus);
registerIcon(vfApp);

/*eslint-disable */
vfApp.component("Draggable", Draggable);
addDirective(vfApp);
installI18n(vfApp);

vfApp.use(LayoutsWidgets);
vfApp.use(ContainerWidgets);
vfApp.use(ContainerItems);
loadExtension(vfApp);

import "@/styles/app-stone.css";
import "@/styles/app-ide.css";
import "@/styles/element/theme-chalk/index.css";

vfApp.use(router).mount("#app");
