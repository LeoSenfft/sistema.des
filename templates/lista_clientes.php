<?php $url = plugins_url('includes/css/style.css', dirname(__FILE__)); ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<link rel="stylesheet" href="<?= $url; ?>">

<?php
if (current_user_can('administrator')) {

    $args = array( 'post_type' => 'cliente', 'order' => 'ASC', 'orderby' => 'title', 'nopaging' => 'true' );
    $loop = new WP_Query( $args );
    if( $loop->have_posts() ) {
        $count = 0;
        ?>
        <h2 class="titulo-clientes">Meus clientes</h2>
        <div class="btn-group btn-group-cliente" role="group">
            <button type="button" class="btn-sm btn btn-success" href="adicionar-cliente">
                <i class="material-icons">add</i>
            </button>
            <button type="button" class="btn-sm btn btn-danger " href="adicionar-cliente">
                <i class="material-icons">delete</i>
            </button>
        </div>
        <div class="clearfix"></div>
        <div id="accordion" role="tablist" class="list-group">
            <?php
            while ( $loop->have_posts() ) {
                $count ++;
                $loop->the_post();

                $id = get_the_ID();
                $nome = get_post_meta($id, 'nome_id', true);
                ?>
                <div id="<?= $count ?>" role="tab" class="list-group-item list-group-item-action">
                    <a href="#<?= $id ?>" data-toggle="collapse" aria-expanded="true" aria-controls="<?= $id ?>">
                        #<?= $id ?> <?php the_title(); ?>
                    </a>
                    <div id="<?= $id ?>" class="collapse" role="tabpanel" aria-labelledby="<?= $count ?>" data-parent="#accordion">
                        <?php include('meta-dados-clientes.php'); ?>
                    </div>
                </div>
                <?php
                /*if (current_user_can('edit_post', $post->ID)) {
                ?>
                    <div class="list-group-item list-group-item-action">
                        <div class="btn-group btn-custom" role="group" aria-label="...">
                            <button class="btn btn-warning" href="#">
                                <i class="material-icons">mode_edit</i>
                            </button>
                            <button class="btn btn-danger" href="<?php echo wp_nonce_url("$url/wordpress/wp-admin/post.php?action=trash&post=$id", 'delete-post_' . $post->ID); ?>">
                                <i class="material-icons">delete</i>
                            </button>
                        </div>
                    </div>
                <?php
                } */?>
            <?php
            }
            ?>
        </div>
        <div class="alert alert-info count-clientes" role="alert">
            <?php echo $count . ' clientes listados'; ?>
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-warning" role="alert">
            <strong>Oops!</strong> Nenhum cliente encontrado
        </div>
        <?php
    }
} else { ?>
    <div class="alert alert-warning" role="alert">
        Lamento, mas você não tem acesso à essa área do site.
    </div>
<?php } ?>
