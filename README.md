# easy-behat

Create vagrant VM environment to run Behat with selenium and firefox pre-installed.

Behat: http://docs.behat.org/en/v3.0/

## Installation

This package will install a VirtualBox VM, and therefore requires a VirtualBox environment. 

Use the following steps to create a VM with all the dependencies pre-installed.

1. Install vagrant from https://www.vagrantup.com/.
2. Go to the repo's root folder.
3. Run `vagrant up` to create the VM box. Vagrantfile script will get running and actually install the VM to VirtualBox.

You might want to create `local.yml` with the following settings to point test to your own DevDesktop. Otherwise it will use the default one in `behat.yml`, which is `http://localhost`.

```
default:
  extensions:
    Behat\MinkExtension:
      base_url: http://localhost
```


## Run Behat Test

Please make sure vagrant VM is up and running by using `vagrant up`. Then, login to vagrant VM using `vagrant ssh -- -X`. `-- -X` is to turn on X-Forward so that Firefox on the VM can display. Next, start the Selenium server and keep it running:

```
cd /vagrant
java -jar selenium.jar
```

Finally, to run Behat test case, open another vagrant session by using `vagrant ssh`. And then execute the following:

```
cd /vagrant
vendor/bin/behat 					# this is to run all test against your dev server
vendor/bin/behat --profile=test		# this is to run all test against test
vendor/bin/behat --profile=prod		# this is to run all test against prod
```

Test report can be found in logfiles/report folder (will be created after first run). If any step fails, you can see the screenshot under the logfiles folder.

If you have a test case that you don't want to add to the git repo, name the file as "*_local.feature". Those files are ignored by git.

If you don't need to look at Firefox, you might use the alternative "headless Firefox" approach: http://www.installationpage.com/selenium/how-to-run-selenium-headless-firefox-in-ubuntu/. In a nutshell, in vagrant session 1, run `sudo Xvfb :10 -ac` and keep it open. In vagrant session 2, run `export DISPLAY=:10; java -jar selenium.jar` and keep it open. Then run the Behat test. Using this approach, you don't need X-Forward to see Firefox -- Firefox is running on the "virtual" display on display port 10.


## Supported Directives

The following is the list of directives you can use in the test script (`*.feature` file). For more details about the Gherkins syntax, see http://docs.behat.org/en/v3.0/guides/1.gherkin.html

```
default |  Then (I )break
default |  Then /^take a screenshot$/
default |  Then /^save last response$/
default |  Then print the setting :key
default |  Then /^pause (?P<seconds>\d+) second(s?)$/
default |  When I run the following Javascript:
default |  When I evaluate the following Javascript:
default |  Then check Javascript result is true
default |  Then the :element element is hidden
default |  When I click the :element element
default |  When I arbitrarily click the :element element
default | Given /^I set browser window size to "([^"]*)" x "([^"]*)"$/
default | Given I set browser mobile
default | Given /^(?:|I )am on (?:|the )homepage$/
default |  When /^(?:|I )go to (?:|the )homepage$/
default | Given /^(?:|I )am on "(?P<page>[^"]+)"$/
default |  When /^(?:|I )go to "(?P<page>[^"]+)"$/
default |  When /^(?:|I )reload the page$/
default |  When /^(?:|I )move backward one page$/
default |  When /^(?:|I )move forward one page$/
default |  When /^(?:|I )press "(?P<button>(?:[^"]|\\")*)"$/
default |  When /^(?:|I )follow "(?P<link>(?:[^"]|\\")*)"$/
default |  When /^(?:|I )fill in "(?P<field>(?:[^"]|\\")*)" with "(?P<value>(?:[^"]|\\")*)"$/
default |  When /^(?:|I )fill in "(?P<field>(?:[^"]|\\")*)" with:$/
default |  When /^(?:|I )fill in "(?P<value>(?:[^"]|\\")*)" for "(?P<field>(?:[^"]|\\")*)"$/
default |  When /^(?:|I )fill in the following:$/
default |  When /^(?:|I )select "(?P<option>(?:[^"]|\\")*)" from "(?P<select>(?:[^"]|\\")*)"$/
default |  When /^(?:|I )additionally select "(?P<option>(?:[^"]|\\")*)" from "(?P<select>(?:[^"]|\\")*)"$/
default |  When /^(?:|I )check "(?P<option>(?:[^"]|\\")*)"$/
default |  When /^(?:|I )uncheck "(?P<option>(?:[^"]|\\")*)"$/
default |  When /^(?:|I )attach the file "(?P<path>[^"]*)" to "(?P<field>(?:[^"]|\\")*)"$/
default |  Then /^(?:|I )should be on "(?P<page>[^"]+)"$/
default |  Then /^(?:|I )should be on (?:|the )homepage$/
default |  Then /^the (?i)url(?-i) should match (?P<pattern>"(?:[^"]|\\")*")$/
default |  Then /^the response status code should be (?P<code>\d+)$/
default |  Then /^the response status code should not be (?P<code>\d+)$/
default |  Then /^(?:|I )should see "(?P<text>(?:[^"]|\\")*)"$/
default |  Then /^(?:|I )should not see "(?P<text>(?:[^"]|\\")*)"$/
default |  Then /^(?:|I )should see text matching (?P<pattern>"(?:[^"]|\\")*")$/
default |  Then /^(?:|I )should not see text matching (?P<pattern>"(?:[^"]|\\")*")$/
default |  Then /^the response should contain "(?P<text>(?:[^"]|\\")*)"$/
default |  Then /^the response should not contain "(?P<text>(?:[^"]|\\")*)"$/
default |  Then /^(?:|I )should see "(?P<text>(?:[^"]|\\")*)" in the "(?P<element>[^"]*)" element$/
default |  Then /^(?:|I )should not see "(?P<text>(?:[^"]|\\")*)" in the "(?P<element>[^"]*)" element$/
default |  Then /^the "(?P<element>[^"]*)" element should contain "(?P<value>(?:[^"]|\\")*)"$/
default |  Then /^the "(?P<element>[^"]*)" element should not contain "(?P<value>(?:[^"]|\\")*)"$/
default |  Then /^(?:|I )should see an? "(?P<element>[^"]*)" element$/
default |  Then /^(?:|I )should not see an? "(?P<element>[^"]*)" element$/
default |  Then /^the "(?P<field>(?:[^"]|\\")*)" field should contain "(?P<value>(?:[^"]|\\")*)"$/
default |  Then /^the "(?P<field>(?:[^"]|\\")*)" field should not contain "(?P<value>(?:[^"]|\\")*)"$/
default |  Then /^(?:|I )should see (?P<num>\d+) "(?P<element>[^"]*)" elements?$/
default |  Then /^the "(?P<checkbox>(?:[^"]|\\")*)" checkbox should be checked$/
default |  Then /^the checkbox "(?P<checkbox>(?:[^"]|\\")*)" (?:is|should be) checked$/
default |  Then /^the "(?P<checkbox>(?:[^"]|\\")*)" checkbox should not be checked$/
default |  Then /^the checkbox "(?P<checkbox>(?:[^"]|\\")*)" should (?:be unchecked|not be checked)$/
default |  Then /^the checkbox "(?P<checkbox>(?:[^"]|\\")*)" is (?:unchecked|not checked)$/
default |  Then /^print current URL$/
default |  Then /^print last response$/
default |  Then /^show last response$/
```
