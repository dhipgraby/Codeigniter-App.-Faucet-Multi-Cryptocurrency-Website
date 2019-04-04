<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_purchase extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                    
                        'count' => array(
                                'type' => 'INT',
                                'constraint' => '12',
                                'auto_increment' => TRUE,

                        ),

                        'id' => array(
                                'type' => 'INT',
                                'constraint' => '12'

                        ),
                         'item' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45',
                        ),
                         'price' => array(
                                'type' => 'INT',
                                'constraint' => '12',
                        ),
                                        
                        'datetime' => array(
                                'type' => 'DATETIME',
                               
                        ),
                 
                       
                ));

                 $this->dbforge->add_key('count', TRUE);    
                $this->dbforge->create_table('purchase');
        }

        public function down()
        {
                $this->dbforge->drop_table('purchase');
        }
}

