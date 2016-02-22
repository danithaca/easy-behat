Feature: Check PC & Camera category
  In order to check replacement parts compatibility for PC & Camera
  As an anoymous user
  I should see PCP stripe and bullet points.

  @javascript
  Scenario: check PCP stripe for PC
    # set up weblab
    Given I am on "http://www.amazon.com/gp/private/weblab/cookie.html?wc=SEARCH_67799:T1"
    Then I should see "SEARCH_67799:T1"

    # check pc stripe
    Given I am on "/gp/product/B008LTBJFM"
    Then I should see "Make sure this fits your model"
    And I should see "Select your model"
    And I should see an "#replacement-parts-fitment-widget_div" element

    # check bullet points
    Then I should see " Enter your model number above to make sure this fits."

    # check brand button
    Then I should see an "#hsx-rpp-brand-popover-trigger-announce" element
    And I should not see "Popular brands"
    When I click the "#hsx-rpp-brand-popover-trigger-announce" element
    Then I should see "Popular brands"

    # verify weblab with "C"
    Given I am on "http://www.amazon.com/gp/private/weblab/cookie.html?wc=SEARCH_67799:C"
    Then I should see "SEARCH_67799:C"
    Given I am on "/gp/product/B008LTBJFM"
    Then I should not see "Make sure this fits your model"


  @javascript
  Scenario: check PCP stripe for Camera
    # set up weblab
    Given I am on "http://www.amazon.com/gp/private/weblab/cookie.html?wc=SEARCH_67799:T1"
    Then I should see "SEARCH_67799:T1"

    # check pc stripe
    Given I am on "/gp/product/B001BTG3NW"
    Then I should see "Make sure this fits your model"
    And I should see "Select your model"
    And I should see an "#replacement-parts-fitment-widget_div" element

    # check bullet points
    Then I should see " Enter your model number above to make sure this fits."

    # check brand button
    Then I should see an "#hsx-rpp-brand-popover-trigger-announce" element
    And I should not see "Popular brands"
    When I click the "#hsx-rpp-brand-popover-trigger-announce" element
    Then I should see "Popular brands"
