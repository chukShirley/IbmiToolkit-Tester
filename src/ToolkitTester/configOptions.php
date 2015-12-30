<?php
return [
    'use_persistent_db_connection' => false,
    'db2_connection_options' => [
        'database' => '*LOCAL',
        'user' => 'WEBTEST',
        'password' => 'WEBTEST'
    ],
    'db2_options' => [

        /*
         * DB2 i5 naming mode
         */
        'i5_naming' => DB2_I5_NAMING_ON,

        /*
         * Library where RPG, CL compiled objects are located
         */
        'i5_libl' => 'ACSTEST',
    ],

    'toolkit_options' => [

        /*
         * Toolkit stateless mode
         */
        'stateless' => false,

        /*
         * Toolkit plug size
         */
        'plugSize' => '15M',

        /*
         * Debug mode
         */
        'debug' => true,

        /*
         * Debug log file
         */
        'debugLogFile' => '/usr/local/zendsvr6/var/log/toolkit_debug' . date("Ymd") . '.log',

        /*
         * Internal key (use with stateful mode)
         */
        'InternalKey' => '/tmp/chukisthebest01'


    ]
];