import Dashboard from './components/backend/Dashboard';
import Elements from './components/backend/Elements';
import ProductList from './components/backend/products/List';
import ShowProduct from './components/backend/products/Show';
import CreateProduct from './components/backend/products/Create';
import EditProduct from './components/backend/products/Edit';
import NotFound from './components/backend/NotFound';

let routes = [
    {
        path: '',
        component: Dashboard,
        name: 'dashboard',
    },
    {
        path: 'elements',
        component: Elements,
        name: 'elements',
    },
    {
        path: 'products',
        component: ProductList,
        name: 'products',
    },
    {
        path: 'products/add',
        component: CreateProduct,
        name: 'create-product',
    },
    {
        path: 'products/:id',
        component: ShowProduct,
        name: 'show-product',
    },
    {
        path: 'products/edit/:id',
        component: EditProduct,
        name: 'edit-product',
    },
    {
        path: '*',
        component: NotFound,
    },
];

export default routes;