<?php 
$image = $_POST['image'];
echo '<div class="ajax-text-and-image lightbox-block">
  <div class="ajax-col">
    <img class="img-fluid" src="'.$image.'"
      alt="..." />
  </div>
  <div class="ajax-col">
    <div class="p-20">
      <h1>This is just block of HTML, loaded via ajax</h1>
      <p>You can put absolutely any HTML here and resize it dynamically just with
        help of CSS.</p>
    </div>
  </div>
  <div class="clearfix"></div>
</div>';









?>