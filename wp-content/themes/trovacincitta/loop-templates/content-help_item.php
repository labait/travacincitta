<?php $image = get_field('icon'); ?>
<div class="item">
    <h2><?php the_title(); ?></h2>
    <?php if( $image ): ?>
      <div>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
      </div>
    <?php endif; ?>
    <?php the_content(); ?>
</div>