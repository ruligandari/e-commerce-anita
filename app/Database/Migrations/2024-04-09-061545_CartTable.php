<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CartTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cart' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'id_size' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => 11
            ]
        ]);
        $this->forge->addKey('id_cart', true);
        $this->forge->createTable('cart');
    }

    public function down()
    {
        $this->forge->dropTable('cart');
    }
}
