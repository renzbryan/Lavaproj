<div class="page-wrapper" id="app" v-cloak>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">Make an order</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <?php if (isset($success_message)) { ?>
						<div class="alert alert-success"><?php echo $success_message; ?></div>
					<?php } ?>
					<?php if (isset($error_message)) { ?>
						<div class="alert alert-danger"><?php echo $error_message; ?></div>
					<?php } ?>
                <form action="<?php echo site_url('/user-add-order')?>" method="post">
                    <div class="row formtype">
                        <div class="col-md-4" v-for="product in products" :key="product.product_id">
                            <div class="form-group">
                                <label>
                                    <img src="/public/assets/img/product/product-01.jpg" alt="product" style="height: 200px;">
                                    <input type="checkbox" :name="'product[]'" :value="product.product_id" v-model="selectedProducts">
                                    <div class="product-info">
                                        <p>{{ product.name }}</p>
                                        <p>Price: ${{ product.price }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input class="form-control" name="quantity"type="number" id="sel2" v-model="quantity[product.product_id]">
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" id="sel2" name="address">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" id="usr1" name="phone">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="total">Total:</label>
                            <span>{{ calculateTotal() }}</span>
                            <input type="hidden" name="total" v-model="total">
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" rows="5" id="comment" name="message"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary buttonedit ml-2">Add an Order</button>
                    <button type="button" class="btn btn-primary buttonedit">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
<script>
    const app = Vue.createApp({
        data() {
            return {
                selectedProducts: [],
                quantity: {}, // Use an object to store quantities for each product
                total: 0,
                products: <?= json_encode($data)?>,
            };
        },

        watch: {
            selectedProducts() {
                // Update the total when the selected products change
                this.updateTotal();
            },
        },

        methods: {
            updateTotal() {
                this.total = this.calculateTotal();
            },

            calculateTotal() {
                let total = 0;
                for (const productId of this.selectedProducts) {
                    const product = this.products.find(p => p.product_id === productId);
                    if (product) {
                        const productQuantity = this.quantity[productId] || 0;
                        total += product.price * productQuantity;
                    }
                }
                return total;
            },

            check() {
                this.updateTotal();
                console.log('Selected Products:', this.selectedProducts);
				console.log(this.quantity);
                console.log('Total:', this.total);
            },
        },
    });

    app.mount('#app');
</script>


<style>
    .form-group label {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .form-group img {
        height: 200px;
        margin-bottom: 10px; /* Adjust the margin as needed */
    }

    .form-group input[type="checkbox"] {
        margin-top: 5px; /* Adjust the margin as needed */
    }
</style>