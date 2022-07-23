import Index from '@/pages/index';
import List from '@/pages/list';
import Create from '@/pages/create';
import View from '@/pages/view';

import { createWebHistory, createRouter } from "vue-router";

const routes = [
    {
        path: '',
        component: Index,
        children: [
            {
                path: '',
                name: 'list',
                component: List,
            },
            {
                path: ':id',
                name: 'view',
                component: View,
            },
            {
                path: 'create',
                name: 'create',
                component: Create,
            },
        ]
    },
];

const index = createRouter({
    history: createWebHistory(),
    routes,

});

export default index;
