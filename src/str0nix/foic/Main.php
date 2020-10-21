<?php

/* This plugin written by str0nix */
/* GitHub: https://github.com/str0nixofficial */
/* Twitter: https://twitter.com/str0nix */

namespace str0nix\foic;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\entity\Entity;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\ConsoleCommandExecutor;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

    public function onLoad() : void {
        if($this->getConfig()->get("console_messages") === true){
            $this->getLogger()->info("Plugin loading");
        }
    }

    public function onEnable() : void {
	     $this->getServer()->getPluginManager()->registerEvents($this, $this);
         $this->saveDefaultConfig();
         if($this->getConfig()->get("console_messages") === true){
            $this->getLogger()->info("Plugin enabled");
         }
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{

        switch($command->getName()){

            case "foic":
                if(!$sender instanceof Player){
                    $sender->sendMessage("§7Plugin written by: §6str0nix\n§7GitHub: §6https://github.com/str0nixofficial\n§7Plugin version:§6 1.1.1");
                } else {
                    $sender->sendMessage("§7Plugin written by: §6str0nix\n§7GitHub: §6https://github.com/str0nixofficial\n§7Plugin version:§6 1.1.1");
                }

                return true;
            
            break;
        }
    }
/*yucky laggy code
    public function onVoidLoop(PlayerMoveEvent $event){

        if($event->getTo()->getFloorY() < 2){
            $player = $event->getPlayer();
            $player->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
            $player->sendMessage($this->getConfig()->get("message"));
            if($this->getConfig()->get("inventory_clear") === true){
                $player->getInventory()->clearAll();
                $player->getArmorInventory()->clearAll();
            }
        }
    }
    */
    	public function onDamage(EntityDamageEvent $event) {
		$player = $event->getEntity();//Register Player as Entity Getting Damaged
		if(!$player instanceof Player) {//Check If The Player Is A Human
			return;
		}
		if($event->getCause() === EntityDamageEvent::CAUSE_VOID) {//If The Damage Cause Is Void
			$event->setCancelled();//Cancel Event
			$player->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());//Tp Player To Safest Spawn
                        $player->sendMessage($this->getConfig()->get("message"));//Msg
                        if ($this->getConfig()->get("inventory_clear") === true) {//Check For Inventory Clear In Config
                		$player->getInventory()->clearAll();//Clear Inv
                		$player->getArmorInventory()->clearAll();//Clear Armor
            		}
		}
	}
}
