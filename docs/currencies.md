# Currencies API

These endpoints will allow you to easily manage currencies. Base URI is `/api/v1/currencies`.

# Currency API response structure

If you request a currency via API, you will receive an object with the following fields:

```text
+-------+----------------------------+
| Field | Description                |
+=======+============================+
| id    | Id of the currency         |
+-------+----------------------------+
| code  | Unique currency identifier |
+-------+----------------------------+
```

If you request for more detailed data, you will receive an object with the following fields:

```text
+-----------+----------------------------------+
| Field     | Description                      |
+===========+==================================+
| id        | Id of the currency               |
+-----------+----------------------------------+
| code      | Unique currency identifier       |
+-----------+----------------------------------+
| updatedAt | Last update date of the currency |
+-----------+----------------------------------+
| createdAt | Creation date of the currency    |
+-----------+----------------------------------+
```

### **Note**

Read more about [Currencies in the component docs](https://docs.sylius.com/en/latest/components_and_bundles/components/Currency/models.html#currency).

# Creating a Currency

To create a new currency you will need to call the ``/api/v1/currencies/`` endpoint with the ``POST`` method.

## Definition

```text
POST /api/v1/currencies/
```

```text
+---------------+----------------+--------------------------------------+
| Parameter     | Parameter type | Description                          |
+===============+================+======================================+
| Authorization | header         | Token received during authentication |
+---------------+----------------+--------------------------------------+
| code          | request        | **(unique)** Currency identifier     |
+---------------+----------------+--------------------------------------+
```

## Example

```bash
curl http://demo.sylius.com/api/v1/currencies/ \
    -H "Authorization: Bearer SampleToken" \
    -H "Content-Type: application/json" \
    -X POST \
    --data '
        {
            "code": "PLN"
        }
    '
```

## Exemplary Response

```text
STATUS: 201 CREATED
```

```json
{
    "id": 4,
    "code": "PLN",
    "createdAt": "2017-02-14T11:38:40+0100",
    "updatedAt": "2017-02-14T11:38:41+0100",
    "_links": {
        "self": {
            "href": "\/api\/v1\/currencies\/PLN"
        }
    }
}
```

If you try to create a currency without code you will receive a ``400 Bad Request`` error.

## Example

```bash
curl http://demo.sylius.com/api/v1/currencies/ \
    -H "Authorization: Bearer SampleToken" \
    -H "Content-Type: application/json" \
    -X POST
```

## Exemplary Response

```text
STATUS: 400 Bad Request
```

```json
{
    "code": 400,
    "message": "Validation Failed",
    "errors": {
        "children": {
            "code": {
                "errors": [
                    "Please choose currency code."
                ]
            }
        }
    }
}
```

# Getting a Single Currency

To retrieve the details of a currency you will need to call the ``/api/v1/currencies/{code}`` endpoint with the ``GET`` method.

## Definition

```text
    GET /api/v1/currencies/{code}
```

```text
+---------------+----------------+--------------------------------------+
| Parameter     | Parameter type | Description                          |
+===============+================+======================================+
| Authorization | header         | Token received during authentication |
+---------------+----------------+--------------------------------------+
| code          | url attribute  | Code of the requested currency       |
+---------------+----------------+--------------------------------------+
```

## Example

To see the details of the currency with ``code = PLN`` use the below method:

```bash
 curl http://demo.sylius.com/api/v1/currencies/PLN \
    -H "Authorization: Bearer SampleToken" \
    -H "Accept: application/json"
```

### **Note**

The *PLN* code is just an example. Your value can be different.

## Exemplary Response

```text
 STATUS: 200 OK
```

```json
{
    "id": 4,
    "code": "PLN",
    "createdAt": "2017-02-14T11:38:40+0100",
    "updatedAt": "2017-02-14T11:38:41+0100",
    "_links": {
        "self": {
            "href": "\/api\/v1\/currencies\/PLN"
        }
    }
}
```

# Collection of Currencies

To retrieve a paginated list of currencies you will need to call the ``/api/v1/currencies/`` endpoint with the ``GET`` method.

## Definition

```text
GET /api/v1/currencies/
```

```text
+---------------+----------------+-------------------------------------------------------------------+
| Parameter     | Parameter type | Description                                                       |
+===============+================+===================================================================+
| Authorization | header         | Token received during authentication                              |
+---------------+----------------+-------------------------------------------------------------------+
| page          | query          | *(optional)* Number of the page, by default = 1                   |
+---------------+----------------+-------------------------------------------------------------------+
| paginate      | query          | *(optional)* Number of items to display per page, by default = 10 |
+---------------+----------------+-------------------------------------------------------------------+
```

To see the first page of all currencies use the below method:

## Example

```bash
curl http://demo.sylius.com/api/v1/currencies/ \
    -H "Authorization: Bearer SampleToken" \
    -H "Accept: application/json"
```

## Exemplary Response

```text
STATUS: 200 OK
```

```json
{
    "page": 1,
    "limit": 10,
    "pages": 1,
    "total": 3,
    "_links": {
        "self": {
            "href": "\/api\/v1\/currencies\/?page=1&limit=10"
        },
        "first": {
            "href": "\/api\/v1\/currencies\/?page=1&limit=10"
        },
        "last": {
            "href": "\/api\/v1\/currencies\/?page=1&limit=10"
        }
    },
    "_embedded": {
        "items": [
            {
                "id": 3,
                "code": "USD",
                "_links": {
                    "self": {
                        "href": "\/api\/v1\/currencies\/USD"
                    }
                }
            },
            {
                "id": 4,
                "code": "PLN",
                "_links": {
                    "self": {
                        "href": "\/api\/v1\/currencies\/PLN"
                    }
                }
            },
            {
                "id": 5,
                "code": "EUR",
                "_links": {
                    "self": {
                        "href": "\/api\/v1\/currencies\/EUR"
                    }
                }
            }
        ]
    }
}
```

# Deleting a Currency

To delete a currency you will need to call the ``/api/v1/currencies/{code}`` endpoint with the ``DELETE`` method.

## Definition

```text
DELETE /api/v1/currencies/{code}
```

```text
+---------------+----------------+-------------------------------------------+
| Parameter     | Parameter type | Description                               |
+===============+================+===========================================+
| Authorization | header         | Token received during authentication      |
+---------------+----------------+-------------------------------------------+
| code          | url attribute  | Code of the removed currency              |
+---------------+----------------+-------------------------------------------+
```

## Example

```bash
curl http://demo.sylius.com/api/v1/currencies/PLN \
    -H "Authorization: Bearer SampleToken" \
    -H "Accept: application/json" \
    -X DELETE
```

## Exemplary Response

```text
STATUS: 204 No Content
```
