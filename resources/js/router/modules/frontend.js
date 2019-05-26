import Home from '@/components/frontend/Home';
import Collection from '@/components/frontend/Collection';
import About from '@/components/frontend/About';
import Service from '@/components/frontend/Service';
import Blog from '@/components/frontend/Blog';
import Contact from '@/components/frontend/Contact';
import NotFound from '@/components/backend/NotFound';

let routes = [
    {
        path: '',
        component: Home,
        name: 'home',
    },
    {
        path: 'collection',
        component: Collection,
        name: 'collection',
    },
    {
        path: 'about',
        component: About,
        name: 'about',
    },
    {
        path: 'services',
        component: Service,
        name: 'services',
    },
    {
        path: 'blog',
        component: Blog,
        name: 'blog',
    },
    {
        path: 'contact',
        component: Contact,
        name: 'contact',
    },
    {
        path: '*',
        component: NotFound,
    },
];

export default routes;