<?php

return [
    'fleet_id' => 3,
    'fleet_model' => \App\Model\Fleet::class,
    'topics' => [
        'data/seipakning/vdr/#' => [
            'parser' => Smartship\Seipakning\Parser\VDR::class,
            'model' => App\Model\Navigation::class,
        ],
        'data/seipakning/ccr/hanla' => [
            'parser' => Smartship\Seipakning\Parser\Hanla::class,
            'model' => '',
        ],
        // 'data/seipakning/ccr/pumpstatus' => [
        //     'parser' => '',
        //     'model' => '',
        // ],
        // 'data/seipakning/ecr/engine' => [
        //     'parser' => '',
        //     'model' => '',
        // ],
        // 'data/seipakning/ccr/cargo' => [
        //     'parser' => '',
        //     'model' => '',
        // ],
    ]
];