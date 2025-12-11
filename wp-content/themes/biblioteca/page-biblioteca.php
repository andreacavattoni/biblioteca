<?php
/*
Template Name: Pagina Biblioteca
*/

get_header();

$hero             = function_exists( 'get_field' ) ? get_field( 'biblioteca_hero' ) : array();
$hero_title       = isset( $hero['title'] ) && $hero['title'] ? $hero['title'] : get_the_title();
$hero_text        = isset( $hero['text'] ) ? $hero['text'] : ( has_excerpt() ? get_the_excerpt() : '' );
$hero_image_field = isset( $hero['image'] ) ? $hero['image'] : null;
$hero_image_src   = '';
$hero_image_alt   = '';

if ( $hero_image_field ) {
    $hero_image_src = isset( $hero_image_field['url'] ) ? $hero_image_field['url'] : '';
    $hero_image_alt = isset( $hero_image_field['alt'] ) ? $hero_image_field['alt'] : '';
} elseif ( has_post_thumbnail() ) {
    $hero_image_src = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    $hero_image_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
}

$services_section = function_exists( 'get_field' ) ? get_field( 'servizi_section' ) : array();
$services_title   = isset( $services_section['title'] ) ? $services_section['title'] : '';
$services_list    = isset( $services_section['servizi'] ) ? $services_section['servizi'] : array();

$spaces_section = function_exists( 'get_field' ) ? get_field( 'spazi_section' ) : array();
$spaces_title   = isset( $spaces_section['title'] ) ? $spaces_section['title'] : '';
$spaces_list    = isset( $spaces_section['spazi'] ) ? $spaces_section['spazi'] : array();

$home_id          = get_option( 'page_on_front' );
$books_section    = ( $home_id && function_exists( 'get_field' ) ) ? get_field( 'libri_section', $home_id ) : array();
$books_title      = isset( $books_section['title'] ) ? $books_section['title'] : '';
$books_text       = isset( $books_section['text'] ) ? $books_section['text'] : '';
$projects_section = ( $home_id && function_exists( 'get_field' ) ) ? get_field( 'progetti_section', $home_id ) : array();
$projects_title   = isset( $projects_section['title'] ) ? $projects_section['title'] : '';
$projects_list    = isset( $projects_section['progetti'] ) ? $projects_section['progetti'] : array();
?>

