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
use factions\command\requirement\FactionRequirement;
use factions\command\requirement\FactionRole;
use factions\flag\Flag;
use factions\manager\Members;
use factions\relation\Relation;
use localizer\Localizer;
use pocketmine\command\CommandSender;

class Close extends Command
{

    public function setup()
    {
        $this->addRequirement(new FactionRequirement(FactionRequirement::IN_FACTION));
        $this->addRequirement(new FactionRole(Relation::LEADER));
    }

    public function perform(CommandSender $sender, string $label, array $args) :bool
    {
        $msender = Members::get($sender);
        $faction = $msender->getFaction();
        if (!$faction->getFlag(Flag::OPEN)) {
            $sender->sendMessage(Localizer::translatable("faction-already-closed"));
            return true;
        }
        $faction->setFlag(Flag::OPEN, false);
        $sender->sendMessage(Localizer::translatable("faction-closed"));
        return true;
    }

}
