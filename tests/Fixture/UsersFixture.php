<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'id' => 1,
                'email' => 'Lorem ipsum dolor sit amet',
                'passwor' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-04-20 22:21:50',
                'modified' => '2025-04-20 22:21:50',
            ],
        ];
        parent::init();
    }
}
