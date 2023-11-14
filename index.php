<!--index.php -->
<?php
include_once './controller/controller.php'
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Product Information</h1>
<table>
    <thead>
    <tr>
        <th>SKU</th>
        <th>Name</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product) : ?>
        <tr>
            <td><?php echo $product->getSKU(); ?></td>
            <td><?php echo $product->getName(); ?></td>
            <td><?php echo $product->getPrice(); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
