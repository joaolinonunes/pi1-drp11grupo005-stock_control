<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Fornecedores | Projeto Integrador</title>

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
    <div class="page">
        <header class="navbar navbar-expand-md navbar-light">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <span class="fw-bold">Projeto Integrador</span>
                </h1>
        </header>

        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                        <li class="nav-item">
                            <?= $this->Html->link(
                            '<span class="nav-link-icon d-md-none d-lg-inline-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <div class="nav-link-title">Dashboard</div>',
                                ['controller' => 'Dashboard', 'action' => 'index'],
                                ['class' => 'nav-link', 'escape' => false]
                            ) ?>
                        </li>
                            <li class="nav-item">
                            <?= $this->Html->link(
                                    '<span class="nav-link-icon d-md-none d-lg-inline-flex">
                                        <!-- Package Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-package"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                                    </span>
                                    <div class="nav-link-title">Produtos</div>',
                                        ['controller' => 'Produtos', 'action' => 'index'],
                                        ['escape' => false, 'class' => 'nav-link']
                                ) ?>
                            </li>
                            <li class="nav-item active">
                                <a href="suppliers.html" class="nav-link">
                                    <span class="nav-link-icon d-md-none d-lg-inline-flex">
                                        <!-- Truck-Delivery Icon -->
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-truck-delivery"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" /><path d="M3 9l4 0" /></svg>
                                    </span>
                                    <div class="nav-link-title">Fornecedores</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title fs-1">
                                Fornecedores
                            </h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                            <?= $this->Html->link(
                                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg> Adicionar Fornecedor',
                                    ['action' => 'add'],
                                    ['class' => 'btn btn-primary d-none d-sm-flex', 'escape' => false]
                            ) ?>

                                <!-- Adicionar Mobile -->
                                <?= $this->Html->link(
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>',
                                        ['action' => 'add'],
                                        ['class' => 'btn btn-primary d-sm-none btn-icon', 'aria-label' => 'Novo Fornecedor', 'escape' => false]
                                ) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <!-- Cabeçalho -->
                        <div class="card-header"></div>
    
                        <!-- Tabela responsiva -->
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>Contato</th>
                                        <th>Categoria</th>
                                        <th>Cadastrado em</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fornecedores as $fornecedor): ?>
                                        <tr>
                                            <td><span class="text-muted"><?= h($fornecedor->id_fornecedor) ?></span></td>
                                            <td><?= h($fornecedor->nome) ?></td>
                                            <td><?= h($fornecedor->contato) ?></td>
                                            <td><?= h($fornecedor->categoria) ?></td>
                                            <td><span class="text-muted"><?= $fornecedor->data_cadastro ? h($fornecedor->data_cadastro->format('d \d\e F \d\e Y, H:i')) : 'Não informado' ?>
                                            <td class="table-actions">
                                                    <?= $this->Html->link(
                                                        '<i class="bi bi-pencil"></i>', 
                                                        ['action' => 'edit', $fornecedor->id_fornecedor], 
                                                        ['class' => 'btn btn-icon btn-outline-primary', 'escape' => false, 'data-bs-toggle' => 'tooltip', 'title' => 'Editar fornecedor']
                                                    ) ?>
                                                    <?= $this->Form->postLink(
                                                        '<i class="bi bi-trash"></i>', 
                                                        ['action' => 'delete', $fornecedor->id_fornecedor], 
                                                        ['confirm' => 'Tem certeza que deseja excluir?', 'class' => 'btn btn-icon btn-outline-danger ms-1', 'escape' => false, 'data-bs-toggle' => 'tooltip', 'title' => 'Excluir fornecedor']
                                                    ) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        
                        <!-- Rodapé -->
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted">
                                Mostrando de <?= $this->Paginator->counter('Página {{page}} de {{pages}}, exibindo {{current}} registros de {{count}} no total') ?>
                            </p>
                            <ul class="pagination m-0 ms-auto">
                                <?= $this->Paginator->prev('<svg ...></svg>', ['escape' => false, 'class' => 'page-link']) ?>
                                <?= $this->Paginator->numbers(['class' => 'page-item', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'a', 'modulus' => 2]) ?>
                                <?= $this->Paginator->next('<svg ...></svg>', ['escape' => false, 'class' => 'page-link']) ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            Projeto Integrador - DRP11 - Grupo 005 &copy; 2025
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Tabler Core JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.1.1/dist/js/tabler.min.js"></script>
</body>

</html>