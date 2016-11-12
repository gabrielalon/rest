@api

Feature: iSklep Api status client component

  Scenario: Get Status
    When I send request for status
    And the status response should contain json:
    """
    {
      "data": {
        "status": {
          "currentLanguageCode": "pl",
          "currentTime": "@string@",
          "userLogin": "rest"
        }
      },
      "error": null,
      "success": true,
      "version": "v1"
    }
    """