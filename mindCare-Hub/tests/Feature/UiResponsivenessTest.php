<?php

namespace Tests\Feature;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverDimension;
use Facebook\WebDriver\WebDriverBy;
use Tests\TestCase;

class UiResponsivenessTest extends TestCase
{
    protected $driver;

    protected function setUp(): void
    {
        parent::setUp();
        $host = 'http://127.0.0.1:4444'; // Selenium server
        $this->driver = RemoteWebDriver::create($host, DesiredCapabilities::microsoftEdge());
    }

    /** @test */
    public function it_checks_homepage_responsiveness()
    {
        $this->driver->get('http://127.0.0.1:8000');

        $devices = [
            'desktop' => [1920, 1080],
            'tablet'  => [1024, 768],
            'mobile'  => [375, 812],
        ];

        foreach ($devices as $device => $size) {
            // Resize browser window
            $this->driver->manage()->window()->setSize(new WebDriverDimension($size[0], $size[1]));
            sleep(1);

            // Check Navbar exists
            $navbar = $this->driver->findElement(WebDriverBy::cssSelector('nav#mainNavbar'));
            $this->assertNotNull($navbar, "Navbar missing on {$device}");

            // Check Hero Section exists
            $hero = $this->driver->findElement(WebDriverBy::cssSelector('section'));
            $this->assertNotNull($hero, "Hero section missing on {$device}");

            // Check Features Section exists
            $features = $this->driver->findElement(WebDriverBy::xpath("//h2[contains(text(),'Our Features')]"));
            $this->assertNotNull($features, "Features section missing on {$device}");

            // Check Testimonials Section exists
            $testimonials = $this->driver->findElement(WebDriverBy::xpath("//h2[contains(text(),'What Our Users Say')]"));
            $this->assertNotNull($testimonials, "Testimonials section missing on {$device}");

            // Check Footer exists
            $footer = $this->driver->findElement(WebDriverBy::cssSelector('footer'));
            $this->assertNotNull($footer, "Footer missing on {$device}");

            // Take a screenshot for reference
            $this->driver->takeScreenshot(storage_path("app/screenshots/homepage_{$device}.png"));
        }
    }

    protected function tearDown(): void
    {
        $this->driver->quit();
        parent::tearDown();
    }
}
