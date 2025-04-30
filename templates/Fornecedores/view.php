<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore $fornecedore
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Fornecedore'), ['action' => 'edit', $fornecedore->id_fornecedor], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Fornecedore'), ['action' => 'delete', $fornecedore->id_fornecedor], ['confirm' => __('Are you sure you want to delete # {0}?', $fornecedore->id_fornecedor), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Fornecedores'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Fornecedore'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="fornecedores view content">
            <h3><?= h($fornecedore->nome) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <td><?= h($fornecedore->nome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cnpj') ?></th>
                    <td><?= h($fornecedore->cnpj) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contato') ?></th>
                    <td><?= h($fornecedore->contato) ?></td>
                </tr>
                <tr>
                    <th><?= __('Categoria') ?></th>
                    <td><?= h($fornecedore->categoria) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id Fornecedor') ?></th>
                    <td><?= $this->Number->format($fornecedore->id_fornecedor) ?></td>
                </tr>
                <tr>
                    <th><?= __('Data Cadastro') ?></th>
                    <td><?= h($fornecedore->data_cadastro) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>