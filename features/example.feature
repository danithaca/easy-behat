Feature: behat demo
  In order to test if Behat is running
  As a developer
  I need to be able to run this example

  @javascript
  Scenario: test amazon.com
    Given I am on "http://amazon.com"
    Then I should see "Prime"
    Then print console log
    