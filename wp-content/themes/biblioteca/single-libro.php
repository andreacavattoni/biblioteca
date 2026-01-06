<?php
$progetti     = get_field( 'progetti_section',2);
$progetti_tit = isset( $progetti['title'] ) ? $progetti['title'] : '';
$progetti_rep = isset( $progetti['progetti'] ) ? $progetti['progetti'] : array();
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="header page-header sect">
      <div class="container">
        <div class="page-title big-title line"><h1><?php the_title(); ?></h1></div>
          <div class="row">
            <div class="col-md-6">
              <?php
              $sub = get_field('libro_subtitle');
              if($sub && $sub != ''):?>
                <div class="subtitle"><?php print $sub; ?></div>
              <?php endif; ?>
              <div class="mini-text"><?php the_content(); ?></div>
              <?php
              $libro_opuscolo = get_field('libro_opuscolo');
              if($libro_opuscolo):?>
                <a class="btn opuscolo-btn" href="<?php print $libro_opuscolo['url']; ?>" target="_blank">Scarica l'opuscolo</a>
              <?php endif; ?>
            </div>
            <div class="col-md-6">
              <div class="page-cover">
                <?php $cover = get_field('libro_cover'); ?>
                <img src="<?php echo esc_url( $cover['sizes']['libro-full'] ); ?>" alt="<?php echo esc_attr( $cover['title'] ); ?>">
              </div>
            </div>
          </div>
        </div>
    </header>
    <?php
      $terms = get_the_terms(get_the_ID(), 'genere');
      if(!is_wp_error($terms) && !empty($terms)){
        $term = array_shift($terms);
        $url = get_term_link($term);
        ?>
        <div class="container">
          <div class="libro-cta">
            <a href="<?php echo esc_url($url); ?>">
              <span><i></i></span>Vai a <?php echo esc_html($term->name); ?>
            </a>
          </div>
        </div>
        <?php
      }
      ?>
  </article>
  <div class="sect home-progetti">
    <div class="container">
      <?php if ( $progetti_tit ) : ?>
      <div class="big-title line"><?php echo esc_html( $progetti_tit ); ?></div>
      <?php endif; ?>
      <div class="progetti-grid">
        <?php foreach ( $progetti_rep as $progetto ) :
          $p_image = isset( $progetto['image'] ) ? $progetto['image'] : null;
          $p_title = isset( $progetto['title'] ) ? $progetto['title'] : '';
          $p_text  = isset( $progetto['text'] ) ? $progetto['text'] : '';
          $p_link  = isset( $progetto['link'] ) ? $progetto['link'] : '';
        ?>
        <div class="proj-single">
          <div class="proj-card row">
            <div class="col-md-6">
              <div class="proj-pic">
                <?php if ( $p_image ) : ?><img src="<?php echo esc_url( $p_image['sizes']['progetto'] ); ?>" alt="<?php echo esc_attr( $p_title ); ?>"><?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="proj-body">
                <div class="proj-title big-title"><?php echo esc_html( $p_title ); ?></div>
                <div class="proj-text mini-text"><?php echo wp_kses_post( $p_text ); ?></div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
