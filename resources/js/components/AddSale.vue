<template>
    <form method="GET" action="/sales/add">
        <div class="row">
            <div class="col-3">
                <p>Product</p>
                <select name="product_id" class="w-100" @change="get_productId($event)">
                    <option v-for="product in product_data" v-bind:value="product.product_id">{{ product.product_name }}</option>
                </select>
            </div>
            <div class="col-2">
                <p>Quantity</p>
                <input type="number" name="quantity" placeholder="1" class="w-100" v-on:keyup="getSellingPrice_fromQuantity" v-model="input_quantity" min="1" required="required" />
            </div>
            <div class="col-2">
                <p>Unit Cost</p>
                <input type="number" name="unit_cost" class="w-100" v-on:keyup="getSellingPrice_fromUnitCost" v-model="input_unit_price" min="1" required="required" />
            </div>
            <div class="col-2">
                <p>Selling Price</p>
                <p>£<span id="selling_price">{{ selling_price }}</span></p>
                <input type="hidden" name="selling_price" class="w-100" v-bind:value="selling_price" />
            </div>
            <div class="col-3">
                <p>&nbsp;</p>
                <input type="submit" name="submit" value="Record Sale" class="border border-secondary p-2 w-100" /><br/><br/>
            </div>
        </div>
    </form>
</template>

<script>
import Vue from 'vue';
import axios from "axios";

export default {
    name: 'AddSale', 
    props: [ 'product_data' ], 
    data() {
        return {
            product_id: 0, 
            selling_price: 0, 
            quantity: 0, 
            profit_margin: 0, 
            shipping_cost: 10, 
            unit_cost: 0
        }
    }, 
    methods: {
        getSellingPrice_fromQuantity: function(event){
            var quantity  = event.target.value;
            this.quantity = quantity; 

            var gross_cost = parseFloat(parseInt(quantity) * parseFloat(this.unit_cost)); 

            if( gross_cost > 0 ){
                var shipping_cost = this.shipping_cost; 
                var selling_price = ( gross_cost / ( 1 - this.profit_margin ) ) + shipping_cost; 
            } else {
                var shipping_cost = 0; 
                var selling_price = 0;
            }

            this.selling_price = selling_price.toFixed(2); 
        }, 
        getSellingPrice_fromUnitCost: function(event){
            var unit_cost  = event.target.value;
            this.unit_cost = parseFloat(unit_cost).toFixed(2); 

            var gross_cost = parseFloat(this.quantity * parseFloat(unit_cost));

            if( gross_cost > 0 ){
                var shipping_cost = this.shipping_cost; 
                var selling_price = ( gross_cost / ( 1 - this.profit_margin ) ) + shipping_cost; 
            } else {
                var shipping_cost = 0; 
                var selling_price = 0;
            }

            this.selling_price = selling_price.toFixed(2); 
        }, 
        get_productId: function(event){
            var product_id  = event.target.value; 
            this.product_id = parseFloat(product_id); 
            alert( this.product_id );
            this.get_profit_margin(this.product_id); 
        }, 
        get_profit_margin: function(product_id){
            axios.get('/products/' + product_id).then(({ data }) => {
                var profit_margin  = data.profit_margin;
                this.profit_margin = profit_margin; 
            })
            .catch((err) => console.error(err));
        }
    }, 
}
</script>