<?php /* Template Name: Dashboard Static Page Template */ ?>

<style>
  .navbar--main, .site-footer {
    display: none;
  }
</style>

<?php while (have_posts()) : the_post(); ?>
  <div class="dashboard">
    <div class="container-fluid">
      <div class="row row--nowrap">
        <div class="dashboard__sidebar">
          <?php get_template_part('templates/sidebar-dashboard'); ?>
        </div>

        <!-- Projects Index -->
        <div class="dashboard__pane">
          <div class="section">
            <?php get_template_part('templates/content', 'page'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; ?>