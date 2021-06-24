# Provinces API

These endpoints will allow you to easily manage provinces. Base URI is `/api/v1/provinces`.

# Province API response structure

If you request a province via API, you will receive an object with the following fields:

```text
+-------+----------------------------+
| Field | Description                |
+=======+============================+
| id    | Id of the province         |
+-------+----------------------------+
| code  | Unique province identifier |
+-------+----------------------------+
| name  | Name of the province       |
+-------+----------------------------+
```

If you request for more detailed data, you will receive an object with the following fields:

```text
+--------------+-----------------------------------+
| Field        | Description                       |
+==============+===================================+
| id           | Id of the province                |
+--------------+-----------------------------------+
| code         | Unique province identifier        |
+--------------+-----------------------------------+
| name         | Name of the province              |
+--------------+-----------------------------------+
| abbreviation | Abbreviation of the province      |
+--------------+-----------------------------------+
| createdAt    | The province's creation date      |
+--------------+-----------------------------------+
| updatedAt    | The province's last updating date |
+--------------+-----------------------------------+
```

### **Note**

Read more about [Provinces in the component docs](https://docs.sylius.com/en/latest/components_and_bundles/components/Addressing/models.html).

# Getting a Single Province

To retrieve the details of a specific province you will need to call the ``/api/v1/countries/{countryCode}/provinces/{code}`` endpoint with the ``GET`` method.

## Definition

```text
GET /api/v1/countries/{countryCode}/provinces/{code}
```

```text
+---------------+----------------+---------------------------------------------------+
| Parameter     | Parameter type | Description                                       |
+===============+================+===================================================+
| Authorization | header         | Token received during authentication              |
+---------------+----------------+---------------------------------------------------+
| countryCode   | url attribute  | Code of the country to which the province belongs |
+---------------+----------------+---------------------------------------------------+
| code          | url attribute  | Code of the requested province                    |
+---------------+----------------+---------------------------------------------------+
```

## Example

To see the details of the province with ``code = PL-MZ`` which belongs to the country with ``code = PL`` use the below method:

```bash
 curl http://demo.sylius.com/api/v1/countries/PL/provinces/PL-MZ \
    -H "Authorization: Bearer SampleToken" \
    -H "Accept: application/json"
```

### **Note**

The *PL* ans *PL-MZ* codes are just examples. Your value can be different.

## Exemplary Response

```text
STATUS: 200 OK
```

```json
{
    "id": 1,
    "code": "PL-MZ",
    "name": "mazowieckie",
    "_links": {
        "self": {
            "href": "\/api\/v1\/countries\/PL\/provinces\/PL-MZ"
        },
        "country": {
            "href": "\/api\/v1\/countries\/PL"
        }
    }
}
```

# Deleting a Province

To delete a province you will need to call the ``/api/v1/countries/{countryCode}/provinces/{code}`` endpoint with the ``DELETE`` method.

## Definition

```text
DELETE /api/v1/countries/{countryCode}/provinces/{code}
```

```text
+---------------+----------------+---------------------------------------------------+
| Parameter     | Parameter type | Description                                       |
+===============+================+===================================================+
| Authorization | header         | Token received during authentication              |
+---------------+----------------+---------------------------------------------------+
| countryCode   | url attribute  | Code of the country to which the province belongs |
+---------------+----------------+---------------------------------------------------+
| code          | url attribute  | Code of the requested province                    |
+---------------+----------------+---------------------------------------------------+
```

## Example

```bash
    curl http://sylius.test/api/v1/countries/PL/provinces/PL-MZ \
        -H "Authorization: Bearer SampleToken" \
        -H "Accept: application/json" \
        -X DELETE
```

## Exemplary Response

```text
STATUS: 204 No Content
```
