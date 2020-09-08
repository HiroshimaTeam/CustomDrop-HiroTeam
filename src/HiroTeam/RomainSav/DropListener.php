<?php

#██╗░░██╗██╗██████╗░░█████╗░████████╗███████╗░█████╗░███╗░░░███╗
#██║░░██║██║██╔══██╗██╔══██╗╚══██╔══╝██╔════╝██╔══██╗████╗░████║
#███████║██║██████╔╝██║░░██║░░░██║░░░█████╗░░███████║██╔████╔██║
#██╔══██║██║██╔══██╗██║░░██║░░░██║░░░██╔══╝░░██╔══██║██║╚██╔╝██║
#██║░░██║██║██║░░██║╚█████╔╝░░░██║░░░███████╗██║░░██║██║░╚═╝░██║
#╚═╝░░╚═╝╚═╝╚═╝░░╚═╝░╚════╝░░░░╚═╝░░░╚══════╝╚═╝░░╚═╝╚═╝░░░░░╚═╝

namespace HiroTeam\RomainSav;

use HiroTeam\RomainSav\DropMain;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;

class DropListener implements Listener{

    /**
     * @var DropMain
     */
    private $main;

    /**
     * DropListener constructor.
     * @param DropMain $main
     */
    public function __construct(DropMain $main)
    {
        $this->main = $main;
    }

    /**
     * @param BlockBreakEvent $event
     */
    public function onBreak(BlockBreakEvent $event){
        $block = $event->getBlock();
        foreach (DropMain::getAllDropConfig() as $item => $drops){
            $blockBreak = $drops['block'];
            $drop = $drops['drop'];
            if(DropMain::isInConfig($block, $blockBreak)){
                $event->setDrops([DropMain::getDropResult($drop)]);
            }
        }
    }
}