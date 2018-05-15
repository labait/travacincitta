<?php
  $point = get_field('point'); 
?>
<div style="display: none;" class="marker" data-title="<?php the_title() ?>" data-lat="<?php echo $point['lat']; ?>" data-lng="<?php echo $point['lng']; ?>">
  <h4>
    <a href="<?php print get_post_permalink(); ?>"><?php the_title() ?></a>
  </h4>
  <p class="address"><?php echo $point['address']; ?></p>
  <p><?php the_content(); ?></p>
  <a href="<?php echo get_post_permalink(get_the_ID()); ?>">Visualizza Cinemagraph</a>
</div>