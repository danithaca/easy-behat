<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements SnippetAcceptingContext
{

    protected $screenshotsPath;
    protected $javascriptResult;

    static protected $sessionTimestamp;
    static protected $suite;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $logfiles_path = self::$suite->hasSetting('logfiles_path') ? self::$suite->getSetting('logfiles_path') : '.';
        $this->screenshotsPath = $logfiles_path . DIRECTORY_SEPARATOR . 'screenshots';
    }

    /**
     * @BeforeFeature
     */
    public static function beforeFeature() {
        
    }

    /**
     * @BeforeSuite
     */
    public static function prepare(BeforeSuiteScope $scope)
    {
        self::$sessionTimestamp = time();
        self::$suite = $scope->getSuite();
    }

    /**
     * @AfterSuite
     */
    public static function wrapUp(AfterSuiteScope $scope)
    {
        // do something
    }

    /**
     * Pauses the scenario until the user presses a key. Useful when debugging a scenario.
     *
     * @Then (I )break
     */
    public function breakPoint()
    {
        fwrite(STDOUT, "\033[s \033[93m[Breakpoint] Press \033[1;93m[RETURN]\033[0;93m to continue...\033[0m");
        while (fgets(STDIN, 1024) == '') {
        }
        fwrite(STDOUT, "\033[u");
        return;
    }

    protected function _saveFile($raw_filename, $content)
    {
        $raw_filename = $raw_filename ?: sprintf('%s_%s.%s', date('c'), uniqid('', true), 'png');
        if ($this->screenshotsPath && !file_exists($this->screenshotsPath)) {
            mkdir($this->screenshotsPath);
        }
        $raw_pathname = $this->screenshotsPath . DIRECTORY_SEPARATOR . date('Y-m-d') . '-' . self::$sessionTimestamp;
        if (!file_exists($raw_pathname)) {
            mkdir($raw_pathname);
        }
        $filename = $raw_pathname . DIRECTORY_SEPARATOR . $raw_filename;
        file_put_contents($filename, $content);
    }

    /**
     * @Then /^take a screenshot$/
     */
    public function takeScreenshot($raw_filename = null)
    {
        $raw_filename = $raw_filename ?: sprintf('%s_%s_%s.%s', $this->getMinkParameter('browser_name'), date('c'), uniqid('', true), 'png');
        $this->_saveFile($raw_filename, $this->getSession()->getScreenshot());
    }

    /**
     * @Then /^save last response$/
     */
    public function savePage($raw_filename = null)
    {
        $raw_filename = $raw_filename ?: sprintf('page_%s_%s.%s', date('c'), uniqid('', true), 'html');
        $this->_saveFile($raw_filename, $this->getSession()->getPage()->getContent());
    }

    /**
     * @AfterStep
     */
    public function takeScreenshotAfterFailedStep(AfterStepScope $scope)
    {
        if (99 === $scope->getTestResult()->getResultCode()) {
            $raw_filename_prefix = sprintf('%s_%s_%d_%s', date('His'), preg_replace('/\W+/', '', $scope->getFeature()->getTitle()), $scope->getStep()->getLine(), preg_replace('/\W+/', '', $scope->getStep()->getText()));
            try {
                $raw_filename = sprintf('%s_%s.png', $raw_filename_prefix, $this->getMinkParameter('browser_name'));
                $this->takeScreenshot($raw_filename);
            } catch (UnsupportedDriverActionException $e) {
                $raw_filename = sprintf('%s_page.html', $raw_filename_prefix);
                $this->savePage($raw_filename);
            }
        }
    }

    /**
     * @Then print the setting :key
     */
    public function printSetting($key)
    {
        if (self::$suite->hasSetting($key)) {
            print_r(self::$suite->getSetting($key));
        } else {
            echo "Key '$key' not found in settings.";
        }
    }

    /**
     * @Then /^pause (?P<seconds>\d+) second(s?)$/
     */
    public function pauseSeconds($seconds)
    {
        sleep($seconds);
    }

    /**
     * @When I run the following Javascript:
     */
    public function runLongJavascript(PyStringNode $jsBlock)
    {
        // $this->getSession()->executeScript() only execute a single line of code.
        // we'll preprocess it to allow multiple lines of execution
        $js = $jsBlock->getRaw();
        $js = "(function () {\n  $js  \n})();";
        $this->getSession()->executeScript($js);

        // wait 1 second for selenium to catch up on the browser side.
        $this->pauseSeconds(1);
        $this->getSession()->wait(500, 'false');
    }

    /**
     * @When I evaluate the following Javascript:
     */
    public function evaluateLongJavascript(PyStringNode $jsBlock)
    {
        // $this->getSession()->executeScript() only execute a single line of code.
        // we'll preprocess it to allow multiple lines of execution
        $js = $jsBlock->getRaw();
        $this->javascriptResult = $this->getSession()->evaluateScript($js);
    }

    /**
     * @Then check Javascript result is true
     */
    public function checkJavascriptResultBoolean()
    {
        if (!$this->javascriptResult) {
            throw new Exception("Javascript is not true.");
        }
    }


    /**
     * @Then the :element element is hidden
     */
    public function checkElementHidden($element)
    {
        $js = "return $(\"{$element}\").is(':hidden');";
        if (!$this->getSession()->evaluateScript($js)) {
            throw new Exception("Element {$element} is not hidden.");
        }
    }


    /**
     * @When I click the :element element
     */
    public function clickElement($element)
    {
        $this->assertElementOnPage($element);
        $this->forceClickElement($element);
    }


    /**
     * @When I arbitrarily click the :element element
     */
    public function forceClickElement($element)
    {
        $snippet = "document.querySelector(\"{$element}\").click();";
        $js = "(function () {\n  $snippet  \n})();";
        $this->getSession()->executeScript($js);
        // wait 1 second for selenium to catch up on the browser side.
        $this->pauseSeconds(1);
        $this->getSession()->wait(500, 'false');
    }

    /**
     * @Given /^I set browser window size to "([^"]*)" x "([^"]*)"$/
     *
     * Eg: I set browser window size to "1280" x "600"
     */
    public function setBrowserWindowSizeToX($width, $height)
    {
        $this->getSession()->resizeWindow((int)$width, (int)$height, 'current');
    }


    /**
     * @Given I set browser mobile
     */
    public function setBrowserMobileSize()
    {
        $this->setBrowserWindowSizeToX(360, 720);
    }

    /**
     * @Then print console log
     */
    public function printConsoleLog()
    {
        print_r($this->getSession()->getDriver()->getWebDriverSession()->log("browser"));
    }

}