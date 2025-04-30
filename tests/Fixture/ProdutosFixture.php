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
                'data_cadastro' => '2025-04-29 00:23:29',
            ],
        ];
        parent::init();
    }
}
