<?php
/*
 *   FactionsPE: PocketMine-MP Plugin
 *   Copyright (C) 2016  Chris Prime
 *
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace factions\command;

use dominate\Command;
use dominate\parameter\Parameter;
use dominate\requirement\SimpleRequirement;
use factions\command\requirement\FactionPermission;
use factions\command\requirement\FactionRequirement;
use factions\FactionsPE;
use factions\manager\Members;
use factions\manager\Permissions;
use factions\permission\Permission;
use factions\utils\Gameplay;
use localizer\Localizer;
use pocketmine\command\CommandSender;

class Withdraw extends Command
{

    public function setup()
    {
        $this->addParameter(new Parameter("amount", Parameter::TYPE_INTEGER));
        //$this->addParameter((new FactionParameter("faction"))->setDefaultValue("self")->setPermission(Permissions::MONEY_BALANCE_ANY));

        $this->addRequirement(new SimpleRequirement(SimpleRequirement::PLAYER));
        $this->addRequirement(new FactionRequirement(FactionRequirement::IN_FACTION));
        $this->addRequirement(new FactionPermission(Permissions::getById(Permission::WITHDRAW)));
    }

    public function perform(CommandSender $sender, string $label, array $args) :bool
    {
        $faction = Members::get($sender)->getFaction();
        $amount = $this->getArgument(0);

        // Validate amount
        if ($amount < 0) {
            return "withdraw-negative";
        }
        if ($amount > $faction->getBank()) {
            return "faction-not-enough-money";
        }

        if (Gameplay::get("log.money-transactions", true)) {
            FactionsPE::get()->getLogger()->notice(Localizer::trans("log.money-withdraw", [
                "faction" => $faction->getName(),
                "amount" => $amount,
                "player" => $sender->getName()
            ]));
        }

        $faction->addToBank(-$amount);
        FactionsPE::get()->getEconomy()->addMoney($sender->getName(), $amount);
        return ["faction-withdraw", compact("amount")];
    }

}
