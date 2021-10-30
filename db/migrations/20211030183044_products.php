<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Products extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $product = $this->table('products');
        $product->addColumn('name', 'string', ['limit'=>'100'])
                ->addColumn('price', 'integer')
                ->addColumn('qty', 'integer')
                ->addColumn('created_at', 'timestamp', ['default'=>'CURRENT_TIMESTAMP'])
                ->addColumn('updated_at', 'timestamp', ['default'=>'CURRENT_TIMESTAMP'])
                ->create();
    }
}
