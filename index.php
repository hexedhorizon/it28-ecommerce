<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tusok Atbp.</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <style>
      
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top ">
    <a class="navbar-brand text-light" href="#">
        <img src="https://img.freepik.com/premium-vector/fish-balls-skewer-street-asian-food-vector-illustration_622487-1035.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
        Tusok Atbp.
    </a>
  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          
            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                </form>
            </li>
            <li class="nav-item">
                <button class="btn btn-light ml-3" data-toggle="modal" data-target="#cartModal">
                    <i class="fas fa-shopping-cart"></i> Cart (<span id="cartItemCount">0</span>)
                </button>
            </li>
        </ul>
    </div>
</nav>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            
                <?php
                // Include config file
                require_once "./admin/db/config.php";
                
                // Attempt select query execution
                $sql = "SELECT * FROM products";
                if ($result = $pdo->query($sql)) {
                    $totalRows = $result->rowCount();
                
                    if ($result->rowCount() > 0) {
                        // Define the card template
                        $cardTemplate = '
                            <div class="col-md-4">
                                <div class="card mb-4" style="width: 18rem;">
                                    <img class="card-img-top" src="{{img}}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{title}}</h5>
                                        <p class="card-text">{{description}}</p>
                                        <p class="card-text">Price: ₱{{price}}</p>
                                        <p class="card-text">RRP: ₱{{rrp}}</p>
                                        <p class="card-text">Available: {{quantity}}</p>
                                        <p class="card-text">Date Added: {{date_added}}</p>
                                        <a href="#" class="btn btn-primary" onclick="viewProduct({{id}})">View Details</a>
                                        <a href="#" class="btn btn-success" onclick="addToCart({{id}})">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        ';
                
                        // Start the container for the cards
                        echo '<div class="container mt-5">';
                        echo '<div class="row">';
                
                        // Populate the cards using the card template
                        while ($row = $result->fetch()) {
                            $cardHtml = str_replace(
                                array('{{id}}', '{{title}}', '{{description}}', '{{price}}', '{{rrp}}', '{{quantity}}', '{{img}}', '{{date_added}}'),
                                array($row['id'], $row['title'], $row['description'], $row['price'], $row['rrp'], $row['quantity'], $row['img'], $row['date_added']),
                                $cardTemplate
                            );
                            echo $cardHtml;
                        }
                
                        // End the container for the cards
                        echo '</div>';
                        echo '</div>';
                
                        // Free result set
                        unset($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                
                // Close connection
                unset($pdo);
                ?>
            </div>
        </div>        
    </div>
</div>
</body>
</html>
