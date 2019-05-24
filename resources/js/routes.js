import VueRouter from 'vue-router';
import AppBackend from './components/backend/AppBackend';
import LoginBackend from './components/backend/LoginBackend';
import AppFrontend from './components/frontend/AppFrontend';
import BackendRoutes from './backend-routes';
import FrontedRoutes from './frontend-routes';
let routes = [
    {
        path: '/admin/login',
        component: LoginBackend,
        hidden: true,
    },
    {
        path: '/admin',
        component: AppBackend,
        children: BackendRoutes,
    },
    {
        path: '',
        component: AppFrontend,
        children: FrontedRoutes,
    },
];

export default new VueRouter({
    routes: routes,
    mode: 'history',
})
