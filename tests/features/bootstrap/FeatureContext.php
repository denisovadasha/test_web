<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use DMore\ChromeDriver\ChromeDriver;
use Behat\Mink\Driver\DriverInterface;
/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am on index page"\/"
     */
    public function iAmOnIndexPage()
    {
	    // Choose a Mink driver. More about it in later chapters.
//	    $driver = new \Behat\Mink\Driver\GoutteDriver();
//
//	    $session = new \Behat\Mink\Session($driver);
//	    $session->start();
//
//	    $page = $session->getPage();

	    $url = 'http://yandex.ru';
		$cDriver = new ChromeDriver(
			'http://localhost:9222',
			null,
			'http://www.google.com');
		$ffDriver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
	    $mink = new \Behat\Mink\Mink(array(
		    'chrome' => new \Behat\Mink\Session($cDriver),
		    'firefox' => new \Behat\Mink\Session($ffDriver),
	    ));

	    $mink->getSession('firefox')->visit($url);
	    $page = $mink->getSession('firefox')->getPage();
	    if (!$page) throw new PendingException('The page doesn`t exist');
    }

    /**
     * @Then I should see full name
     */
    public function iShouldSeeFullName()
    {
	    $mink = new \Behat\Mink\Mink(array(
		    'chrome' => new \Behat\Mink\Session(new ChromeDriver('http://localhost:9222', null, 'http://www.google.com', ['downloadBehavior' => 'allow', 'downloadPath' => '/tmp/'])),
	    ));

	    $mink->getSession('chrome')->visit($url);
	    $page = $mink->getSession('chrome')->getPage();
//	    $html = $page->getContent();

//	    $client = new \Goutte\Client('chrome');
//	    $driver = new \Behat\Mink\Driver\GoutteDriver($client);
//
//	    $session = new \Behat\Mink\Session($driver);
//	    $session->start();

//	    $page = $session->getPage();

	    $name = $page->find('css', 'form.register');

	    $nameVisibility = $name->isVisible();

	    if(!$nameVisibility) throw new PendingException('Name isn`t visible');
    }
}
