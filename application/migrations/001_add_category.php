<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_category extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'category_id' => array(
                                'type' => 'INT',
                                'constraint' =>11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'category_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'category_parent_id' => array(
                                'type' => 'INT',
                                'constraint'=> 11,
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('category_id', TRUE);
                $this->dbforge->create_table('category');
                $this->dbforge->add_field(array(
                        'category_id' => array(
                                'type' => 'INT',
                                'constraint' =>11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'category_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'category_parent_id' => array(
                                'type' => 'INT',
                                'constraint'=> 11,
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('category_id', TRUE);
                $this->dbforge->create_table('category');
       
        }

        public function down()
        {
                $this->dbforge->drop_table('category');
        }
}