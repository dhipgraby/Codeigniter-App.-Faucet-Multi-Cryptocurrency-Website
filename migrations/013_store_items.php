<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Store_items extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100'
                        ),
                         'slug' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'price' => array(
                                'type' => 'INT',
                                'constraint' => '12',
                        ),
                        'order' => array(
                                'type' => 'INT',
                                'constraint' => '11',
                        ),
                        'body' => array(
                                'type' => 'TEXT',
                               
                        ),
                        'parent_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'default' => 0,
                        ),
                          'created' => array(
                                'type' => 'DATETIME',
                               
                        ),
                         'modified' => array(
                                'type' => 'DATETIME',
                               
                        ),
                       
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('store');
        }

        public function down()
        {
                $this->dbforge->drop_table('store');
        }
}

