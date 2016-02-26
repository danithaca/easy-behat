Feature: Check Ink & Toner category
  In order to check replacement parts compatibility for Ink & Toner
  As an anoymous user
  I should see PCP stripe and bullet points.

  @javascript
  Scenario: check PCP stripe for Ink & Toner
    # set up weblab
    Given I am on "http://www.amazon.com/gp/private/weblab/cookie.html?wc=SEARCH_64394:T1"
    Then I should see "SEARCH_64394:T1"

    # check pc stripe.
    Given I am on "/gp/product/B003YT6RNS"
    And I should see "Select your model"
    And I should see an "#replacement-parts-fitment-widget_div" element

    # check brand button
    Then I should see an "#hsx-rpp-brand-popover-trigger-announce" element
    And I should not see "Popular brands"
    When I click the "#hsx-rpp-brand-popover-trigger-announce" element
    Then I should see "Popular brands"
    And I should see "Brother"
    And I should see "3D Systems"

    # check twister refresh
    When I press "Brother"
    Then I should see an "button[title='Brother']" element
    And I should not see "Brand" in the "#replacement-parts-fitment-widget_div" element

    When I click the "#color_name_2 button" element
    And pause 5 seconds
    Then I should not see an "button[title='Brother']" element
    And I should see "Brand" in the "#replacement-parts-fitment-widget_div" element

    # check bullet points
    Then I should see " Enter your model number above to make sure this fits."