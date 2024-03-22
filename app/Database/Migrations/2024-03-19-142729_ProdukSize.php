<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProdukSize extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk_size' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_produk' => [
                'type' => 'INT'
            ],
            'size' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'stok' => [
                'type' => 'INT'
            ]
        ]);
        $this->forge->addKey('id_produk_size', true);
        $this->forge->createTable('produk_size');
    }

    public function down()
    {
        $this->forge->dropTable('produk_size');
    }
}
