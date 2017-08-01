<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 17.27.3
 * Time: 21:54
 */

namespace factions\command;


use dominate\Command;
use dominate\parameter\Parameter;
use factions\command\parameter\FactionParameter;
use factions\command\parameter\MemberParameter;
use localizer\Localizer;
use pocketmine\command\CommandSender;

class PowerSet extends Command {

    public function setup() {
        $fp = new FactionParameter("target");
        $mp = new MemberParameter("member|faction");
        $this->addParameter($mp->setNext($fp));
        $this->addParameter(new Parameter("amount", Parameter::TYPE_INTEGER));
    }

    public function perform(CommandSender $sender, string $label, array $args) :bool
    {
        $target = $this->getArgument(0);
        $amount = $this->getArgument(1);

        $target->setPowerBoost($amount);
        $sender->sendMessage(Localizer::trans("power-set", [
            "power-boost" => $target->getPowerBoost(),
            "target" => $target->getDisplayName()
        ]));
    }

}
