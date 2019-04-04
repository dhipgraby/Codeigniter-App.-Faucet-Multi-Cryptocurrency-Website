<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_faucet extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                    
                               'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'unique' => TRUE,
                                'auto_increment' => TRUE
                        ),

                         'addy' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                'unique' => TRUE,
                        ),

                         'bbb' => array(
                                'type' => 'INT',
                                'constraint' => '15',
                        ),

                         'ipp' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),

                         'boost' => array(
                                'type' => 'INT',
                                'constraint' => '12',
                        ),

                                         
                        'datetime' => array(
                                'type' => 'DATETIME',
                               
                        ),
                 
                       
                ));

                 $this->dbforge->add_key('addy', TRUE);
                 $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('faucet');
        }

        public function down()
        {
                $this->dbforge->drop_table('faucet');
        }
}

