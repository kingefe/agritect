<?php /* Template Name: Modular Content */ ?>

<?php while (have_posts()) : the_post(); ?>
  <article class="modular">
    <?php get_template_part('templates/content', 'modular'); ?>
  </article>
<?php endwhile; ?>
