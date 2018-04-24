<h3>
  je suis le contenuto <?php the_ID(); ?>
</h3>

<?php
  $point = get_field('point'); 
  dbg($point)
?>
<div class="marker" data-lat="<?php echo $point['lat']; ?>" data-lng="<?php echo $point['lng']; ?>">
  <h4><?php the_title() ?></h4>
  <p class="address"><?php echo $point['address']; ?></p>
  <p><?php the_content(); ?></p>
  <a href="<?php echo get_post_permalink(get_the_ID()); ?>">Visualizza Cinemagraph</a>
</div>