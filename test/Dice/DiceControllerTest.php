<?php

namespace Gufo\Dice;

use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceControllerTest extends TestCase
{

    private $controller;
    private $app;
    
    protected function setUp() : void
    {
        global $di;
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $this->app = $di;
        $di->set("app", $this->app);

        $this->controller = new DiceController();
        $this->controller->setApp($this->app);
        // $this->controller->initialize();
    }

    /**
     * check index action
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertIsString($res);
        $this->assertContains("Index!!!", $res);
    }

    /**
     * check Init action
     */
    public function testInitAction()
    {
        $res = $this->controller->initAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * check play action
     */
    public function testPlayAction()
    {
        $this->app->session->set('dice', new Game(2, 2));
        
        $res = $this->controller->playAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * check process action with setup
     */
    public function testProcessActionSetup()
    {
        $this->app->request->setPost('setup', 'hej');
        $this->app->request->setPost('players', 2);
        $this->app->request->setPost('dices', 2);
        
        $res = $this->controller->processAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * check process action with reset
     */
    public function testProcessActionReset()
    {
        $this->app->request->setPost('reset', 'hej');
        $this->app->session->set('playersv2', 2);
        $this->app->session->set('dicesv2', 2);
        
        $res = $this->controller->processAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * check process action with roll
     */
    public function testProcessActionRoll()
    {
        $this->app->request->setPost('roll', 'hej');
        $this->app->session->set('dice', new Game(2, 2));
        
        $res = $this->controller->processAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * check check process action with save
     */
    public function testProcessActionSave()
    {
        $this->app->request->setPost('save', 'hej');
        $this->app->session->set('dice', new Game(2, 2));
        
        $res = $this->controller->processAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
