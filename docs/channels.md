# Channels API

These endpoints will allow you to easily manage channels. Base URI is `/api/v1/channels`.

# Channel API response structure

If you request a channel via API, you will receive an object with the following fields:

```text
+--------------+---------------------------+
| Field        | Description               |
+==============+===========================+
| id           | Id of the channel         |
+--------------+---------------------------+
| code         | Unique channel identifier |
+--------------+---------------------------+
```

If you request for more detailed data, you will receive an object with the following fields:

```text
+------------------------+------------------------------------------------------------------------+
| Field                  | Description                                                            |
+========================+========================================================================+
| id                     | Id of the channel                                                      |
+------------------------+------------------------------------------------------------------------+
| code                   | Unique channel identifier                                              |
+------------------------+------------------------------------------------------------------------+
| taxCalculationStrategy | Strategy which will be applied during processing orders in the channel |
+------------------------+------------------------------------------------------------------------+
| name                   | Name of the channel                                                    |
+------------------------+------------------------------------------------------------------------+
| hostname               | Name of the host for the channel                                       |
+------------------------+------------------------------------------------------------------------+
| enabled                | Gives an information about channel availability                        |
+------------------------+------------------------------------------------------------------------+
| description            | Description of the channel                                             |
+------------------------+------------------------------------------------------------------------+
| color                  | Allows to recognize orders made in the channel                         |
+------------------------+------------------------------------------------------------------------+
| createdAt              | The channel's creation date                                            |
+------------------------+------------------------------------------------------------------------+
| updatedAt              | The channel's last updating date                                       |
+------------------------+------------------------------------------------------------------------+
```

### **Note**

Read more about [Channels docs](https://docs.sylius.com/en/latest/components_and_bundles/components/Channel/index.html).

# Getting a Single Channel

To retrieve the details of a specific channel you will need to call the ``/api/v1/channels/{code}`` endpoint with the ``GET`` method.

## Definition

```text
GET /api/v1/channels/{code}
```

```text
+---------------+----------------+--------------------------------------+
| Parameter     | Parameter type | Description                          |
+===============+================+======================================+
| Authorization | header         | Token received during authentication |
+---------------+----------------+--------------------------------------+
| code          | url attribute  | Code of requested channel            |
+---------------+----------------+--------------------------------------+
```

## Example

To see the details of the channel with ``code = US_WEB`` use the below method:

```bash
curl http://demo.sylius.com/api/v1/channels/US_WEB \
    -H "Authorization: Bearer SampleToken" \
    -H "Accept: application/json"
```

### **Note**

The *US_WEB* code is just an example. Your value can be different.

## Exemplary Response

```text
STATUS: 200 OK
```

```json
{
    "id": 1,
    "code": "US_WEB",
    "name": "US Web Store",
    "hostname": "localhost",
    "color": "Wheat",
    "createdAt": "2017-02-10T13:14:20+0100",
    "updatedAt": "2017-02-10T13:14:20+0100",
    "enabled": true,
    "taxCalculationStrategy": "order_items_based",
    "_links": {
        "self": {
            "href": "\/api\/v1\/channels\/US_WEB"
        }
    }
}
```
