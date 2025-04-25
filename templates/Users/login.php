<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Projeto Integrador</title>

    <!-- Tabler Core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.1.1/dist/css/tabler.min.css" />
    <!-- CSS Custom -->
    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="d-flex flex-column">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <h1 class="navbar-brand navbar-brand-autodark">
                    <span class="fw-bold fs-1">Projeto Integrador</span>
                </h1>
            </div>

            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Acesso ao Sistema</h2>

                    <!-- Início do form CakePHP -->
                    

                    <?= $this->Form->create() ?>

                    <div class="mb-3">
                        <?= $this->Form->control('email', [
                            'label' => 'Email',
                            'placeholder' => 'seu@email.com',
                            'class' => 'form-control',
                            'type' => 'email'
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->control('password', [
                            'label' => 'Senha',
                            'placeholder' => 'Sua senha',
                            'class' => 'form-control',
                            'type' => 'password'
                        ]) ?>
                    </div>

                    <div class="mb-2">
                        <label class="form-check">
                            <input type="checkbox" class="form-check-input" />
                            <span class="form-check-label">Lembrar de mim neste dispositivo</span>
                        </label>
                    </div>

                    <?php foreach (['flash', 'auth'] as $type): ?>
                        <?= $this->Flash->render($type) ?>
                    <?php endforeach; ?>

                    <div class="form-footer">
                        <?= $this->Form->button('Entrar', ['class' => 'btn btn-primary w-100']) ?>
                    </div>

                    <?= $this->Form->end() ?>
                    <!-- Fim do form CakePHP -->
                </div>
            </div>

            <div class="text-center text-muted mt-3">
                Ainda não tem uma conta? <a href="#"> Solicite acesso</a>
            </div>
        </div>
    </div>

    <!-- Tabler Core JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.1.1/dist/js/tabler.min.js"></script>
</body>
</html>