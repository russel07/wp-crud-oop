import Products from '../components/Products.js';
import AddProduct from '../components/AddProduct.js';

const routes = [
    { path: '/', name:'Products', component: Products },
    { path: '/add-product', name:'AddProduct', component: AddProduct }
];

const router = new VueRouter({
    routes
});

export default router;