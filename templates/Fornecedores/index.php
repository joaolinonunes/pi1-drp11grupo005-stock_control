<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Fornecedore> $fornecedores
 */
?>
<div class="fornecedores index content">
    <?= $this->Html->link(__('New Fornecedore'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Fornecedores') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id_fornecedor') ?></th>
                    <th><?= $this->Paginator->sort('nome') ?></th>
                    <th><?= $this->Paginator->sort('cnpj') ?></th>
                    <th><?= $this->Paginator->sort('contato') ?></th>
                    <th><?= $this->Paginator->sort('categoria') ?></th>
                    <th><?= $this->Paginator->sort('data_cadastro') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fornecedores as $fornecedore): ?>
                <tr>
                    <td><?= $this->Number->format($fornecedore->id_fornecedor) ?></td>
                    <td><?= h($fornecedore->nome) ?></td>
                    <td><?= h($fornecedore->cnpj) ?></td>
                    <td><?= h($fornecedore->contato) ?></td>
                    <td><?= h($fornecedore->categoria) ?></td>
                    <td><?= h($fornecedore->data_cadastro) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $fornecedore->id_fornecedor]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fornecedore->id_fornecedor]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $fornecedore->id_fornecedor],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $fornecedore->id_fornecedor),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>