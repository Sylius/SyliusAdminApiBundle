# Shipping Methods API

These endpoints will allow you to easily manage shipping methods. Base URI is `/api/v1/shipping-methods`.

# Shipping Method API response structure

If you request a shipping method via API, you will receive an object with the following fields:

```text
+---------------------+----------------------------------------------------+
| Field               | Description                                        |
+=====================+====================================================+
| id                  | Id of the shipping method                          |
+---------------------+----------------------------------------------------+
| code                | Unique shipping method identifier                  |
+---------------------+----------------------------------------------------+
| name                | The name of the shipping method                    |
+---------------------+----------------------------------------------------+
| enabled             | Determine if the shipping method is enabled        |
+---------------------+----------------------------------------------------+
| categoryRequirement | Reference to constant from ShippingMethodInterface |
+---------------------+----------------------------------------------------+
| calculator          | Reference to constant from DefaultCalculators      |
+---------------------+----------------------------------------------------+
| configuration       | Extra configuration for the calculator             |
+---------------------+----------------------------------------------------+
| createdAt           | Date of creation                                   |
+---------------------+----------------------------------------------------+
| updatedAt           | Date of last update                                |
+---------------------+----------------------------------------------------+
```

### **Note**

Read more about [Shipping Methods in the component docs](https://docs.sylius.com/en/latest/components_and_bundles/components/Shipping/index.html).

# Getting a Single Shipping Method

To retrieve the details of a shipping method you will need to call the ``/api/v1/shipping-methods/{code}`` endpoint with the ``GET`` method.

## Definition

```text
GET /api/v1/shipping-methods/{code}
```

```text
+---------------+----------------+---------------------------------------+
| Parameter     | Parameter type | Description                           |
+===============+================+=======================================+
| Authorization | header         | Token received during authentication  |
+---------------+----------------+---------------------------------------+
| code          | url attribute  | Code of the requested shipping method |
+---------------+----------------+---------------------------------------+
```

## Example

To see the details of the shipping method with ``code = ups`` use the below method:

```bash
 curl http://demo.sylius.com/api/v1/shipping-methods/ups \
    -H "Authorization: Bearer SampleToken" \
    -H "Accept: application/json"
```

### **Note**

    The *ups* code is just an example. Your value can be different.

## Exemplary Response

```text
 STATUS: 200 OK
```

```json
{
    "id": 1,
    "code": "ups",
    "enabled": true,
    "_links": {
        "self": {
            "href": "\/api\/v1\/shipping-methods\/ups"
        },
        "zone": {
            "href": "\/api\/v1\/zones\/US"
        }
    }
}
```
