<?php

/* This plugin written by str0nix */
/* GitHub: https://github.com/str0nixofficial */
/* Twitter: https://twitter.com/str0nix */
/* This is a free software, so you are able to modify it. */

namespace str0nix\foic;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\entity\Entity;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\ConsoleCommandExecutor;

class Main extends PluginBase implements Listener {

    public function onEnable(){
	     $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{

		  switch($command->getName()){
		      case "foic";
		          if($sender instanceof Player){
		              $sender->sendMessage("§7Plugin written by: §6str0nix\n§7GitHub: §6github.com/str0nixofficial");
		          } else {
		
		          }
		      break;
		  }

        return true;
    }

    public function onVoidLoop(PlayerMoveEvent $event){
        if($event->getTo()->getFloorY() < 2){
            $player = $event->getPlayer();
            $player->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
            $player->sendMessage("§6You fell out from the world.");
            $player->getInventory()->clearAll();
            $player->getArmorInventory()->clearAll();
        }
    }
}
