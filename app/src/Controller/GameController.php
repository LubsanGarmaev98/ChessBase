<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use App\Service\LiClient;
use GuzzleHttp\Exception\GuzzleException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class GameController extends WithAuthorizationController
{
    //to do
    private UserRepository $userRepository;
    private GameRepository $gameRepository;
    private LiClient $liClient;

    public function __construct(UserRepository $userRepository, GameRepository $gameRepository, LiClient $liClient)
    {
        $this->userRepository   = $userRepository;
        $this->gameRepository   = $gameRepository;
        $this->liClient         = $liClient;
    }

    /**
     * @throws GuzzleException
     */
    public function showGame(Request $request, Response $response)
    {
        $user = $this->authorization($request);
        if($user === null)
        {
            $response->getBody()->write("Token entered incorrectly");

            return $response
                ->withStatus(422);
        }

        try {
            $games = $this->liClient->getGames($user->getLichessname());
        }catch (GuzzleException $exception)
        {

            $response->getBody()->write("Ошибка сервера: " . $exception->getMessage());
            return $response->withStatus(500);
        }

        $game = new Game(
            $user,
            $games['players']['white']['user']['name'],
            $games['players']['black']['user']['name'],
            $games['winner'],
            $games['players']['white']['rating'],
            $games['players']['black']['rating'],
            $games['speed'],
            $games['moves']
        );

        $this->gameRepository->add($game, true);

        $response->getBody()->write("Поздравляю, партии сохранены!");
        return $response
            ->withStatus(201);
    }

    protected function getUserRepository(): UserRepository
    {
        return $this->userRepository;
    }
}