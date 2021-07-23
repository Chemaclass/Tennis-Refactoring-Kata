<?php

declare(strict_types=1);

namespace TennisGame;

final class TennisGame1 implements TennisGame
{
    const GAME_POINT = 4;
    private int $player1Score = 0;
    private int $player2Score = 0;
    private string $player1Name;
    private string $player2Name;

    public function __construct(string $player1Name, string $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function wonPoint(string $playerName): void
    {
        if ($this->player1Name === $playerName) {
            $this->player1Score++;
        }
        if ($this->player2Name === $playerName) {
            $this->player2Score++;
        }
    }

    public function getScore(): string
    {
        if ($this->isDrawScore()) {
            return $this->getDrawScore();
        }

        if ($this->isGamePoint()) {
            return $this->getGameScore();
        }

        return $this->getDefaultScore();
    }

    private function getDrawScore(): string
    {
        return match ($this->player1Score) {
            0 => "Love-All",
            1 => "Fifteen-All",
            2 => "Thirty-All",
            default => "Deuce",
        };
    }

    private function getGameScore(): string
    {
        $minusResult = $this->player1Score - $this->player2Score;
        if ($minusResult === 1) {
            return "Advantage {$this->player1Name}";
        }

        if ($minusResult === -1) {
            return "Advantage {$this->player2Name}";
        }

        if ($minusResult >= 2) {
            return "Win for {$this->player1Name}";
        }

        return "Win for {$this->player2Name}";
    }

    private function getDefaultScore(): string
    {
        return $this->getScoreCall($this->player1Score) . '-' . $this->getScoreCall($this->player2Score);
    }

    private function isGamePoint(): bool
    {
        return $this->player1Score >= self::GAME_POINT || $this->player2Score >= self::GAME_POINT;
    }

    private function isDrawScore(): bool
    {
        return $this->player1Score === $this->player2Score;
    }

    private function getScoreCall(int $tempScore): string
    {
        return match ($tempScore) {
            0 => "Love",
            1 => "Fifteen",
            2 => "Thirty",
            3 => "Forty",
        };
    }
}
