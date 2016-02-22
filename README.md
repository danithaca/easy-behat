# easy-behat

Create vagrant environment to run Behat with selenium, firefox. Include a couple of commonly used features such as taking screenshots.

## Supported Directives

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
