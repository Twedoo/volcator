import { createRouter, createWebHistory } from 'vue-router'

import PreviewRender from "@/components/form-render/preview.vue";
import VolcatorDesigner from '@/components/form-designer/index.vue';

const routes = [
    {
        path: '/preview',
        name: 'Preview',
        component: PreviewRender
    },
    {
        path: '/',
        name: 'VolcatorDesigner',
        component: VolcatorDesigner
    },
    // {
    //     path: '/users/:username',
    //     name: "Users",
    //     component: AppUser,
    //     children: [
    //         {
    //             path: "/user/:username/info",
    //             name: "Info",
    //             component: UserInfo
    //         }
    //     ]
    // }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.VITE_BASE_URL),
    routes
});

export default router
