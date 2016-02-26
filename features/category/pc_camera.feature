Feature: Check PC & Camera category
  In order to check replacement parts compatibility for PC & Camera
  As an anoymous user
  I should see PCP stripe and bullet points.

  @javascript
  Scenario: check PCP stripe for PC
    # set up weblab
    Given I am on "http://www.amazon.com/gp/private/weblab/cookie.html?wc=SEARCH_67799:T1|RPP_DP_G2S2_62339:T1"
    Then I should see "SEARCH_67799:T1"

    # check pc stripe
    Given I am on "/gp/product/B008LTBJFM"
    And I should see "Select your model"
    And I should see an "#replacement-parts-fitment-widget_div" element

    # check brand button
    Then I should see an "#hsx-rpp-brand-popover-trigger-announce" element
    And I should not see "Popular brands"
    When I click the "#hsx-rpp-brand-popover-trigger-announce" element
    Then I should see "Popular brands"

    # check correct brand data, this is only in PC brand
    Then I should see "ABIT"
    And I should not see "3D Systems"

    # check bullet points
    Then I should see " Enter your model number above to make sure this fits."

    # verify weblab with "C"
    Given I am on "http://www.amazon.com/gp/private/weblab/cookie.html?wc=SEARCH_67799:C"
    Then I should see "SEARCH_67799:C"
    Given I am on "/gp/product/B008LTBJFM"
    Then I should not see "Select your model"


  @javascript
  Scenario: check PCP stripe for Camera
    # set up weblab
    Given I am on "http://www.amazon.com/gp/private/weblab/cookie.html?wc=SEARCH_67799:T1|RPP_DP_G2S2_62339:T1"
    Then I should see "SEARCH_67799:T1"

    # check pc stripe
    Given I am on "/gp/product/B001BTG3NW"
    And I should see "Select your model"
    And I should see an "#replacement-parts-fitment-widget_div" element

    # check brand button
    Then I should see an "#hsx-rpp-brand-popover-trigger-announce" element
    And I should not see "Popular brands"
    When I click the "#hsx-rpp-brand-popover-trigger-announce" element
    Then I should see "Popular brands"

    # check camera brand, this should only be in Camera
    Then I should see "YAESU"
    And I should not see "3D Systems"

    # check bullet points
    Then I should see " Enter your model number above to make sure this fits."
