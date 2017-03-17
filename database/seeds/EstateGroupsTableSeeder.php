<?php

use Illuminate\Database\Seeder;

class EstateGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $estate_group = \App\EstateGroup::create(
            array('id' => '2', 'company_app_id' => '1', 'title' => 'Green', 'description' => 'Properties on the green block.', 'location' => '', 'status' => '1', 'created_at' => '2017-01-17 14:26:57', 'updated_at' => '2017-01-18 06:30:21', 'deleted_at' => NULL)
        );

        $estate_group = \App\EstateGroup::create(
            array('id' => '3', 'company_app_id' => '1', 'title' => 'Yellow', 'description' => 'Properties on the yellow block.', 'location' => '', 'status' => '1', 'created_at' => '2017-01-17 15:18:29', 'updated_at' => '2017-01-17 15:18:29', 'deleted_at' => NULL)
        );
    }
}
