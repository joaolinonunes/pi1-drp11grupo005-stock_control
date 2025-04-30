<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FornecedoresFixture
 */
class FornecedoresFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id_fornecedor' => 1,
                'nome' => 'Lorem ipsum dolor sit amet',
                'cnpj' => 'Lorem ipsum dolor ',
                'contato' => 'Lorem ipsum dolor sit amet',
                'categoria' => 'Lorem ipsum dolor sit amet',
                'data_cadastro' => '2025-04-30 00:35:15',
            ],
        ];
        parent::init();
    }
}
