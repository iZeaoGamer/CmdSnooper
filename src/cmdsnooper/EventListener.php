<?php

namespace cmdsnooper;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use cmdsnooper\CmdSnooper;

class EventListener implements Listener {
	public $plugin;
	
	public function __construct(CmdSnooper $plugin) {
		$this->plugin = $plugin;
	}

	public function getPlugin() {
		return $this->plugin;
	}
	
	public function onPlayerCmd(PlayerCommandPreprocessEvent $event) {
		$sender = $event->getPlayer();
		$msg = $event->getMessage();
		
		if($this->getPlugin()->cfg->get("Console.Logger") == "true") {
			if($msg[0] == "/") {
				if(stripos($msg, "login") || stripos($msg, "reg") || stripos($msg, "register")) {
					$this->getPlugin()->getLogger()->info($sender->getName() . "§c: hidden for security reasons");	
				} else {
					$this->getPlugin()->getLogger()->info($sender->getName() . "§a: §b " . $msg);
				}
				
			}
		}
			
			if(!empty($this->getPlugin()->snoopers)) {
				foreach($this->getPlugin()->snoopers as $snooper) {
					 if($msg[0] == "/") {
						if(stripos($msg, "login") || stripos($msg, "reg") || stripos($msg, "register")) {
							$snooper->sendMessage("§7[§6Social§eSpy§7] §5" . $sender->getName() . "§c: hidden for security reasons");	
						} else {
							$snooper->sendMessage("§7[§6Social§eSpy§7] §5" . $sender->getName() . "§a: §b" . $msg);
						}
						
					}
	     			}		
     			}
   		}
	}
