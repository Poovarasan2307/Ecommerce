<?php
include('config.php'); // Ensure the database connection is correct

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? AND status = 'active'");
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $numRows = $result->num_rows;
    $colClass = 'col-md-4'; // Default class (for 3 results)

    if ($numRows == 2) {
        $colClass = 'col-md-3'; // Class for 2 results
    } elseif ($numRows == 1) {
        $colClass = 'col-md-3'; // Class for 1 result
    }

    if ($numRows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="'.$colClass.'">';
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
    } else {
        echo '<div class="col-12">';
        echo '<p>No results found for "'.$query.'".</p>';
        echo '</div>';
    }
}
?>
