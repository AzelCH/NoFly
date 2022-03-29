<?php

namespace AzelCH;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerToggleFlightEvent;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {
  
  public function onEnable(): void{
    $this->saveResource("config.yml");
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  
  public function toggleFlight(PlayerToggleFlightEvent $event){
    $player = $event->getPlayer();
    if($this->getConfig()->get("enable") === true){
      if(!$player->hasPermission("nofly.bypass")){
        $player->kick($this->getConfig()->get("kick-message"));
      }
    }
  }
}
