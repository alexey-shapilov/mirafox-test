<?php

    use MirafoxTest\Models\Team;

    require_once __DIR__ . '/vendor/autoload.php';
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/data.php';

    \MirafoxTest\Repository\TeamsRepository::getInstance($data);

    /**
     * @param $teamIndex1
     * @param $teamIndex2
     *
     * @return array
     */
    function match($teamIndex1, $teamIndex2) {
        $teamsRepository = \MirafoxTest\Repository\TeamsRepository::getInstance();

        $team1 = $teamsRepository->getTeam($teamIndex1);
        $team2 = $teamsRepository->getTeam($teamIndex2);

        $scores = [];

        if (isset($team1, $team2)) {
            $team1Power = $team1->getPower();
            $team2Power = $team2->getPower();

            $team1Probability = new \MirafoxTest\Models\Probability($team1Power, $team2Power);
            $team2Probability = new \MirafoxTest\Models\Probability($team2Power, $team1Power);

            $isDraw = false;
            $isWinFirst = false;

            if (abs($delta = $team1Probability->getProbability()->win - $team2Probability->getProbability()->win) >= DELTA_WIN) {
                $teamWin = null;
                $teamDefeat = null;

                if ($delta < 0) {
                    $teamWin = $team2;
                    $teamDefeat = $team1;
                } else {
                    $isWinFirst = true;
                    $teamWin = $team1;
                    $teamDefeat = $team2;
                }

                $winScored = mt_rand(1, ceil($teamWin->getAverageGoalsScored()));
                $defeatScored = mt_rand(0, min($winScored - 1, $teamDefeat->getAverageGoalsScored()));

                $scores = [
                    $isWinFirst ? $winScored : $defeatScored,
                    $isWinFirst ? $defeatScored : $winScored,
                ];
            } else {
                $team1Scored = mt_rand(0, $team1->getAverageGoalsScored());
                $team2Scored = mt_rand(0, $team2->getAverageGoalsScored());

                $scores = [$team1Scored, $team2Scored];

                if ($team1Scored > $team2Scored) {
                    $isWinFirst = true;
                } elseif ($team1Scored == $team2Scored) {
                    $isDraw = true;
                }
            }

            if ($isDraw) {
                addDraw($team1, $team2, $scores);
            } else {
                addResult(
                    $isWinFirst ? $team1 : $team2,
                    $isWinFirst ? $team2 : $team1,
                    $scores
                );
            }
        }

        return $scores;
    }

    /**
     * @param Team $team1
     * @param Team $team2
     * @param array $scores
     */
    function addDraw($team1, $team2, $scores) {
        $team1->addDraw();
        $team1->addGoalsScored($scores[0]);
        $team1->addGoalsSkiped($scores[1]);

        $team2->addDraw();
        $team2->addGoalsScored($scores[1]);
        $team2->addGoalsSkiped($scores[0]);
    }

    /**
     * @param Team $team1
     * @param Team $team2
     * @param array $scores
     */
    function addResult($team1, $team2, $scores) {
        $team1->addWin();
        $team1->addGoalsScored($scores[0]);
        $team1->addGoalsSkiped($scores[1]);

        $team2->addDefeat();
        $team2->addGoalsScored($scores[1]);
        $team2->addGoalsSkiped($scores[0]);
    }