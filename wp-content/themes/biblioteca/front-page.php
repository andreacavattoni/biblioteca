<?php
/**
 * Template for the front page
 */
get_header();

$hero_title    = get_field( 'hero_title' ) ?: get_the_title();
$hero_cover    = get_field( 'hero_cover' );
$library       = get_field( 'biblioteca_section' );
$books         = get_field( 'libri_section' );
$projects      = get_field( 'progetti_section' );
$library_title = isset( $library['title'] ) ? $library['title'] : '';
$library_text  = isset( $library['text'] ) ? $library['text'] : '';
$library_page  = isset( $library['page'] ) ? $library['page'] : null;
$library_cta   = isset( $library['cta_title'] ) ? $library['cta_title'] : '';
$books_title   = isset( $books['title'] ) ? $books['title'] : '';
$books_text    = isset( $books['text'] ) ? $books['text'] : '';
$projects_title = isset( $projects['title'] ) ? $projects['title'] : '';
$projects_list  = isset( $projects['progetti'] ) ? $projects['progetti'] : array();
?>

<main id="content" class="home-template">
    <section class="hero-section text-white" <?php if ( $hero_cover ) : ?>style="background-image: url('<?php echo esc_url( $hero_cover['url'] ); ?>');"<?php endif; ?>>
        <div class="overlay"></div>
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xxl-8 text-center">
                    <p class="eyebrow mb-2">Biblioteche Giudicarie esteriori</p>
                    <h1 class="display-4 fw-semibold"><?php echo esc_html( $hero_title ); ?></h1>
                    <?php if ( $hero_cover ) : ?>
                        <div class="hero-media mt-4">
                            <img class="img-fluid rounded shadow" src="<?php echo esc_url( $hero_cover['url'] ); ?>" alt="<?php echo esc_attr( $hero_title ); ?>" />
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="library-section py-5 py-lg-6">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-12 col-lg-6">
                    <?php if ( $library_title ) : ?>
                        <p class="section-eyebrow mb-1">Biblioteca</p>
                        <h2 class="section-title h1 mb-3"><?php echo esc_html( $library_title ); ?></h2>
                    <?php endif; ?>
                    <?php if ( $library_text ) : ?>
                        <div class="section-text lead"><?php echo wp_kses_post( wpautop( $library_text ) ); ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="cta-card p-4 p-lg-5 h-100">
                        <div class="d-flex flex-column gap-3">
                            <div>
                                <p class="fw-semibold text-uppercase small text-primary mb-2"><?php echo esc_html__( 'Scopri di più', 'biblioteca' ); ?></p>
                                <p class="mb-0 text-muted"><?php esc_html_e( 'Approfondisci i servizi, gli orari e le opportunità offerte dalla biblioteca.', 'biblioteca' ); ?></p>
                            </div>
                            <?php if ( $library_page ) : ?>
                                <a class="btn btn-primary" href="<?php echo esc_url( get_permalink( $library_page ) ); ?>">
                                    <?php echo $library_cta ? esc_html( $library_cta ) : esc_html__( 'Visita la pagina', 'biblioteca' ); ?>
                                </a>
                            <?php elseif ( $library_cta ) : ?>
                                <span class="btn btn-outline-primary disabled"><?php echo esc_html( $library_cta ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="books-section py-5 bg-light">
        <div class="container">
            <div class="row align-items-end mb-4">
                <div class="col-12 col-lg-8">
                    <?php if ( $books_title ) : ?>
                        <p class="section-eyebrow mb-1">Libri</p>
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
                    <?php if ( $projects_title ) : ?>
                        <p class="section-eyebrow mb-1">Progetti</p>
                        <h2 class="section-title h1 mb-0"><?php echo esc_html( $projects_title ); ?></h2>
                    <?php endif; ?>
                </div>
                <?php if ( ! empty( $projects_list ) ) : ?>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary project-nav" data-direction="-1" type="button" aria-label="Precedente">
                            &larr;
                        </button>
                        <button class="btn btn-outline-secondary project-nav" data-direction="1" type="button" aria-label="Successivo">
                            &rarr;
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ( ! empty( $projects_list ) ) : ?>
                <div class="projects-slider">
                    <div class="projects-track d-flex align-items-stretch">
                        <?php foreach ( $projects_list as $project ) :
                            $project_image = isset( $project['image'] ) ? $project['image'] : null;
                            $project_title = isset( $project['title'] ) ? $project['title'] : '';
                            $project_text  = isset( $project['text'] ) ? $project['text'] : '';
                            $project_link  = isset( $project['link'] ) ? $project['link'] : '';
                            ?>
                            <article class="project-card card border-0 shadow-sm h-100 flex-shrink-0">
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
                                        <a class="btn btn-link p-0 fw-semibold" href="<?php echo esc_url( $project_link ); ?>" target="_blank" rel="noopener">
                                            <?php esc_html_e( 'Scopri il progetto', 'biblioteca' ); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-info mb-0" role="status">
                    <?php esc_html_e( 'Aggiungi uno o più progetti nel repeater ACF per mostrare lo slider.', 'biblioteca' ); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