<main id="primary" class="site-main">
    <section class="page-header py-5 bg-light">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-md-7">
                    <p class="section-eyebrow mb-2">Biblioteca</p>
                    <h1 class="display-5 mb-3"><?php echo esc_html( $hero_title ); ?></h1>
                    <?php if ( $hero_text ) : ?>
                        <div class="lead text-muted mb-0"><?php echo wp_kses_post( wpautop( $hero_text ) ); ?></div>
                    <?php endif; ?>
                </div>
                <?php if ( $hero_image_src ) : ?>
                    <div class="col-md-5 text-md-end">
                        <img class="img-fluid rounded shadow" src="<?php echo esc_url( $hero_image_src ); ?>" alt="<?php echo esc_attr( $hero_image_alt ); ?>" />
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="page-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php if ( $services_title || ! empty( $services_list ) ) : ?>
        <section class="services-section py-5 bg-light">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12 col-lg-8">
                        <p class="section-eyebrow mb-1">I nostri servizi</p>
                        <?php if ( $services_title ) : ?>
                            <h2 class="h1 mb-3"><?php echo esc_html( $services_title ); ?></h2>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ( ! empty( $services_list ) ) : ?>
                    <div class="row g-4">
                        <?php foreach ( $services_list as $service ) :
                            $service_title = isset( $service['title'] ) ? $service['title'] : '';
                            $service_text  = isset( $service['text'] ) ? $service['text'] : '';
                            ?>
                            <div class="col-md-6 col-lg-4">
                                <article class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <?php if ( $service_title ) : ?>
                                            <h3 class="h5 fw-semibold mb-2"><?php echo esc_html( $service_title ); ?></h3>
                                        <?php endif; ?>
                                        <?php if ( $service_text ) : ?>
                                            <p class="mb-0 text-muted"><?php echo wp_kses_post( $service_text ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="alert alert-info mb-0" role="status">
                        <?php esc_html_e( 'Aggiungi servizi nel repeater ACF per popolare questa sezione.', 'biblioteca' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( $spaces_title || ! empty( $spaces_list ) ) : ?>
        <section class="spaces-section py-5">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12 col-lg-8">
                        <p class="section-eyebrow mb-1">Spazi</p>
                        <?php if ( $spaces_title ) : ?>
                            <h2 class="h1 mb-3"><?php echo esc_html( $spaces_title ); ?></h2>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ( ! empty( $spaces_list ) ) : ?>
                    <div class="row g-4">
                        <?php foreach ( $spaces_list as $space ) :
                            $space_icon  = isset( $space['icon'] ) ? $space['icon'] : null;
                            $space_title = isset( $space['title'] ) ? $space['title'] : '';
                            $space_text  = isset( $space['text'] ) ? $space['text'] : '';
                            ?>
                            <div class="col-md-6 col-lg-4">
                                <article class="card h-100 shadow-sm border-0">
                                    <div class="card-body d-flex gap-3">
                                        <?php if ( $space_icon ) : ?>
                                            <div class="flex-shrink-0">
                                                <img class="rounded" src="<?php echo esc_url( $space_icon['url'] ); ?>" alt="<?php echo esc_attr( $space_icon['alt'] ); ?>" width="56" height="56" />
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <?php if ( $space_title ) : ?>
                                                <h3 class="h5 fw-semibold mb-2"><?php echo esc_html( $space_title ); ?></h3>
                                            <?php endif; ?>
                                            <?php if ( $space_text ) : ?>
                                                <p class="mb-0 text-muted"><?php echo wp_kses_post( $space_text ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="alert alert-info mb-0" role="status">
                        <?php esc_html_e( 'Aggiungi gli spazi con icona, titolo e testo per visualizzare questa sezione.', 'biblioteca' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <section class="books-section py-5 bg-light">
        <div class="container">
            <div class="row align-items-end mb-4">
                <div class="col-12 col-lg-8">
                    <p class="section-eyebrow mb-1">Libri</p>
                    <?php if ( $books_title ) : ?>
                        <h2 class="section-title h1 mb-3"><?php echo esc_html( $books_title ); ?></h2>
                    <?php endif; ?>
                    <?php if ( $books_text ) : ?>
                        <div class="section-text text-muted"><?php echo wp_kses_post( wpautop( $books_text ) ); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row g-4">
                <?php
                $book_query = null;
                if ( post_type_exists( 'libro' ) ) {
                    $book_query = new WP_Query(
                        array(
                            'post_type'      => 'libro',
                            'posts_per_page' => 6,
                        )
                    );
                }

                if ( $book_query && $book_query->have_posts() ) :
                    while ( $book_query->have_posts() ) :
                        $book_query->the_post();
                        ?>
                        <div class="col-12 col-md-6 col-xl-4">
                            <article class="book-card h-100 p-4 rounded shadow-sm bg-white">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="book-cover ratio ratio-3x4 mb-3">
                                        <?php the_post_thumbnail( 'medium_large', array( 'class' => 'rounded object-fit-cover' ) ); ?>
                                    </div>
                                <?php endif; ?>
                                <h3 class="h5 fw-semibold mb-2"><a href="<?php the_permalink(); ?>" class="stretched-link text-decoration-none text-dark"><?php the_title(); ?></a></h3>
                                <p class="text-muted mb-0"><?php echo wp_trim_words( get_the_excerpt(), 20, '…' ); ?></p>
                            </article>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div class="col-12">
                        <div class="alert alert-info mb-0" role="status">
                            <?php esc_html_e( 'Aggiungi i libri dal custom post type "libro" per popolare questa sezione.', 'biblioteca' ); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="projects-section py-5 py-lg-6">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
                <div>
                    <p class="section-eyebrow mb-1">Progetti permanenti</p>
                    <?php if ( $projects_title ) : ?>
                        <h2 class="section-title h1 mb-0"><?php echo esc_html( $projects_title ); ?></h2>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ( ! empty( $projects_list ) ) : ?>
                <div class="row g-4">
                    <?php foreach ( $projects_list as $project ) :
                        $project_image = isset( $project['image'] ) ? $project['image'] : null;
                        $project_title = isset( $project['title'] ) ? $project['title'] : '';
                        $project_text  = isset( $project['text'] ) ? $project['text'] : '';
                        $project_link  = isset( $project['link'] ) ? $project['link'] : '';
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <article class="project-card card border-0 shadow-sm h-100">
                                <?php if ( $project_image ) : ?>
                                    <div class="ratio ratio-16x9 project-media">
                                        <img class="object-fit-cover rounded-top" src="<?php echo esc_url( $project_image['url'] ); ?>" alt="<?php echo esc_attr( $project_title ); ?>" />
                                    </div>
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <?php if ( $project_title ) : ?>
                                        <h3 class="h5 fw-semibold mb-2"><?php echo esc_html( $project_title ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( $project_text ) : ?>
                                        <p class="text-muted mb-4 flex-grow-1"><?php echo wp_kses_post( $project_text ); ?></p>
                                    <?php endif; ?>
                                    <?php if ( $project_link ) : ?>
                                        <a class="btn btn-link p-0 fw-semibold mt-auto" href="<?php echo esc_url( $project_link ); ?>" target="_blank" rel="noopener">
                                            <?php esc_html_e( 'Scopri il progetto', 'biblioteca' ); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="alert alert-info mb-0" role="status">
                    <?php esc_html_e( 'Aggiungi i progetti permanenti dal repeater ACF nella home page.', 'biblioteca' ); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
