
<div class="col-12 col-sm-6 col-lg-4 item">
    <h3><?php the_title(); ?> </h3>
    <h4><?php the_field('subtitle')?> </h4>
    <div class="content">
        <hr/>
        <div class="date"><?php the_field('date-time'); ?></div>      
        <div class="place"><?php the_field('place'); ?></div>
        <?php the_content(); ?>
    </div>
</div>