<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_deposit extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(

                         'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),

                        'amount' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                
                        ),
                        'txid' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100'
                        ),
                        'addy' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                                              
                        'datetime' => array(
                                'type' => 'DATETIME',
                               
                        )
                 
                       
                ));
                  $this->dbforge->add_key('id', TRUE);
                $this->dbforge->add_key('txid', TRUE);
                $this->dbforge->create_table('deposits');
        }

        public function down()
        {
                $this->dbforge->drop_table('deposits');
        }
}

