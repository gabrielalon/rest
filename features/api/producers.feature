@api

Feature: iSklep Api producers client component

  Scenario Outline: Create producer
    When I send POST producer <type> with data:
      | id   | name          | site_url          | logo_filename          | ordering | source_id |
      | <id> | name_producer | site_url_producer | logo_filename_producer | 12       | id_source |
    Then the producers request should contain json:
    """
    {
      "producer": {
        "id": <id>,
        "logo_filename": "logo_filename_producer",
        "name": "name_producer",
        "ordering": 12,
        "site_url": "site_url_producer",
        "source_id": "@string@"
      }
    }
    """
    And the producers response should contain json:
    """
    {
      "data": {
        "producer": {
          "id": @integer@,
          "logo_filename": "logo_filename_producer",
          "name": "name_producer",
          "ordering": @integer@,
          "site_url": "site_url_producer",
          "source_id": "@string@"
        }
      },
      "error": null,
      "success": true,
      "version": "v1"
    }
    """
    Examples:
      | type   | id   |
      | array  | 1007 |
      | object | 1008 |

  Scenario: Get list of Producers
    When I send request for all producers
    And the producers response should contain json:
    """
    {
      "data": {
        "producers": @array@
      },
      "error": null,
      "success": true,
      "version": "v1"
    }
    """

  Scenario: Get list of Producers
    When I send request for all producers and map data
    And the producers response should contain json:
    """
    {
      "data": {
        "producers": @array@
      },
      "error": null,
      "success": true,
      "version": "v1"
    }
    """