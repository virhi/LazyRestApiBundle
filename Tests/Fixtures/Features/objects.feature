@api @objects
Feature: List the expose entities

  Scenario: list the expose entites
    When I send a GET request to "/api/objects"
    Then the response code should be 200
    Then the response should contain "Virhi\\LazyRestApiBundle\\Tests\\Fixtures\\App\\app\\Entity\\Post"
    Then the response should contain "id"