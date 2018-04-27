<?php $cinemagraph = get_field('cinemagraph'); ?>
  <?php if( $cinemagraph ): ?>
      <img class="cinemagraph" src="<?php echo $cinemagraph['url']; ?>" alt="<?php echo $cinemagraph['alt']; ?>" />
  <?php endif; ?>
</div>