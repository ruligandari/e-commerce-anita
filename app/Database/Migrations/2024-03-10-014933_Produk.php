<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        // - id (int, primary key) name (varchar) description (text) price (decimal) category_id
        $this->forge->addField([
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'harga' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'kategori_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],

        ]);

        $this->forge->addKey('id_produk');
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
