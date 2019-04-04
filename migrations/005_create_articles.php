<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_articles extends CI_Migration {

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
                       
                        'pubdate' => array(
                                'type' => 'DATE',
                               
                        ),
                        'created' => array(
                                'type' => 'DATETIME',
                               
                        ),
                         'modified' => array(
                                'type' => 'DATETIME',
                               
                        ),
                        'body' => array(
                                'type' => 'TEXT',
                               
                        ),
                       
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('articles');
        }

        public function down()
        {
                $this->dbforge->drop_table('articles');
        }
}

