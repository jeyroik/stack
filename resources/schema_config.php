<?php

use \funcraft\stack\components\schemaManagers\SchemaManagerBasic as Schema;

return [
    Schema::CONFIG_FIELD__SCHEMA => [
        [
            Schema::CONFIG_FIELD__KEY => 'request',
            Schema::CONFIG_FIELD__TYPE => Schema::TYPE__CLASS
        ]
    ],

    'request' => [
        Schema::CONFIG_FIELD__CLASS => \funcraft\stack\components\stacks\StackRequest::class,
        Schema::CONFIG_FIELD__PROCESSORS => [
            \funcraft\stack\components\processors\ProcessorEcho::class
        ],
        Schema::CONFIG_FIELD__HANDLERS => [
            \funcraft\stack\components\handlers\HandlerEcho::class
        ],
        Schema::CONFIG_FIELD__FORMATTERS => [

        ],
        Schema::CONFIG_FIELD__RECORDS => [
            \funcraft\stack\components\records\RecordHttpRequest::class
        ]
    ],
    'response' => [
        Schema::CONFIG_FIELD__CLASS => '',
        Schema::CONFIG_FIELD__PROCESSORS => [

        ],
        Schema::CONFIG_FIELD__HANDLERS => [

        ],
        Schema::CONFIG_FIELD__FORMATTERS => [

        ],
        Schema::CONFIG_FIELD__RECORDS => [

        ]
    ]
];
