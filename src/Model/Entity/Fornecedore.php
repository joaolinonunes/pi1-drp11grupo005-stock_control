<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fornecedore Entity
 *
 * @property int $id_fornecedor
 * @property string $nome
 * @property string $cnpj
 * @property string|null $contato
 * @property string|null $categoria
 * @property \Cake\I18n\DateTime|null $data_cadastro
 */
class Fornecedore extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'nome' => true,
        'cnpj' => true,
        'contato' => true,
        'categoria' => true,
        'data_cadastro' => true,
    ];
}
