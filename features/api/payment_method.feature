@api

Feature: iSklep Api payment_method client component

  Scenario Outline: Create payment_method
    When I send POST payment_method <type> with data:
      | id   | name                | is_active | email_body | additional_info | is_paid_at_delivery_time | plugin_id | ordering |
      | <id> | payment_method_test | 0         | email_body | additional_info | false                    | 0         | 1        |
    Then the payment_methods request should contain json:
    """
    {
      "payment_method": {
        "additional_info": "additional_info",
        "email_body": "email_body",
        "id": <id>,
        "is_active": false,
        "is_paid_at_delivery_time": true,
        "name": "payment_method_test",
        "ordering": 1,
        "plugin_id": 0
      }
    }
    """
    And the payment_methods response should contain json:
    """
    {
      "data": {
        "payment_method": {
          "additional_info": "additional_info",
          "email_body": "email_body",
          "id":@integer@,
          "is_active": false,
          "is_paid_at_delivery_time": true,
          "name": "payment_method_test",
          "ordering": @integer@,
          "plugin_id": 0
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

  Scenario: Get list of Payment methods
    When I send request for all payment methods
    And the payment_methods response should contain json:
    """
    {
      "data": {
        "payment_methods": @array@
      },
      "error": null,
      "success": true,
      "version": "v1"
    }
    """

  Scenario: Get list of Payment methods
    When I send request for all payment methods and map data
    And the payment_methods response should contain json:
    """
    {
      "data": {
        "payment_methods": @array@
      },
      "error": null,
      "success": true,
      "version": "v1"
    }
    """