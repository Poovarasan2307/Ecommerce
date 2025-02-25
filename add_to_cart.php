<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>
  <link rel="shortcut icon" href="./v.png" type="image/svg+xml">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nav.css">
     <!-- Responsive CSS -->
     <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
       <!-- Site Icons -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/nav.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
 
     <!-- Responsive CSS -->
     <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
<section class="navigation"> <div class="nav-container"> <div class="brand">  </div> <nav> <div class="nav-mobile"><a id="navbar-toggle" ><span></span></a></div> <ul class="nav-list"> <li> <a href="index.php">Home</a> </li> <li> <a href="registration.html">Register</a> </li> <li id="login"> <a href="login.html">Login</a> </li> <li id="logout">
<a href="logout.php">Logout</a> </li> </ul> </nav> </div> </section>
  
  <div class="container mt-5">
    <h2>My Cart</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="cart-items">
        <!-- Cart items will be dynamically inserted here -->
      </tbody>
    </table>
    <div class="text-right">
      <h3>Total Price: $<span id="total-price">0.00</span></h3>
      <button class="btn btn-primary" onclick="buyNow()">Buy Now</button>
    </div>
  </div>

  <script>
  // Retrieve cart items from local storage
  const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

  function updateCart() {
    let totalPrice = 0;
    $('#cart-items').empty();
    cartItems.forEach(item => {
      const itemTotal = item.price * item.quantity;
      totalPrice += itemTotal;
      $('#cart-items').append(`
        <tr>
          <td>${item.name}</td>
          <td>$${item.price.toFixed(2)}</td>
          <td>
            <input type="number" class="form-control" value="${item.quantity}" min="1" onchange="updateQuantity(${item.id}, this.value)">
          </td>
          <td>$${itemTotal.toFixed(2)}</td>
          <td><button class="btn btn-danger" onclick="removeItem(${item.id})">Remove</button></td>
        </tr>
      `);
    });
    $('#total-price').text(totalPrice.toFixed(2));
  }

  function updateQuantity(id, quantity) {
    const item = cartItems.find(item => item.id === id);
    if (item) {
      item.quantity = parseInt(quantity);
      localStorage.setItem('cartItems', JSON.stringify(cartItems)); // Update local storage
      updateCart(); // Update the cart display
    }
  }

  function removeItem(id) {
    const index = cartItems.findIndex(item => item.id === id);
    if (index > -1) {
      cartItems.splice(index, 1);
    }
    localStorage.setItem('cartItems', JSON.stringify(cartItems)); // Update local storage
    updateCart();
  }

  function buyNow() {
    $.post('order.php', { cartItems: JSON.stringify(cartItems) }, function(response) {
      alert(response);
      if (response.includes('Hooray! Your order was placed successfully')) {
        localStorage.removeItem('cartItems'); // Clear the cart
        window.location.href = 'index.php'; // Redirect to home page
      }
    });
  }

  $(document).ready(function() {
    updateCart();
  });

  document.addEventListener('DOMContentLoaded', function () {
    var navbarToggle = document.getElementById('navbar-toggle');
    var navList = document.querySelector('.nav-list');

    if (navbarToggle) {
        navbarToggle.addEventListener('click', function () {
            navList.classList.toggle('active');
            navbarToggle.classList.toggle('active');
        });
    }
  });
</script>

</body>
</html>
