<?php

#██╗░░██╗██╗██████╗░░█████╗░████████╗███████╗░█████╗░███╗░░░███╗
#██║░░██║██║██╔══██╗██╔══██╗╚══██╔══╝██╔════╝██╔══██╗████╗░████║
#███████║██║██████╔╝██║░░██║░░░██║░░░█████╗░░███████║██╔████╔██║
#██╔══██║██║██╔══██╗██║░░██║░░░██║░░░██╔══╝░░██╔══██║██║╚██╔╝██║
#██║░░██║██║██║░░██║╚█████╔╝░░░██║░░░███████╗██║░░██║██║░╚═╝░██║
#╚═╝░░╚═╝╚═╝╚═╝░░╚═╝░╚════╝░░░░╚═╝░░░╚══════╝╚═╝░░╚═╝╚═╝░░░░░╚═╝

namespace HiroTeam\RomainSav;

use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class DropMain extends PluginBase {

    /**
     * @var Config
     */
    private static $config;

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents(new DropListener($this), $this);
        if(!file_exists($this->getDataFolder() . "config.yml")){
            $this->saveResource("config.yml");
        }
        self::$config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

    /**
     * @return Config
     */
    public static function getDropConfig(): Config
    {
        return self::$config;
    }

    /**
     * @return array
     */
    public static function getAllDropConfig(): array
    {
        return self::getDropConfig()->getAll();
    }

    /**
     * @param string $drop
     * @return Item
     */
    public static function getDropResult(string $drop): Item
    {
        $drop = explode(":", $drop);
        return Item::get($drop[0], $drop[1], $drop[2]);
    }

    /**
     * @param Block $block
     * @return bool
     */
    public static function isInConfig(Block $block, $blockBreak): bool
    {
        return $blockBreak === strval($block->getId() . ":" . $block->getDamage());
    }

}