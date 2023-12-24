require('./bootstrap');

import { createApp } from 'vue';
import AddSale from './components/AddSale.vue';
import SalesTable from './components/SalesTable.vue';

let app=createApp({})
app.component('add-sale-form' , AddSale);
app.component('sales-table' , SalesTable);

app.mount("#app")