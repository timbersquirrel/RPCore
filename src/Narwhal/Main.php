<?php

namespace Narwhal;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat as c;
use pocetmine\server;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent ;
use pocketmine\level\Position;

class Main extends PluginBase implements Listener{
	
	public $prefix = (c::AQUA . "[" . c::GREEN . "RPNetwork" . c::AQUA . "] ");
	public $noperm = (c::RED . "|You don't have permission to use this command!|.");
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(c::GREEN .  "enabled!");
	}
	public function onDisable(){
		$this->getLogger()->info(c::RED . "disabled!");
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
    switch(strtolower($command->getName())){
        case "smsg":
            if(isset($args[0]) && isset($args[1])) {
                $player = $this->getServer()->getPlayer($args[0]);
                $message = array_splice($args, 1, 99999);
                $message_send = implode(" ", $message);
                if($player) {
                    $player->sendMessage($message_send);
                } else {
                    $sender->sendMessage("§cThat player is not online!");
                }
            } else {
                    $sender->sendMessage("§cUsage: /smsg <player> <message>");
            }
        break;
        case "info":
            	$infomsg = c::RED . c::BOLD . "Info message is not ready yet!";
            	$sender->addTitle(" ", $infomsg,-1, 5*20, 30);
        break;
    }
    return true;
}
	public function onJoin(PlayerJoinEvent $e){
		//Define stuff.
		$player = $e->getPlayer();
		$level = $this->getServer()->getDefaultLevel();
		$x = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getX();
		$y = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getY();
		$z = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getZ();
		$sppos = new Position($x, $y, $z, $level);
		
		//Action.
		$player->setLevel($level);
		$player->teleport($sppos);
		
		//Title.
		$task = new Task($this, $player->getName());
		$this->getServer()->getScheduler()->scheduleDelayedTask($task, 5*20);
	}
}
