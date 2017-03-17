<?php

use Illuminate\Database\Seeder;

class ContactMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $message = \App\ContactMessage::create(
            array(
                'id' => '1',
                'name' => 'Jane Doe',
                'email' => 'jdoe@mail.com',
                'phone' => '0700111222',
                'subject' => 'Test message',
                'message' => 'Some test message.',
                'status' => '0',
                'read_at' => NULL,
                'created_at' => '2017-02-11 22:48:45',
                'updated_at' => '2017-02-11 22:48:45',
                'deleted_at' => NULL
            )
        );

        $message = \App\ContactMessage::create(
            array(
                'id' => '2',
                'name' => 'Jane Doe',
                'email' => 'jdoe@mail.com',
                'phone' => '0700111222',
                'subject' => 'Test message',
                'message' => 'Some test message.',
                'status' => '0',
                'read_at' => NULL,
                'created_at' => '2017-02-11 22:50:06',
                'updated_at' => '2017-02-11 22:50:06',
                'deleted_at' => NULL
            )
        );

        $message = \App\ContactMessage::create(
            array(
                'id' => '3',
                'name' => 'Jane Doe',
                'email' => 'jdoe@mail.com',
                'phone' => '0700111222',
                'subject' => 'Test message',
                'message' => 'Some test message.',
                'status' => '0',
                'read_at' => NULL,
                'created_at' => '2017-02-11 22:51:35',
                'updated_at' => '2017-02-11 22:51:35',
                'deleted_at' => NULL
            )
        );

        $message = \App\ContactMessage::create(
            array(
                'id' => '4',
                'name' => 'Jane Doe',
                'email' => 'jdoe@mail.com',
                'phone' => '0700111222',
                'subject' => 'Test message',
                'message' => 'Some test message.',
                'status' => '0',
                'read_at' => NULL,
                'created_at' => '2017-02-11 22:54:02',
                'updated_at' => '2017-02-11 22:54:02',
                'deleted_at' => NULL
            )
        );

        $message = \App\ContactMessage::create(
            array(
                'id' => '5',
                'name' => 'Jane Doe',
                'email' => 'jdoe@mail.com',
                'phone' => '0700111222',
                'subject' => 'Test message',
                'message' => 'Some test message.',
                'status' => '0',
                'read_at' => NULL,
                'created_at' => '2017-02-11 22:55:22',
                'updated_at' => '2017-02-11 22:55:22',
                'deleted_at' => NULL
            )
        );

        $message = \App\ContactMessage::create(
            array(
                'id' => '6',
                'name' => 'John Doe',
                'email' => 'jdoe@mail.com',
                'phone' => '0700111222',
                'subject' => 'Test message',
                'message' => 'Some testing...',
                'status' => '0',
                'read_at' => NULL,
                'created_at' => '2017-02-12 03:25:32',
                'updated_at' => '2017-02-12 03:25:32',
                'deleted_at' => NULL
            )
        );

        $message = \App\ContactMessage::create(
            array(
                'id' => '7',
                'name' => 'John Doe',
                'email' => 'jdoe@mail.com',
                'phone' => '0700111222',
                'subject' => 'Test message',
                'message' => 'Some testing...',
                'status' => '0',
                'read_at' => NULL,
                'created_at' => '2017-02-12 03:26:26',
                'updated_at' => '2017-02-12 03:26:26',
                'deleted_at' => NULL
            )
        );

    }
}
