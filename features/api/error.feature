@api

Feature: iSklep Api test error

  Scenario: Create producer
    When I send spoiled POST producer object with data:
      | id   | name          | site_url          | logo_filename          | ordering | source_id                      |
      | 2101 | name_producer | site_url_producer | logo_filename_producer | 12       | id_source_to_long_with_integer |
    Then the producers request should contain json:
    """
    {
      "producer": {
        "id": 2101,
        "logo_filename": "logo_filename_producer",
        "name": "name_producer",
        "ordering": 12,
        "site_url": "site_url_producer",
        "source_id": "id_source_to_long_with_integer"
      }
    }
    """
    And the producers response should contain json:
    """
    {
      "data": null,
      "error": {
        "messages": [
          "producer.source_id_max_length"
        ],
        "reason_code": "INVALID_DATA_FOR_OBJECT"
      },
      "success": false,
      "version": "v1"
    }
    """