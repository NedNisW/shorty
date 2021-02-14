<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateShortUrlsTable extends AbstractMigration
{
    public function up(): void
    {
        $this->table('shorturls')
            ->addColumn('hash', 'string')
            ->addColumn('target', 'string')
            ->addColumn('requests', 'integer')
            ->addTimestamps()
            ->addIndex(['hash'], ['unique' => true])
            ->create();
    }

    public function down(): void
    {

    }
}
