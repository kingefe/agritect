<?php while (have_posts()) : the_post(); ?>
  <article class="questionnaire">
    <?php get_template_part('templates/content', 'project-vision'); ?>
  </article>
<?php endwhile; ?>
