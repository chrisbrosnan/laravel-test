<form method="GET" action="{{ route('coffee.sales') }}">
    <select name="product_id" style="width: 30%;">
        <option value="1">Arabic Coffee</option>
        <option value="2">Gold Coffee</option>
    </select>
    <input type="number" name="quantity" placeholder="1" />
    <input type="number" name="unit_cost" />
    <input type="submit" name="submit" value="Record Sale" style="border: 1px solid #000; padding: .5em;" /><br/><br/>
</form>