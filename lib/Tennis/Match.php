<?php

namespace Tennis;

/**
 * Tennis match counter
 */
class Match
{
    const PLAYER_1 = 1;
    const PLAYER_2 = 2;

    /* current game */
    protected $advantage = false;
    protected $score;

    /* current set */
    protected $wonGame;

    /* current match */
    protected $wonSet;

    public function __construct()
    {
        $this->initGame();
        $this->wonGame = array(self::PLAYER_1 => 0, self::PLAYER_2 => 0);
        $this->wonSet = array(self::PLAYER_1 => 0, self::PLAYER_2 => 0);
    }

    public function getAdvantage()
    {
        return $this->advantage;
    }

    public function isEquality()
    {
        return  $this->getScorePlayer1() === 40 &&
                $this->getScorePlayer2() === 40 &&
                !$this->getAdvantage();
    }

    public function getScorePlayer1()
    {
        return $this->getScore(self::PLAYER_1);
    }

    public function getScorePlayer2()
    {
        return $this->getScore(self::PLAYER_2);
    }

    public function getScore($player)
    {
        $this->ensureValidPlayer($player);
        return $this->score[$player];
    }

    public function getWonGamePlayer1()
    {
        return $this->getWonGame(self::PLAYER_1);
    }

    public function getWonGamePlayer2()
    {
        return $this->getWonGame(self::PLAYER_2);
    }

    public function getWonGame($player)
    {
        $this->ensureValidPlayer($player);
        return $this->wonGame[$player];
    }

    public function getWonSetPlayer1()
    {
        return $this->getWonSet(self::PLAYER_1);
    }

    public function getWonSetPlayer2()
    {
        return $this->getWonSet(self::PLAYER_2);
    }

    public function getWonSet($player)
    {
        $this->ensureValidPlayer($player);
        return $this->wonSet[$player];
    }

    protected function ensureValidPlayer($player)
    {
        $valid = in_array($player, array(self::PLAYER_1, self::PLAYER_2));
        if (!$valid) {
            throw new \InvalidArgumentException('invalid player');
        }

        return $this;
    }

    public function score($player)
    {
        $score = $this->getScore($player);
        $advantage = $this->getAdvantage();
        $equality = $this->isEquality();
        if ($score < 30) {
            $this->score[$player] += 15;
        } else if ($score === 30) {
            $this->score[$player] += 10;
        } else if ($advantage && $player !== $advantage) {
            $this->advantage = false;
        } else if($equality) {
            $this->advantage = $player;
        } else {
            $this->playerWinGame($player);
        }
    }

    protected function playerWinGame($player)
    {
        $this->wonGame[$player] += 1;
        $this->initGame();
    }

    protected function initGame()
    {
        $this->score = array(self::PLAYER_1 => 0, self::PLAYER_2 => 0);
    }
}
