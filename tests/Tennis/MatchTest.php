<?php

namespace Tests\Tennis\Match;

class MatchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Dans un nouveau jeu, le score est 0-0.
     */
    public function testNewGameStartWithLoveLove()
    {
        $match = $this->getNewMatch();
        $this->assertEquals(0, $match->getScorePlayer1());
        $this->assertEquals(0, $match->getScorePlayer2());
    }

    /**
     * Dans un nouveau jeu, quand un joueur marque quatre fois de suite, ce joueur gagne le jeu.
     * @dataProvider playerProvider
     */
    public function test4BallsInARow($player)
    {
        $match = $this->getNewMatch();

        for ($i = 0 ; $i <4 ; $i++) {
            $match->score($player);
        }

        $this->assertEquals(1, $match->getWonSet($player));
    }

    /**
     * Dans un jeu avec un joueur à 0, quand ce joueur marque, ce joueur a un score de 15.
     * @dataProvider playerProvider
     */
    public function testFirstMarkIs15($player)
    {
        $match = $this->getMatchWithScore(0, $player);

        $match->score($player);

        $this->assertEquals(15, $match->getScore($player));
    }

    /**
     * Dans un jeu avec un joueur à 15, quand ce joueur marque, ce joueur a un score de 30.
     * @dataProvider playerProvider
     */
    public function testSecondMarkIs30($player)
    {
        $match = $this->getMatchWithScore(15, $player);

         $match->score($player);

        $this->assertEquals(30, $match->getScore($player));
    }

    /**
     * Dans un jeu avec un joueur à 30, quand ce joueur marque, ce joueur a un score de 40.
     * @dataProvider playerProvider
     */
    public function testThirdMarkIs40($player)
    {
        $match = $this->getMatchWithScore(30, $player);

        $match->score($player);

        $this->assertEquals(40, $match->getScore($player));
    }

    /**
     * Dans un jeu avec un joueur ayant l'avantage, quand l'autre joueur marque, il y a egalité.
     * @dataProvider playerProvider
     */
    public function testPlayerLosesAdvantage($player, $otherPlayer)
    {
        $match = $this->getMatchWithAdvantage($otherPlayer);

        $match->score($player);

        $this->assertTrue($match->isEquality());
    }

    /**
     * Dans un jeu avec un joueur ayant l'avantage, quand ce joueur marque, ce joueur gagne le jeu.
     * @dataProvider playerProvider
     */
    public function testWinWhenHasAdvantageAndScore($player, $otherPlayer)
    {
        $match = $this->getMatchWithAdvantage($player);

        $match->score($player);

        $this->assertEquals(1, $match->getWonSet($player));
    }

    /**
     * Dans un jeu avec deux joueur à égalité, quandun joueur marque, ce joueur a l'avantage.
     * @dataProvider playerProvider
     */
    public function testWhenEqualityMarkGivesAdvantage($player, $otherPlayer)
    {
        $match = $this->getMatchWithAdvantage(false);

        $match->score($player);

        $this->assertEquals($player, $match->getAdvantage());
    }

    public function playerProvider()
    {
        return array(
           'player 1' => array(\Tennis\Match::PLAYER_1, \Tennis\Match::PLAYER_2),
           'player 2'  => array(\Tennis\Match::PLAYER_2, \Tennis\Match::PLAYER_1));
    }

    protected function getNewMatch()
    {
        return new \Tennis\Match();
    }

    protected function getMatchWithScore($score, $player)
    {
        $match = new MockMatch(array($player => $score));
        return $match;
    }

    protected function getMatchWithAdvantage($advantage)
    {
        $match = new MockMatch(array(
                \Tennis\Match::PLAYER_1 => 40,
                \Tennis\Match::PLAYER_2 => 40
            ), $advantage);
        return $match;
    }
}

class MockMatch extends \Tennis\Match
{
    public function __construct($score = array(), $advantage = false)
    {
        parent::__construct();
        foreach ($score as $player => $points) {
            $this->score[$player] = $points;
        }
        $this->advantage = $advantage;
    }
}
