export default {
    template: `
    <div class="row">
        Hello
    </div>`,

    data(){
        return  {
            products: []
        }
    },

    created: function () {
        console.log("here in components");
    },
    methods: {
        getProducts: function(){
            var root = this;

            axios.get('./get-products')
            .then(function (response) {
                if(response.data.status)
                    root.products = response.data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
}