import Products from '../components/Products.js'

const routes = [
    { path: '/products', name:'Products', component: Products }
];

const router = new VueRouter({
    routes
});

export default router;