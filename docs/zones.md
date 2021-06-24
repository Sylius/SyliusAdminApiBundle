# Zones API

These endpoints will allow you to easily manage zones. Base URI is `/api/v1/zones`.

# Zone structure

## Zone API response structure

If you request a zone via API, you will receive an object with the following fields:

```text
+-----------+------------------------+
| Field     | Description            |
+===========+========================+
| id        | Id of the zone         |
+-----------+------------------------+
| code      | Unique zone identifier |
+-----------+------------------------+
| name      | Name of the zone       |
+-----------+------------------------+
| type      | Type of the zone       |
+-----------+------------------------+
```

If you request for more detailed data, you will receive an object with the following fields:

```text
+-----------+------------------------+
| Field     | Description            |
+===========+========================+
| id        | Id of the zone         |
+-----------+------------------------+
| code      | Unique zone identifier |
+-----------+------------------------+
| name      | Name of the zone       |
+-----------+------------------------+
| type      | Type of the zone       |
+-----------+------------------------+
| scope     | Scope of the zone      |
+-----------+------------------------+
| members   | Members of the zone    |
+-----------+------------------------+
| createdAt | Date of creation       |
+-----------+------------------------+
| updatedAt | Date of last update    |
+-----------+------------------------+
```

### **Note**

Read more about [the Zone model in the component docs](https://docs.sylius.com/en/latest/components_and_bundles/components/Addressing/models.html).

# Creating a Zone

To create a new zone you will need to call the ``/api/v1/zones/{type}`` endpoint with the ``POST`` method.

## Definition

```text
POST /api/v1/zones/{type}
```

```text
+---------------+----------------+--------------------------------------+
| Parameter     | Parameter type | Description                          |
+===============+================+======================================+
| Authorization | header         | Token received during authentication |
+---------------+----------------+--------------------------------------+
| type          | url attribute  | Type of a creating zone              |
+---------------+----------------+--------------------------------------+
| code          | request        | **(unique)** Zone identifier         |
+---------------+----------------+--------------------------------------+
| name          | request        | Name of the zone                     |
+---------------+----------------+--------------------------------------+
| scope         | request        | Scope of the zone                    |
+---------------+----------------+--------------------------------------+
| members       | request        | Members of the zone                  |
+---------------+----------------+--------------------------------------+
```

### **Note**

Read more about [Zone types in the component docs](https://docs.sylius.com/en/latest/components_and_bundles/components/Addressing/zone_types.html).

## Example

To create a new country zone use the below method:

```bash
curl http://demo.sylius.com/api/v1/zones/country \
    -H "Authorization: Bearer SampleToken" \
    -H "Content-Type: application/json" \
    -X POST \
    --data '
        {
            "code": "EU",
            "name": "European Union",
            "scope": "all",
            "members": [
                {
                    "code": "PL"
                }
            ]
        }
    '
```

## Exemplary Response

```text
STATUS: 201 CREATED
```

```json
{
    "id": 2,
    "code": "EU",
    "name": "European Union",
    "type": "country",
    "scope": "all",
    "_links": {
        "self": {
            "href": "\/api\/v1\/zones\/EU"
        }
    }
}
```

### **Warning**

If you try to create a zone without name, code, scope or member, you will receive a ``400 Bad Request`` error, that will contain validation errors.

## Example

```bash
curl http://demo.sylius.com/api/v1/zones/country \
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
        "errors": [
            "Please add at least 1 zone member."
        ],
        "children": {
            "name": {
                "errors": [
                    "Please enter zone name."
                ]
            },
            "type": {},
            "scope": {
                "errors": [
                    "Please enter the scope."
                ]
            },
            "code": {
                "errors": [
                    "Please enter zone code."
                ]
            },
            "members": {}
        }
    }
}
```

# Getting a Single Zone

To retrieve the details of a zone you will need to call the ``/api/v1/zone/{code}`` endpoint with the ``GET`` method.

## Definition

```text
GET /api/v1/zones/{code}
```

```text
+---------------+----------------+--------------------------------------+
| Parameter     | Parameter type | Description                          |
+===============+================+======================================+
| Authorization | header         | Token received during authentication |
+---------------+----------------+--------------------------------------+
| code          | url attribute  | Unique zone identifier               |
+---------------+----------------+--------------------------------------+
```

## Example

To see the details of the zone with ``code = EU`` use the below method:

```bash
curl http://demo.sylius.com/api/v1/zones/EU \
    -H "Authorization: Bearer SampleToken" \
    -H "Accept: application/json"
```

### **Note**

The *EU* code is an exemplary value. Your value can be different.
Check in the list of all zones if you are not sure which code should be used.

## Exemplary Response

```text
STATUS: 200 OK
```

```json
{
    "id": 2,
    "code": "EU",
    "name": "European Union",
    "type": "country",
    "scope": "all",
    "_links": {
        "self": {
            "href": "\/api\/v1\/zones\/EU"
        }
    }
}
```

# Collection of Zones

To retrieve a paginated list of zones you will need to call the ``/api/v1/zones/`` endpoint with the ``GET`` method.

## Definition

```text
GET /api/v1/zones/
```

```text
+---------------------------------------+----------------+---------------------------------------------------+
| Parameter                             | Parameter type | Description                                       |
+=======================================+================+===================================================+
| Authorization                         | header         | Token received during authentication              |
+---------------------------------------+----------------+---------------------------------------------------+
| limit                                 | query          | *(optional)* Number of items to display per page, |
|                                       |                | by default = 10                                   |
+---------------------------------------+----------------+---------------------------------------------------+
| sorting['nameOfField']['direction']   | query          | *(optional)* Field and direction of sorting,      |
|                                       |                | by default 'desc' and 'createdAt'                 |
+---------------------------------------+----------------+---------------------------------------------------+
```

To see the first page of all zones use the below method:

## Example

```bash
curl http://demo.sylius.com/api/v1/zones/ \
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
    "total": 2,
    "_links": {
        "self": {
            "href": "\/api\/v1\/zones\/?page=1&limit=10"
        },
        "first": {
            "href": "\/api\/v1\/zones\/?page=1&limit=10"
        },
        "last": {
            "href": "\/api\/v1\/zones\/?page=1&limit=10"
        }
    },
    "_embedded": {
        "items": [
            {
                "id": 1,
                "code": "US",
                "name": "United States of America",
                "type": "country",
                "_links": {
                    "self": {
                        "href": "\/api\/v1\/zones\/US"
                    }
                }
            },
            {
                "id": 2,
                "code": "EU",
                "name": "European Union",
                "type": "country",
                "_links": {
                    "self": {
                        "href": "\/api\/v1\/zones\/EU"
                    }
                }
            }
        ]
    }
}
```

# Updating a Zone

To fully update a zone you will need to call the ``/api/v1/zones/{code}`` endpoint with the ``PUT`` method.

## Definition

```text
    PUT /api/v1/zones/{code}
```

```text
+---------------+----------------+--------------------------------------+
| Parameter     | Parameter type | Description                          |
+===============+================+======================================+
| Authorization | header         | Token received during authentication |
+---------------+----------------+--------------------------------------+
| code          | url attribute  | Unique zone identifier               |
+---------------+----------------+--------------------------------------+
| name          | request        | Name of the zone                     |
+---------------+----------------+--------------------------------------+
| scope         | request        | Scope of the zone                    |
+---------------+----------------+--------------------------------------+
| members       | request        | Members of the zone                  |
+---------------+----------------+--------------------------------------+

```

## Example

To fully update the zone with ``code = EU`` use the below method:

```bash
curl http://demo.sylius.com/api/v1/zones/EU \
    -H "Authorization: Bearer SampleToken" \
    -H "Content-Type: application/json" \
    -X PUT \
    --data '
        {
            "name": "European Union Zone",
            "scope": "shipping",
            "members": [
                {
                    "code": "DE"
                }
            ]
        }
    '
```

## Exemplary Response

```text
STATUS: 204 No Content
```

If you try to perform a full zone update without all the required fields specified, you will receive a ``400 Bad Request`` error.

## Example

```bash
curl http://demo.sylius.com/api/v1/zones/EU \
    -H "Authorization: Bearer SampleToken" \
    -H "Content-Type: application/json" \
    -X PUT
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
        "errors": [
            "Please add at least 1 zone member."
        ],
        "children": {
            "name": {
                "errors": [
                    "Please enter zone name."
                ]
            },
            "type": {},
            "scope": {
                "errors": [
                    "Please enter the scope."
                ]
            },
            "code": {},
            "members": {}
        }
    }
}
```

To update a zone partially you will need to call the ``/api/v1/zones/{code}`` endpoint with the ``PATCH`` method.

## Definition

```text
PATCH /api/v1/zones/{code}
```

```text
+---------------+----------------+--------------------------------------+
| Parameter     | Parameter type | Description                          |
+===============+================+======================================+
| Authorization | header         | Token received during authentication |
+---------------+----------------+--------------------------------------+
| code          | url attribute  | Unique zone identifier               |
+---------------+----------------+--------------------------------------+
| scope         | request        | Scope of the zone                    |
+---------------+----------------+--------------------------------------+
```

## Example

To partially update the zone with ``code = EU`` use the below method:

```bash
curl http://demo.sylius.com/api/v1/zones/EU \
    -H "Authorization: Bearer SampleToken" \
    -H "Content-Type: application/json" \
    -X PATCH \
    --data '
        {
            "scope": "tax"
        }
    '
```

## Exemplary Response

```text
STATUS: 204 No Content
```

# Deleting a Zone

To delete a zone you will need to call the ``/api/v1/zones/{code}`` endpoint with the ``DELETE`` method.

## Definition

```text
DELETE /api/v1/zones/{code}
```

```text
+---------------+----------------+--------------------------------------+
| Parameter     | Parameter type | Description                          |
+===============+================+======================================+
| Authorization | header         | Token received during authentication |
+---------------+----------------+--------------------------------------+
| code          | url attribute  | Unique zone identifier               |
+---------------+----------------+--------------------------------------+
```

## Example

To delete the zone with ``code = EU`` use the below method:

```bash
curl http://demo.sylius.com/api/v1/zones/EU \
    -H "Authorization: Bearer SampleToken" \
    -H "Accept: application/json" \
    -X DELETE
```

## Exemplary Response

```text
STATUS: 204 No Content
```
