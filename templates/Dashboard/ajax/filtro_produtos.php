<h4 class="mb-3">Produtos - 
    <?= match ($tipo) {
        'total' => 'Todos',
        'pouco_estoque' => 'Pouco Estoque',
        'validade_expirada' => 'Validade Expirada',
        'validade_proxima' => 'Validade Próxima',
        default => 'Filtro'
    } ?>
</h4>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Qtd Estoque</th>
            <th>Validade</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?= h($produto->nome) ?></td>
                <td><?= h($produto->qtd_estoque) ?></td>
                <td><?= h($produto->validade ? $produto->validade->format('d/m/Y') : '-') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
