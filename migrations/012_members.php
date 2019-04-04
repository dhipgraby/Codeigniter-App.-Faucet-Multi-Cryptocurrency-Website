<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_members extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                    
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),

                        'active' => array(
                                'type' => 'INT',
                                'default' => NULL,
                                'constraint' => '12'
                        ),
                   

                         'addess' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                                'unique' => TRUE,
                        ),

                         'depaddy' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                                'unique' => TRUE,
                        ),

                         'transid' => array(
                                'type' => 'INT',
                                'default' => 0,
                                'constraint' => '12'
                        ),

                         'reefer' => array(
                                'type' => 'INT',
                                'default' => 0,
                                'constraint' => '12'
                        ),
                         'wlimit' => array(
                                'type' => 'INT',
                                'default' => 0,
                                'constraint' => '12'
                        ),
                                         
                        'datetime' => array(
                                'type' => 'DATETIME',
                               
                        ),
                 
                       
                ));

                 $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('members');
        }

        public function down()
        {
                $this->dbforge->drop_table('members');
        }
}

