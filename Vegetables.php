<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vegetables</title>
     <!-- 
    - favicon
  -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="./v.png" type="image/svg+xml">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
       <!-- Site Icons -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
 
     <!-- Responsive CSS -->
     <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* img w and h  */
        .card-img-top {
            width: 100%;
            height: 200px; /* Set the desired height */
            object-fit: cover; /* Ensures the image covers the entire area, maintaining aspect ratio */
        }
        
    .checked {
      color: orange;
    }
      
    li a{
        color:white;
        font-family:'Times New Roman', Times, serif;
        font-weight: bold;
        font-size: 20px;
        color:black;
     }
     li a:hover{
       color: #14e464;
     }
     nav{
        background: linear-gradient(45deg, rgba(31, 255, 180, 0.281), rgb(0, 0, 0));
     }
 
    </style>
   

</head>
<body>
    <!-- Start Main Top -->
  <!-- <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="custom-select-box sr-only">
                        <select id="basic" class="selectpicker show-tick form-control" data-placeholder="K MKW">
							<option>K MKW</option>
							<option>K ZKW</option>
                            <option>£ GBP</option>
                            <option>$ USD</option>
						</select>
                    </div>
                    <div class="right-phone-box">
                        <p>Call TN :- <a href="#"> +91 890 294 5221</a></p>
                    </div>
                    <div class="our-link">
                        <ul>
                            <li><a href="#"><i class="fa fa-user s_color"></i> My Account</a></li>
                            <li><a href="#"><i class="fas fa-headset"></i> Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <ul class="offer-box">
                                <li>
                                    <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT80
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 50%! Shop Now
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT30
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 50%! Shop Now 
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Main Top -->
<nav class="navbar navbar-white  justify-content-between">
        <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
        <li class="nav-item"><a class="nav-link" href="Vegitables.php">HEALTHY VEGETABLES</a></li>
        <li class="nav-item"><a class="nav-link" href="add_to_cart.php">MY CART</a></li>
        <form class="form-inline" id="search-form"  style="display:none;">
            <input class="form-control mr-sm-2" name="query" type="search" id="live" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <button class="btn btn-outline-success" id="search-icon">
            <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
        </button>
    </nav>
    <div class="search-results"></div>
    <div class="container mt-5">
    <?php
      $query = "SELECT * FROM products WHERE status = 'vactive'";
      $result = $conn->query($query);
      if ($result->num_rows > 0) {
        echo '<div class="container">';
        echo '<div class="row">';
        while ($row = $result->fetch_assoc()) {
          echo '<div class="col-md-4">';
          echo '<div class="card mb-4">';
          echo '<img src="'.$row['image_path'].'" class="card-img-top" alt="'.$row['name'].'" style="width:100%;">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">'.$row['name'].'</h5>';
          echo '<p class="card-text">'.$row['description'].'</p>';
          echo '<p class="card-text">$'.$row['price'].'</p>';
          echo '<div class="star-rating">';
          for ($i = 1; $i <= 5; $i++) {
            if ($i <= round($row['rating'])) {
              echo '<span class="fa fa-star checked"></span>';
            } else {
              echo '<span class="fa fa-star"></span>';
            }
          }
          echo '</div>';
          echo '<button class="btn btn-primary" onclick="addToCart('.$row['id'].', \''.$row['name'].'\', '.$row['price'].')">Add to Cart</button>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
        echo '</div>';
        echo '</div>';
      } else {
        echo "No active products found.";
      }
    ?>
  </div>
  <div class="footer-copyright">
    <hr>

<p class="footer-company">All Rights Reserved. &copy; 2025 <a href="Vegetables.php">Green Garden</a> 

</span>
</p>
</div>
    <script>
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

    function addToCart(id, name, price) {
      alert(`Added to cart: ${name}`);
      const existingItem = cartItems.find(item => item.id === id);
      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        cartItems.push({ id, name, price, quantity: 1 });
      }
      localStorage.setItem('cartItems', JSON.stringify(cartItems)); // Save cart items to local storage
    }
    $(document).ready(function() {
    // Toggle search form
    $("#search-icon").click(function() {
        $("#search-form").toggle();
    });

    // Handle form submission
    $("#search-form").submit(function(event) {
        event.preventDefault();
        var query = $("input[name='query']").val();

        $.ajax({
            url: "vsearch.php",
            method: "GET",
            data: { query: query },
            success: function(data) {
                // Directly insert the returned HTML into the existing structure
                $(".search-results").html(data);
            },
            error: function() {
                $(".search-results").html('<p>An error occurred while processing your request.</p>');
            }
        });
    });

    // Add class 'clicked' to clicked navbar link
    var links = document.querySelectorAll('.navbar-brand');
    links.forEach(function(link) {
        link.addEventListener('click', function() {
            links.forEach(function(link) {
                link.classList.remove('clicked');
            });
            this.classList.add('clicked');
        });
    });
});

  </script>
     
</body>
</html>
