<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .product-image {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 5px;
            box-sizing: border-box;
        }

        input[type="text"]:read-only {
            background-color: #f8f9fa;
            border: none;
        }

        input[type="number"] {
            width: 50px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Product Page</h1>
        <img src="http://www.listercarterhomes.com/wp-content/uploads/2013/11/dummy-image-square.jpg" alt="Product Image" height="100px" class="product-image">
        <form id="order-form" method="post">
            <div class="form-group">
                <label for="price">Price: £5</label>
                <input type="hidden" id="price" name="price" value="£5.00" readonly>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1">
            </div>
            <div class="form-group">
                <label for="total">Total: <span id="total2">£5.00</span></label>
                <input type="hidden" id="total" name="total_order" value="5" readonly>
            </div>
            <button type="submit">Place Order</button>
        </form>
    </div>

    <script>
        document.getElementById('order-form').addEventListener('input', function() {
            var price = parseFloat(document.getElementById('price').value.replace('£', ''));
            var quantity = parseInt(document.getElementById('quantity').value);
            var total = price * quantity;
            document.getElementById('total').value = total.toFixed(2);
            document.getElementById('total2').innerHTML = '£' + total.toFixed(2);
        });
    </script>
</body>

</html>