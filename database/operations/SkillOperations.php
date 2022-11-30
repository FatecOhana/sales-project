<?php

include_once (__DIR__ . "/../configuration/DatabaseConfiguration.php");

class SkillOperations
{

    public static function registerSkills(array $skills = null): array
    {
        try {
            if (!isset($skills) || !is_array($skills)) {
                return array();
            }

            $results = array();
            foreach ($skills as &$item) {
                $results[] = self::registerSkill($item);
            }

            return $results;
        } catch (Exception $ex) {
            return array();
        }
    }

    public static function registerSkill(Skill $skill): ?Skill
    {
        try {
            $existInDatabase= self::fetchSkill($skill);
            if (is_array($existInDatabase)) {
                return Skill::create()->setName($existInDatabase[0]["name"])->setId($existInDatabase[0]["id"]);
            }

            $connection = DatabaseConfiguration::openConnection();
            $sql_command = $connection->prepare("INSERT INTO skill(name) VALUE (?)");

            $inserted = $sql_command->execute(array($skill->getName()));
            if (is_bool($inserted) && $inserted) {
                $lastInsertedID = $connection->lastInsertId();
                $skill->setId($lastInsertedID);
                return $skill;
            } else {
                // Item not inserted
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public static function fetchSkill(Skill $skill = null): ?array
    {
        try {
            $connection = DatabaseConfiguration::openConnection();

            // Prepara a Query SQL
            $sql_command = "";
            if (is_null($skill)) {
                $sql_command = $connection->prepare("SELECT * FROM skill");
                $sql_command->execute();
            } else {
                if (!is_null($skill->getName())) {
                    $sql_command = $connection->prepare("SELECT * FROM skill WHERE name=?");
                    $sql_command->execute([$skill->getName()]);
                }
            }

            $result = array();
            while ($row = $sql_command->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }

            if (!$result) {
                return null;
            }
            return $result;
        } catch (Exception $ex) {
            return null;
        }
    }

}
