<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProdutosFixture
 */
class ProdutosFixture extends TestFixture
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
                'id_produto' => 1,
                'nome' => 'Lorem ipsum dolor sit amet',
                'data_cadastro' => '2025-05-03 20:25:19',
                'id_fornecedor' => 1,
                'qtd_estoque' => 1,
                'tipo_unidade' => 'Lorem ipsum dolor sit amet',
                'condicao' => 'Lorem ipsum dolor sit amet',
                'validade' => '2025-05-03',
            ],
        ];
        parent::init();
    }
}
