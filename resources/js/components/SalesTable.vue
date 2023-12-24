<template>
    <table class="w-100">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Cost</th>
                <th>Selling Price</th>
                <th><em>Delete Sale?</em></th>
            </tr>
        </thead>
        <tbody v-if="sales_data.length > 0">
            <tr v-for="sale in sales_data">
                <td>{{ sale.product_name }}</td>
                <td>{{ sale.sale_quantity }}</td>
                <td>&pound{{ sale.sale_unit_cost.toFixed(2) }}</td>
                <td>&pound{{ sale.sale_selling_price.toFixed(2) }}</td>
                <td><a :href="'/sales/delete/' + sale.id">Delete sale</a></td>
            </tr>
        </tbody>
        <tbody v-else>
            <tr>
                <td colspan="5" class="pt-3">
                    <p><em>No sales records present. Add one using the form above.</em></p>
                </td>
            </tr>
        </tbody>
</table>
</template>

<script>
import Vue from 'vue';

export default {
    name: 'SalesTable', 
    props: [ 'sales_data' ], 
}
</script>