<?php while (have_posts()) : the_post(); ?>  
  <article>
    <div class="section">
      <div class="container">
        <!-- <?php get_template_part('templates/page', 'header'); ?> -->
        <?php get_template_part('templates/content', 'page'); ?>
      </div>
    </div>
  </article>
<?php endwhile; ?>
