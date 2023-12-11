<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Product List</title>
</head>

<body>
    
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ced4da;
    }

    th {
        background-color: gray;
        color: #fff;
    }

    tr:hover {
        background-color: #e9ecef;
    }

    a {
        text-decoration: none;
        color: #007BFF;
        transition: color 0.3s ease;
    }

    .action-buttons {
        text-align: center;
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        color: #fff;
        background-color: #343a40; 
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #0056b3; 
    }
    .add-product-button {
            text-align: center;
            margin-top: 20px;
        }
    </style>
    <div class="add-product-button">
        <a href="add_prod" class="button bg-dark">
            Add Product <i class="fas fa-plus"></i>
        </a>
    </div>       
           
<table border="1">
    <thead>
            <th>Product Name</th>
            <th>Decription</th>
            <th>Price</th>
            <th>Stocks</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php foreach($info as $for): ?>
        <tr>
            <td><?= $for['prodname']?></td> 
            <td><?= $for['description']?></td>
            <td><?= $for['price']?></td>
            <td><?= $for['stocks']?></td>       

            <td class="text-center action-buttons">
              <a href="edit/<?= $for['prod_id'] ?>" class="button bg-dark">
              <i class="fas fa-edit"></i>
              </a>
            </td>

        </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    </div>
    </div>
<div class="">



</body>
</html>