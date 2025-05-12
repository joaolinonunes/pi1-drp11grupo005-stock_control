<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto $produto
 */
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Produtos | Projeto Integrador</title>

    <!-- Tabler Core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.1.1/dist/css/tabler.min.css" crossorigin="anonymous">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-qHuVd85flbcIw6Nh8yy/7PP9V2L2gTwF4t2QzEfsPDi7gC7PRflT+kP8N1ijDgkV" crossorigin="anonymous">
    <!-- linke para funcionar os icones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- CSS Custom -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Editar Produto
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <?= $this->Html->link(
                            'Voltar',
                            ['action' => 'index'],
                            ['class' => 'btn btn-secondary']
                        ) ?>
                        <?= $this->Form->postLink(
                            'Excluir',
                            ['action' => 'delete', $produto->id_produto],
                            [
                                'confirm' => __('Tem certeza que deseja excluir # {0}?', $produto->nome),
                                'class' => 'btn btn-danger'
                            ]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <?= $this->Form->create($produto) ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Produto</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome do produto" value="<?= h($produto->nome) ?>">
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Fornecedor</label>
                                <select name="id_fornecedor" class="form-select">
                                    <option value="">Selecione</option>
                                    <?php foreach ($fornecedores as $id => $nome): ?>
                                        <option value="<?= h($id) ?>" <?= $produto->id_fornecedor == $id ? 'selected' : '' ?>>
                                            <?= h($nome) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Quantidade Estoque</label>
                                <input type="number" min="0" class="form-control" name="qtd_estoque" placeholder="0" value="<?= h($produto->qtd_estoque) ?>">
                            </div>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Tipo de Unidade</label>
                                <select class="form-select" name="tipo_unidade">
                                    <option value="kg" <?= $produto->tipo_unidade == 'kg' ? 'selected' : '' ?>>Kg</option>
                                    <option value="pct" <?= $produto->tipo_unidade == 'pct' ? 'selected' : '' ?>>Pct</option>
                                    <option value="un" <?= $produto->tipo_unidade == 'un' ? 'selected' : '' ?>>Unidade</option>
                                    <option value="l" <?= $produto->tipo_unidade == 'l' ? 'selected' : '' ?>>Litro</option>
                                    <option value="g" <?= $produto->tipo_unidade == 'g' ? 'selected' : '' ?>>Grama</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Data de Cadastro</label>
                                <input type="ddatetime-local" class="form-control" name="data_cadastro" value="<?= $produto->data_cadastro ? $produto->data_cadastro->format('Y-m-d\TH:i') : '' ?>">
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Data de Validade</label>
                                <input type="date" class="form-control" name="validade" value="<?= $produto->validade ? $produto->validade->format('Y-m-d') : '' ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-footer">
                        <div class="row">
                            <div class="col-auto ms-auto">
                                <?= $this->Form->button('Salvar Alterações', ['class' => 'btn btn-primary']) ?>
                            </div>
                        </div>
                    </div>
                    
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tabler Core JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.1.1/dist/js/tabler.min.js"></script>

    <!-- Custom Script -->
    <script src="js/script.js"></script>
</body>