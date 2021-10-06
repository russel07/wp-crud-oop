export default {
    template: `
    <div class="wrap">
        <h1 class="wp-heading-inline">Products</h1>
        <a href="#/add-product" class="page-title-action">Add Product</a>
        <table class="wp-list-table widefat fixed striped table-view-list products">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Product Description</th>
                    <th>Product Price</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in products" :key="index">
                    <td>{{item.product_title}}</td>
                    <td>{{item.product_description}}</td>
                    <td>{{item.price}}</td>
                </tr>
            </tbody>
        </table>
    </div>`,

    data(){
        return  {
            products: []
        }
    },

    created: function () {
        this.getProducts();
    },
    methods: {
        getProducts: function(){
            var root = this;

            axios.get('http://wp.test/wp-json/crudAPI/v1/products')
            .then(function (response) {
                root.products = response.data;


                console.log(root.products);
                console.log(response.data);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
}