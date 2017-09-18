<?php
/**
* Plugin Name: Sistema Dulei
* Plugin URI: http://www.dulei.com.br/sistema
* Description: Plugin para cadastro de clientes e controle financeiro
* Version: 1.0
* Author: Dulei
* Author URI: http://www.dulei.com.br
*/

//cria o shortcode da lista de clientes
function lista_clientes() {
	ob_start();
    include_once 'templates/lista_clientes.php';
	return ob_get_clean();
}
add_shortcode( 'lista_clientes', 'lista_clientes' );

// adiciona imagem destacada ao post
add_theme_support('post-thumbnails');

// cria o post_type CLIENTE
function cadastrando_post_type_clientes() {

    $nomeSingular = 'Cliente';
    $nomePlural = 'Clientes';
    $descricao = 'Clientes da minha empresa';

    $labels = array(
        'name' => $nomePlural,
        'name_singular' => $nomeSingular,
        'add_new_item' => 'Adicionar novo ' . $nomeSingular,
        'edit_item' => 'Editar ' . $nomeSingular
    );

    $supports = array(
        'title',
        'editor',
        'thumbnail'
    );

    $args = array(
        'labels' => $labels,
        'description' => $descricao,
        'public' => true,
        'menu_icon' => 'dashicons-id-alt',
        'supports' => $supports
    );

    register_post_type( 'cliente', $args);
}
add_action('init', 'cadastrando_post_type_clientes');

function preenche_cliente_contato ( $post ) {
    $meta_data_cliente_contato = get_post_meta( $post->ID );
    ?> <link rel="stylesheet" href="includes/css/meta-box-form.css" type="text/css"> <?php
    require_once( 'includes/meta-box-form.php' );
}

function registra_meta_box_cliente_contato() {
    add_meta_box(
        'informacoes-de-contato',
        'Informações de Contato',
        'preenche_cliente_contato',
        'cliente',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'registra_meta_box_cliente_contato');

function atualiza_meta_box_cliente( $post_id ) {
    if ( isset( $_POST['nome_id'] )) {
        update_post_meta($post_id, 'nome_id', sanitize_text_field($_POST['nome_id']));
    }
    if (isset( $_POST['telefone_id'] )) {
        update_post_meta($post_id, 'telefone_id', sanitize_text_field($_POST['telefone_id']));
    }
    if (isset( $_POST['email_id'] )) {
        update_post_meta($post_id, 'email_id', sanitize_text_field($_POST['email_id']));
    }
    if (isset( $_POST['razao_social_id'] )) {
        update_post_meta($post_id, 'razao_social_id', sanitize_text_field($_POST['razao_social_id']));
    }
    if (isset( $_POST['nome_fantasia_id'] )) {
        update_post_meta($post_id, 'nome_fantasia_id', sanitize_text_field($_POST['nome_fantasia_id']));
    }
    if (isset( $_POST['cpf_id'] )) {
        update_post_meta($post_id, 'cpf_id', sanitize_text_field($_POST['cpf_id']));
    }
    if (isset( $_POST['endereco_id'] )) {
        update_post_meta($post_id, 'endereco_id', sanitize_text_field($_POST['endereco_id']));
    }
    if (isset( $_POST['servico_id'] )) {
        update_post_meta($post_id, 'servico_id', sanitize_text_field($_POST['servico_id']));
    }
    if (isset( $_POST['data_inic_id'] )) {
        update_post_meta($post_id, 'data_inic_id', sanitize_text_field($_POST['data_inic_id']));
    }
    if (isset( $_POST['data_venc_id'] )) {
        update_post_meta($post_id, 'data_venc_id', sanitize_text_field($_POST['data_venc_id']));
    }
}
add_action('save_post', 'atualiza_meta_box_cliente');

function preenche_informacoes_cliente( $post ) {
    $meta_data_cliente_info = get_post_meta( $post->ID );
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <label for="nome-input">
                    Nome / Razão Social:
                </label>
                <input type="text" name="razao_social_id" value="<?= $meta_data_cliente_info['razao_social_id'][0] ?>">
            </div>
            <div class="col-md-6">
                <label for="nome-input">
                    Nome Fantasia:
                </label>
                <input type="text" name="nome_fantasia_id" value="<?= $meta_data_cliente_info['nome_fantasia_id'][0] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="nome-input">
                    CPF / CNPJ:
                </label>
                <input type="text" name="cpf_id" value="<?= $meta_data_cliente_info['cpf_id'][0] ?>">
            </div>
            <div class="col-md-6">
                <label for="nome-input">
                    Endereço:
                </label>
                <input type="text" name="endereco_id" value="<?= $meta_data_cliente_info['endereco_id'][0] ?>">
            </div>
        </div>
    </div>
    <?php
}

function registra_meta_box_informacoes_cliente() {
    add_meta_box(
        'informacoes-do-cliente',
        'Informações do Cliente',
        'preenche_informacoes_cliente',
        'cliente',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'registra_meta_box_informacoes_cliente');

function preenche_informacoes_servico( $post ) {
    $meta_data_cliente_info = get_post_meta( $post->ID );
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <label for="nome-input">
                    Serviço:
                </label>
                <input type="text" name="servico_id" value="<?= $meta_data_cliente_info['servico_id'][0] ?>">
            </div>
            <div class="col-md-6">
                <label for="nome-input">
                    Data Início:
                </label>
                <input type="date" name="data_inic_id" value="<?= $meta_data_cliente_info['data_inic_id'][0] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="nome-input">
                    Data Vencimento:
                </label>
                <input type="number" name="data_venc_id" value="<?= $meta_data_cliente_info['data_venc_id'][0] ?>">
            </div>
        </div>
    </div>
    <?php
}

function registra_meta_box_informacoes_servico() {
    add_meta_box(
        'informacoes-dos-servicos',
        'Informações dos Serviços',
        'preenche_informacoes_servico',
        'cliente',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'registra_meta_box_informacoes_servico');

?>
