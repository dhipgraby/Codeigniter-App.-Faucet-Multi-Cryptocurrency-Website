<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_withdraw extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                    
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                
                        ),

                        'count' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE,
                                'unique' => TRUE
                        ),

                        'amount' => array(
                                'type' => 'DECIMAL',
                                'constraint' => '10,5',
                        ),

                         'status' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),

                         'addy' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                                              
                        'datetime' => array(
                                'type' => 'DATETIME',
                               
                        ),
                 
                       
                ));
                $this->dbforge->add_key('count', TRUE);
                $this->dbforge->create_table('withdraw');
        }

        public function down()
        {
                $this->dbforge->drop_table('withdraw');
        }
}

