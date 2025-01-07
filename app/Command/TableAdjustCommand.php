<?php

declare(strict_types=1);

namespace App\Command;

use App\Model\Fleet;
use App\Model\Engine\EngineLog;
use Psr\Container\ContainerInterface;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;

#[Command]
class TableAdjustCommand extends HyperfCommand
{
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct('table:engine');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Adjust table engine');
    }

    public function handle()
    {
        $fleets = Fleet::where('active', 1)->get();
        foreach($fleets as $fleet){
            EngineLog::table($fleet->id);
        } 
        $this->line('Hello Hyperf!', 'info');
    }
}
