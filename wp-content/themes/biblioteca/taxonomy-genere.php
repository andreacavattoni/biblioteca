<?php
get_header();

$term = get_queried_object();
$paged = max(1, get_query_var('paged'));

$books = new WP_Query(array(
  'post_type' => 'libro',
  'posts_per_page' => 24,
  'paged' => $paged,
  'orderby' => 'date',
  'order' => 'DESC',
  'tax_query' => array(
    array(
      'taxonomy' => 'genere',
      'field' => 'term_id',
      'terms' => $term->term_id
    )
  )
));
?>
<div id="primary" class="site-main">
  <header class="header page-header sect">
    <div class="container">
      <div class="page-title big-title line"><h1><?php single_term_title(); ?></h1></div>
    </div>
    <?php
    $desc = term_description($term);
    if($desc):
    ?>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="mini-text"><?php echo wp_kses_post($desc); ?></div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </header>

  <section class="sect libri-block">
    <div class="container">
      <div class="row books-grid">
        <?php if($books->have_posts()): while($books->have_posts()): $books->the_post();
          $cover = function_exists('get_field') ? get_field('libro_cover', get_the_ID()) : null;
          $cover_url = $cover && isset($cover['sizes']['libro-preview']) ? $cover['sizes']['libro-preview'] : get_the_post_thumbnail_url(get_the_ID(), 'medium');
          $subtitle = function_exists('get_field') ? (string)get_field('libro_subtitle', get_the_ID()) : '';
          $subtitle = trim(wp_strip_all_tags($subtitle));
        ?>
        <div class="col-md-3">
          <a class="book-card" href="<?php the_permalink(); ?>">
            <?php if($cover_url): ?><img src="<?php echo esc_url($cover_url); ?>" alt="<?php the_title_attribute(); ?>"><?php endif; ?>
            <div class="book-body">
              <div class="b-title">
                <?php the_title(); ?>
                <?php if($subtitle != ''): ?>
                  <div class="b-text"><?php echo esc_html($subtitle); ?></div>
                <?php endif; ?>
              </div>
            </div>
          </a>
        </div>
        <?php endwhile; wp_reset_postdata(); else: ?>
        <div class="col-12 mini-text mini light"><?php esc_html_e('Non ci sono titoli per questo genere al momento.', 'biblioteca'); ?></div>
        <?php endif; ?>
      </div>

      <?php if($books->max_num_pages > 1): ?>
      <div class="row">
        <div class="col-12 mt-4">
          <?php
          echo paginate_links(array(
            'total' => $books->max_num_pages,
            'current' => $paged
          ));
          ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </section>
</div>
<?php
get_footer();
