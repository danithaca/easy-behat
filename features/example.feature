Feature: behat demo
  In order to test if Behat is running
  As a developer
  I need to be able to run this example

  Scenario: test amazon.com
    Given I am on "http://amazon.com"
    Then the response status code should be 200
    