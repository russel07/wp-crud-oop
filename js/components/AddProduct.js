export default {
    template:`
        <div class="wrap">
            <button class="add-new-h2">Back to list</button>
            <div id="notice" v-if="error" class="error"></div>
            <div id="message" v-if="message" class="updated"></div>
           
    
            <form id="form" method="POST">
    
                <div class="metabox-holder" id="poststuff">
                    <div id="post-body">
                        <div id="post-body-content">
                            <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
                                <tbody>
                                    <tr class="form-field">
                                        <th valign="top" scope="row">
                                            <label for="product_title">Title</label>
                                        </th>
                                        <td>
                                            <input id="product_title" name="product_title" type="text" style="width: 95%" v-model="product_title"
                                                   size="100" class="code" placeholder="Product Title" required>
                                        </td>
                                    </tr>
                                    <tr class="form-field">
                                        <th valign="top" scope="row">
                                            <label for="product_description">Description</label>
                                        </th>
                                        <td>
                                            <textarea id="product_description" name="product_description" v-model="product_description" style="width: 95%" size="200" class="code" placeholder="Product Description" required></textarea>
                                        </td>
                                    </tr>
                                    <tr class="form-field">
                                        <th valign="top" scope="row">
                                            <label for="price">Price</label>
                                        </th>
                                        <td>
                                            <input id="price" name="price" type="number" style="width: 95%" v-model="price"
                                                   size="50" class="code" placeholder="Product Price" required>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
    
                            <input type="button" value="Create" id="submit" class="button-primary" @click="createProduct" name="submit">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    `,

    data(){
        return {
            product_title:'',
            product_description: '',
            price:'',
            error: '',
            message:''
        }
    },
    created: function (){
        console.log("inside add products");
    },
    methods: {
        createProduct: function (){
            let data = {
                product_title: this.product_title,
                product_description: this.product_description,
                price: this.price
            }

            console.log(data);
            axios.post('http://wp.test/wp-json/crudAPI/v1/products', data)
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
}