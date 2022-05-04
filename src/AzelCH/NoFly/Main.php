<?php

namespace AzelCH\NoFly;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerToggleFlightEvent;
use pocketmine\player\GameMode;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{

    public function onEnable(): void
    {
        $this->saveResource("config.yml");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function toggleFlight(PlayerToggleFlightEvent $event): void
    {
        $player = $event->getPlayer();
        if ($this->getConfig()->get("enable") === true) {
            if (!$player->hasPermission("nofly.bypass") || ($this->getConfig()->get("Allow-Spectator") === false && $player->getGamemode() === GameMode::SPECTATOR())) {
                $player->kick($this->getConfig()->get("kick-message"));
            }
        }
    }
}
