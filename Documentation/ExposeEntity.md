#List expose entity

When you Request 
```
    method: GET
    URI: /api/objects
```

the response will be like :

```json
{
    "_links": {
        "self": {
            "href": ""
        }
    }
    "_embedded": {
        "tables": [2]
            0:  {
                "name": "Namespace\..\YourEntity"
                "identifier": [1]
                    0:  "id"
                
                "fields": [2]
                    0:  {
                        "name": "id"
                        "value": null
                        "type": {}
                        "definition": null
                        "notnull": true
                        "length": null
                        "comment": ""
                        "auto_increment": true
                    }
                    1:  {
                        "name": "titre"
                        "value": null
                        "type": {}
                        "definition": null
                        "notnull": true
                        "length": 255
                        "comment": ""
                        "auto_increment": false
                    }
                "embeds": {
                    "yourEntity2s": [1]
                        0:  {
                            "fieldName": "yourEntity2s"
                            "entityName": "yourEntity2"
                            "entities": [0]
                        }
                }
                "_links": {
                    "self": {
                        "href": ""
                    }
                }
            }
            
            1:  {
                name: "Namespace\..\YourEntity2"
                identifier: [1]
                    0:  "id"
                
                fields: [2]
                    0:  {
                        name: "id"
                        value: null
                        type: {}
                        definition: null
                        notnull: true
                        length: null
                        comment: ""
                        auto_increment: true
                    }
                    1:  {
                        name: "titre"
                        value: null
                        type: {}
                        definition: null
                        notnull: true
                        length: 255
                        comment: ""
                        auto_increment: false
                    }
                embeds: {}
                _links: {
                    self: {
                        href: ""
                    }
                }
            }
    }
}
```

to choose the expose entity :

```yaml
virhi_lazy_rest_api:
    manager: Manager
    expose_entities:
        your_entity: { entity_name: Namespace\..\YourEntity}
        your_entity2: { entity_name: Namespace\..\YourEntity2}

```

#get entity structure

When you Request 
```
    method: GET
    URI: /api/object/yourEntity
```

```json
{
    name: "Namespace\..\YourEntity"
    identifier: [1]
        0:  "id"
    fields: [2]
        0:  {
            name: "id"
            value: null
            type: {}
            definition: null
            notnull: true
            length: null
            comment: ""
            auto_increment: true
        }
        1:  {
            name: "titre"
            value: null
            type: {}
            definition: null
            notnull: true
            length: 255
            comment: ""
            auto_increment: false
        }
    embeds: {
        tags: [1]
            0:  {
                fieldName: "yourEntity2s"
                entityName: "yourEntity2"
                entities: [0]
            }
    }
    _links: {
        self: {
            href: ""
        }
    }
}
```