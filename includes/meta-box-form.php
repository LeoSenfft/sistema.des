<link rel="stylesheet" href="/css/meta-box-form.css" type="text/css">

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <label for="nome-input">
                Nome:
            </label>
            <input type="text" name="nome_id" value="<?= $meta_data_cliente_contato['nome_id'][0] ?>">
        </div>
        <div class="col-md-4">
            <label for="nome-input">
                Telefone:
            </label>
            <input type="text" name="telefone_id" value="<?= $meta_data_cliente_contato['telefone_id'][0] ?>">
        </div>
        <div class="col-md-4">
            <label for="nome-input">
                E-mail:
            </label>
            <input type="text" name="email_id" value="<?= $meta_data_cliente_contato['email_id'][0] ?>">
        </div>
    </div>
</div>
