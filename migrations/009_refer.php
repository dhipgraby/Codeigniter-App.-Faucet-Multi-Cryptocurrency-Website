<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_refer extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                    
                        'depaddy' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                'unique' => TRUE,
                                'unsigned' => TRUE,
                        ),
                        'totcom' => array(
                                'type' => 'INT',
                                'constraint' => '12',
                        ),

                         'refID' => array(
                                'type' => 'INT',
                                'constraint' => '12',
                        ),

                                         
                        'lastclaim' => array(
                                'type' => 'DATETIME',
                               
                        ),
                 
                       
                ));
                 $this->dbforge->add_key('depaddy', TRUE);
                $this->dbforge->create_table('refer');
        }

        public function down()
        {
                $this->dbforge->drop_table('refer');
        }
}

