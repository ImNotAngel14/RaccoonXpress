<?php
function printProduct($product_id, $product_name, $price, $base64Image, $rating)
{
    echo "
    <div class='col d-inline-flex justify-content-center'>
        <div class='card' style='width: 18rem;'>
            <a href='product.php?product=". $product_id ."' style='color: black; text-decoration: none;'>
                <img src='data:image/png;base64," . $base64Image ."' class='card-img-top' alt='' style='height: 18rem; object-fit: contain;'>
                <div class='card-body'>
                    <p class='card-text'>". $product_name ."</p>
                    <h5 class='card-title'>$". $price ."</h5>
                    <div class='rate-container' style='color: #8eb35a'>
                        ";
                        for($i = 0; $i < 5; $i++)
                        {
                            if($i < $rating)
                            {
                                echo "<i class='fa-solid fa-star'></i>";
                            }
                            else
                            {
                                echo "<i class='fa-regular fa-star'></i>";
                            }
                        }
                        echo "
                    </div>
                    <br>
                </div>
            </a>
        </div>
    </div>
    ";
    return;          
}
?>