<?php
function component($productname,$productprice,$productimg){
    $element='
    <div class="box">
    <img src="'.$productimg.'">
    <h3>'.$productname.'</h3>
    <div class="stars">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star-half-alt"></i>    
    </div>
    <span>RM '.$productprice.'</span>
    <br>
    <a href="#" class="btn">Add to cart</a>
</div>
    ';
    echo $element;
}



?>