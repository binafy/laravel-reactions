<?php

return [
    /*
     * The table name.
     */
    'table' => 'reaction',

    'user' => [
        /*
       * User model.
       */
        'model' => 'App\Models\User',

        /*
         * Foreign Key column name.
         */
        'foreign_key' => 'user_id',

        /*
         * Users table name.
         */
        'table' => 'users',

        /*
         * The correct guard.
         */
        'guard' => 'web',

        /*
         * If you are using uuid or ulid you can change it for the type of foreign_key.
         *
         * When you are using ulid or uuid, you need to add related traits into the models.
         */
        'foreign_key_type' => 'id', // uuid, ulid, id
    ]
];
