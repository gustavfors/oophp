<?php

namespace Gufo\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;
    
    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";

    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "Index!!!";
    }

    public function initAction()
    {
        $title = "setup";

        $this->app->page->add("dice/setup");
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function playAction()
    {
        $title = "play";

        $this->app->page->add("dice/play");
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function processAction()
    {
        // if (isset($_POST['setup'])) {
        if ($this->app->request->getPost('setup') != null) {
            $this->app->session->set('playersv2', $this->app->request->getPost('players'));
            // $this->app->session->set('dicesv2', (int)$_POST['dices']);
            $this->app->session->set('dicesv2', (int)$this->app->request->getPost('dices'));
            $this->app->session->set('dice', new Game(
                $this->app->session->get('playersv2'),
                $this->app->session->get('dicesv2')
            ));
            // $_SESSION['playersv2'] = 2;
            // $_SESSION['dicesv2'] = (int)$_POST['dices'];

            // $_SESSION['dice'] = new Game($_SESSION['playersv2'], $_SESSION['dicesv2']);

            return $this->app->response->redirect("dicev2/play");
        }

        // if (isset($_POST['reset'])) {
        if ($this->app->request->getPost('reset') != null) {
            // $_SESSION['dice'] = new Game($_SESSION['playersv2'], $_SESSION['dicesv2']);
            $this->app->session->set('dice', new Game(
                $this->app->session->get('playersv2'),
                $this->app->session->get('dicesv2')
            ));

            return $this->app->response->redirect("dicev2/play");
        }

        // if (isset($_POST['roll'])) {
        if ($this->app->request->getPost('roll') != null) {
            // $_SESSION['dice']->rollDices();
            $this->app->session->get('dice')->rollDices();
            return $this->app->response->redirect("dicev2/play");
        }

        // if (isset($_POST['save'])) {
        if ($this->app->request->getPost('save') != null) {
            // $_SESSION['dice']->endTurn();
            // $_SESSION['dice']->aiPlay();
            $this->app->session->get('dice')->endTurn();
            $this->app->session->get('dice')->aiPlay();
            return $this->app->response->redirect("dicev2/play");
        }
    }
}
