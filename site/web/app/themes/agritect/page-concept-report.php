<style>
  body {
    padding-top: 62px !important;
    padding-bottom: 60px !important;
  }
</style>

<?php while (have_posts()) : the_post(); ?>
  <article>
    <?php get_template_part('templates/content', 'concept-report'); ?>
  </article>
<?php endwhile; ?>
