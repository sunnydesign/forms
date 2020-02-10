# Forms Engine

Form engine microservice is used for CRUD operations with form templates and form data.
Serves requests from back-office and front-end.

# Available commands
- **getTemplates** - Get template list with pagination
- **getTemplate** - Get template by uuid
- **createTemplate** - Add new form template into DB
- **updateTemplate** - Update template by uuid
- **deleteTemplate** - Delete template from DB
- **getForms** - Get form list optionally considering client id
- **getForm** - Get form by uuid
- **createForm** - Create a form based on a template and save it into DB
- **updateForm** - Update form by uuid
- **deleteForm** - Delete form from DB

# Templates CRUD

## createTemplate

incoming message

```json
{
  "parameters": {},
  "data": {
    "template": {
      "name": "Blocked corporates form",
      "state": "active",
      "type": "Corporate",
      "data": [
        {
          "type": "header",
          "subtype": "h1",
          "label": "Front ID",
          "access": false
        },
        {
          "type": "header",
          "subtype": "h5",
          "label": "Upload your Front ID please",
          "access": false
        },
        {
          "type": "file",
          "required": true,
          "label": "File Upload",
          "description": "Click to upload",
          "className": "form-control",
          "name": "file-1580731039389",
          "access": false,
          "subtype": "file",
          "multiple": false
        },
        {
          "type": "date",
          "required": true,
          "label": "Enter date expired",
          "className": "form-control",
          "name": "date-1580731177543",
          "access": false
        },
        {
          "type": "textarea",
          "required": false,
          "label": "Comment",
          "className": "form-control",
          "name": "textarea-1580731238278",
          "access": false,
          "subtype": "textarea",
          "maxlength": 250
        },
        {
          "type": "button",
          "label": "Save",
          "subtype": "button",
          "className": "btn-success btn",
          "name": "button-1580731067466",
          "access": false,
          "style": "success"
        },
        {
          "type": "button",
          "label": "Cancel",
          "subtype": "button",
          "className": "btn-default btn",
          "name": "button-1580731082192",
          "access": false,
          "style": "default"
        }
      ]
    }
  },
  "headers": {
    "command": "createTemplate"
  }
}
```

outgoing message

```json
{
  "parameters": {},
  "data": {
    "template": {
      "name": "Blocked corporates form",
      "state": "active",
      "type": "Corporate",
      "data": [
        {
          "type": "header",
          "subtype": "h1",
          "label": "Front ID",
          "access": false
        },
        {
          "type": "header",
          "subtype": "h5",
          "label": "Upload your Front ID please",
          "access": false
        },
        {
          "type": "file",
          "required": true,
          "label": "File Upload",
          "description": "Click to upload",
          "className": "form-control",
          "name": "file-1580731039389",
          "access": false,
          "subtype": "file",
          "multiple": false
        },
        {
          "type": "date",
          "required": true,
          "label": "Enter date expired",
          "className": "form-control",
          "name": "date-1580731177543",
          "access": false
        },
        {
          "type": "textarea",
          "required": false,
          "label": "Comment",
          "className": "form-control",
          "name": "textarea-1580731238278",
          "access": false,
          "subtype": "textarea",
          "maxlength": 250
        },
        {
          "type": "button",
          "label": "Save",
          "subtype": "button",
          "className": "btn-success btn",
          "name": "button-1580731067466",
          "access": false,
          "style": "success"
        },
        {
          "type": "button",
          "label": "Cancel",
          "subtype": "button",
          "className": "btn-default btn",
          "name": "button-1580731082192",
          "access": false,
          "style": "default"
        }
      ],
      "uuid": "acd46da1-7647-43ca-a406-d02608e5a18b"
    }
  },
  "headers": {
    "command": "createTemplate",
    "success": true
  }
}
```

## getTemplates

incoming message

```json
{
  "parameters":  {
    "page": 1,
    "limit": 2
  },
  "data": {},
  "headers": {
    "command": "getTemplates"
  }
}
```

outgoing message

```json
{
  "parameters": {
    "page": 1,
    "limit": 2
  },
  "data": {
    "templates": {
      "data": [
        {
          "id": 3,
          "uuid": "50a9c26e-850e-4e3d-9ac4-e458116d50da",
          "name": "Blocked corporates form",
          "state": "active",
          "type": "Corporate",
          "data": [
            {
              "type": "header",
              "label": "Front ID",
              "access": false,
              "subtype": "h1"
            },
            {
              "type": "header",
              "label": "Upload your Front ID please",
              "access": false,
              "subtype": "h5"
            },
            {
              "name": "file-1580731039389",
              "type": "file",
              "label": "File Upload",
              "access": false,
              "subtype": "file",
              "multiple": false,
              "required": true,
              "className": "form-control",
              "description": "Click to upload"
            },
            {
              "name": "date-1580731177543",
              "type": "date",
              "label": "Enter date expired",
              "access": false,
              "required": true,
              "className": "form-control"
            },
            {
              "name": "textarea-1580731238278",
              "type": "textarea",
              "label": "Comment",
              "access": false,
              "subtype": "textarea",
              "required": false,
              "className": "form-control",
              "maxlength": 250
            },
            {
              "name": "button-1580731067466",
              "type": "button",
              "label": "Save",
              "style": "success",
              "access": false,
              "subtype": "button",
              "className": "btn-success btn"
            },
            {
              "name": "button-1580731082192",
              "type": "button",
              "label": "Cancel",
              "style": "default",
              "access": false,
              "subtype": "button",
              "className": "btn-default btn"
            }
          ],
          "created_at": "2020-02-06 18:38:36+05:00",
          "updated_at": "2020-02-06 18:38:36+05:00"
        },
        {
          "id": 4,
          "uuid": "acd46da1-7647-43ca-a406-d02608e5a18b",
          "name": "Blocked corporates form",
          "state": "active",
          "type": "Corporate",
          "data": [
            {
              "type": "header",
              "label": "Front ID",
              "access": false,
              "subtype": "h1"
            },
            {
              "type": "header",
              "label": "Upload your Front ID please",
              "access": false,
              "subtype": "h5"
            },
            {
              "name": "file-1580731039389",
              "type": "file",
              "label": "File Upload",
              "access": false,
              "subtype": "file",
              "multiple": false,
              "required": true,
              "className": "form-control",
              "description": "Click to upload"
            },
            {
              "name": "date-1580731177543",
              "type": "date",
              "label": "Enter date expired",
              "access": false,
              "required": true,
              "className": "form-control"
            },
            {
              "name": "textarea-1580731238278",
              "type": "textarea",
              "label": "Comment",
              "access": false,
              "subtype": "textarea",
              "required": false,
              "className": "form-control",
              "maxlength": 250
            },
            {
              "name": "button-1580731067466",
              "type": "button",
              "label": "Save",
              "style": "success",
              "access": false,
              "subtype": "button",
              "className": "btn-success btn"
            },
            {
              "name": "button-1580731082192",
              "type": "button",
              "label": "Cancel",
              "style": "default",
              "access": false,
              "subtype": "button",
              "className": "btn-default btn"
            }
          ],
          "created_at": "2020-02-07 17:38:18+05:00",
          "updated_at": "2020-02-07 17:38:18+05:00"
        }
      ],
      "pagination": {
        "page": 1,
        "limit": 2,
        "count": 5,
        "pages": 3
      }
    }
  },
  "headers": {
    "command": "getTemplates",
    "success": true
  }
}
```

## getTemplate

incoming message

```json
{
  "parameters":  {
    "uuid": "b88c33d6-40de-40a5-af0f-3ccbda3dae03"
  },
  "data": {},
  "headers": {
    "command": "getTemplate"
  }
}
```

## getTemplate

outgoing message

```json
{
  "parameters": {
    "uuid": "b88c33d6-40de-40a5-af0f-3ccbda3dae03"
  },
  "data": {
    "template": {
      "id": 2,
      "uuid": "b88c33d6-40de-40a5-af0f-3ccbda3dae03",
      "name": "Blocked corporates form updated",
      "state": "active",
      "type": "Corporate",
      "data": [
        {
          "type": "header",
          "label": "Front ID",
          "access": false,
          "subtype": "h1"
        },
        {
          "name": "textarea-1580731238278",
          "type": "textarea",
          "label": "Comment",
          "access": false,
          "subtype": "textarea",
          "required": false,
          "className": "form-control",
          "maxlength": 250
        },
        {
          "name": "button-1580731067466",
          "type": "button",
          "label": "Save",
          "style": "success",
          "access": false,
          "subtype": "button",
          "className": "btn-success btn"
        },
        {
          "name": "button-1580731082192",
          "type": "button",
          "label": "Cancel",
          "style": "default",
          "access": false,
          "subtype": "button",
          "className": "btn-default btn"
        }
      ],
      "created_at": "2020-02-06 18:38:35+05:00",
      "updated_at": "2020-02-07 18:52:47+05:00"
    }
  },
  "headers": {
    "command": "getTemplate",
    "success": true
  }
}
```

## updateTemplate

incoming message

```json
{
  "parameters": {
    "uuid": "b88c33d6-40de-40a5-af0f-3ccbda3dae03"
  },
  "data": {
    "template": {
      "name": "Blocked corporates form updated",
      "state": "active",
      "type": "Corporate",
      "data": [
        {
          "type": "header",
          "subtype": "h1",
          "label": "Front ID",
          "access": false
        },
        {
          "type": "textarea",
          "required": false,
          "label": "Comment",
          "className": "form-control",
          "name": "textarea-1580731238278",
          "access": false,
          "subtype": "textarea",
          "maxlength": 250
        },
        {
          "type": "button",
          "label": "Save",
          "subtype": "button",
          "className": "btn-success btn",
          "name": "button-1580731067466",
          "access": false,
          "style": "success"
        },
        {
          "type": "button",
          "label": "Cancel",
          "subtype": "button",
          "className": "btn-default btn",
          "name": "button-1580731082192",
          "access": false,
          "style": "default"
        }
      ]
    }
  },
  "headers": {
    "command": "updateTemplate"
  }
}
```

outgoing message
```json
{
  "parameters": {
    "uuid": "cbca7dd8-7b94-459a-b690-e72b13a9a364"
  },
  "data": {
    "template": {
      "name": "Blocked corporates form updated",
      "state": "active",
      "type": "Corporate",
      "data": [
        {
          "type": "header",
          "subtype": "h1",
          "label": "Front ID",
          "access": false
        },
        {
          "type": "textarea",
          "required": false,
          "label": "Comment",
          "className": "form-control",
          "name": "textarea-1580731238278",
          "access": false,
          "subtype": "textarea",
          "maxlength": 250
        },
        {
          "type": "button",
          "label": "Save",
          "subtype": "button",
          "className": "btn-success btn",
          "name": "button-1580731067466",
          "access": false,
          "style": "success"
        },
        {
          "type": "button",
          "label": "Cancel",
          "subtype": "button",
          "className": "btn-default btn",
          "name": "button-1580731082192",
          "access": false,
          "style": "default"
        }
      ],
      "uuid": "cbca7dd8-7b94-459a-b690-e72b13a9a364"
    }
  },
  "headers": {
    "command": "updateTemplate",
    "success": true
  }
}
```

## deleteTemplate

incoming message

```json
{
  "parameters":  {
    "uuid": "b8227854-cced-48bd-8afd-cd6fd2056b69"
  },
  "data": {},
  "headers": {
    "command": "deleteTemplate"
  }
}
```

outgoing message

```json
{
  "parameters": {
    "uuid": "b8227854-cced-48bd-8afd-cd6fd2056b69"
  },
  "data": {},
  "headers": {
    "command": "deleteTemplate",
    "success": true
  }
}
```

# Forms CRUD

## createForm

incoming message

```json
{
  "parameters": {
    "uuid": "50a9c26e-850e-4e3d-9ac4-e458116d50da"
  },
  "data": {
    "user": {
      "id": 2,
      "first_name": "Fourteenth",
      "last_name": "Forcard",
      "email": "11141114@quancy.com.sg",
      "email_validated": true,
      "phone": "11141114",
      "code": "65",
      "address": "Address",
      "status": "ACTIVE",
      "active": true,
      "doc_types": [
        1,
        2,
        3,
        4
      ],
      "doc_required": true,
      "reg_state": 5,
      "send_to_crm": "Y",
      "avatar": {
        "32": "https://sandbox-storage.quancy.com.sg/avatars/23d/32-264ae03c05d1934bd3bbbc79480f1.jpg",
        "64": "https://sandbox-storage.quancy.com.sg/avatars/23d/64-264ae03c05d1934bd3bbbc79480f1.jpg",
        "128": "https://sandbox-storage.quancy.com.sg/avatars/23d/128-264ae03c05d1934bd3bbbc79480f1.jpg"
      },
      "qr": "...",
      "type": "Corporate",
      "phone_formatted": "+65 1114-1114",
      "demo": 1,
      "required_documents": null
    },
    "form": {
      "data": [
        {
          "name": "file-1580731039389",
          "value": "/path_to_saved_file.ext"
        },
        {
          "name": "date-1580731177543",
          "value": "2020.04.22"
        },
        {
          "name": "textarea-1580731238278",
          "value": "Put your text here"
        }
      ]
    }
  },
  "headers": {
    "command": "createForm"
  }
}
```

outgoing message

```json
{
  "parameters": {
    "uuid": "50a9c26e-850e-4e3d-9ac4-e458116d50da"
  },
  "data": {
    "user": {
      "id": 2,
      "first_name": "Fourteenth",
      "last_name": "Forcard",
      "email": "11141114@quancy.com.sg",
      "email_validated": true,
      "phone": "11141114",
      "code": "65",
      "address": "Address",
      "status": "ACTIVE",
      "active": true,
      "doc_types": [
        1,
        2,
        3,
        4
      ],
      "doc_required": true,
      "reg_state": 5,
      "send_to_crm": "Y",
      "avatar": {
        "32": "https://sandbox-storage.quancy.com.sg/avatars/23d/32-264ae03c05d1934bd3bbbc79480f1.jpg",
        "64": "https://sandbox-storage.quancy.com.sg/avatars/23d/64-264ae03c05d1934bd3bbbc79480f1.jpg",
        "128": "https://sandbox-storage.quancy.com.sg/avatars/23d/128-264ae03c05d1934bd3bbbc79480f1.jpg"
      },
      "qr": "...",
      "type": "Corporate",
      "phone_formatted": "+65 1114-1114",
      "demo": 1,
      "required_documents": null
    },
    "form": {
      "data": [
        {
          "name": "file-1580731039389",
          "value": "/path_to_saved_file.ext"
        },
        {
          "name": "date-1580731177543",
          "value": "2020.04.22"
        },
        {
          "name": "textarea-1580731238278",
          "value": "Put your text here"
        }
      ],
      "state": "created",
      "uuid": "7557e178-72b4-43ef-a988-2fd2a3363569"
    }
  },
  "headers": {
    "command": "createForm",
    "success": true
  }
}
```

## getForms

incoming message

```json
{
  "parameters":  {
    "page": 1,
    "limit": 2
  },
  "data": {
    "user": {
      "id": 2,
      "first_name": "Fourteenth",
      "last_name": "Forcard",
      "email": "11141114@quancy.com.sg",
      "email_validated": true,
      "phone": "11141114",
      "code": "65",
      "address": "Address",
      "status": "ACTIVE",
      "active": true,
      "doc_types": [
        1,
        2,
        3,
        4
      ],
      "doc_required": true,
      "reg_state": 5,
      "send_to_crm": "Y",
      "avatar": {
        "32": "https:\/\/sandbox-storage.quancy.com.sg\/avatars\/23d\/32-264ae03c05d1934bd3bbbc79480f1.jpg",
        "64": "https:\/\/sandbox-storage.quancy.com.sg\/avatars\/23d\/64-264ae03c05d1934bd3bbbc79480f1.jpg",
        "128": "https:\/\/sandbox-storage.quancy.com.sg\/avatars\/23d\/128-264ae03c05d1934bd3bbbc79480f1.jpg"
      },
      "qr": "...",
      "type": "Corporate",
      "phone_formatted": "+65 1114-1114",
      "demo": 1,
      "required_documents": null
    }
  },
  "headers": {
    "command": "getForms"
  }
}
```

outgoing message

```json
{
  "parameters": {
    "page": 1,
    "limit": 2
  },
  "data": {
    "user": {
      "id": 2,
      "first_name": "Fourteenth",
      "last_name": "Forcard",
      "email": "11141114@quancy.com.sg",
      "email_validated": true,
      "phone": "11141114",
      "code": "65",
      "address": "Address",
      "status": "ACTIVE",
      "active": true,
      "doc_types": [
        1,
        2,
        3,
        4
      ],
      "doc_required": true,
      "reg_state": 5,
      "send_to_crm": "Y",
      "avatar": {
        "32": "https://sandbox-storage.quancy.com.sg/avatars/23d/32-264ae03c05d1934bd3bbbc79480f1.jpg",
        "64": "https://sandbox-storage.quancy.com.sg/avatars/23d/64-264ae03c05d1934bd3bbbc79480f1.jpg",
        "128": "https://sandbox-storage.quancy.com.sg/avatars/23d/128-264ae03c05d1934bd3bbbc79480f1.jpg"
      },
      "qr": "...",
      "type": "Corporate",
      "phone_formatted": "+65 1114-1114",
      "demo": 1,
      "required_documents": null
    },
    "forms": {
      "data": [
        {
          "id": 1,
          "uuid": "b96a9423-b7df-4a31-8bef-dc490238b30c",
          "client_id": 2,
          "template_id": 1,
          "state_id": 1,
          "data": [
            {
              "name": "file-1580731039389",
              "value": "/path_to_saved_file.ext"
            },
            {
              "name": "date-1580731177543",
              "value": "2020.04.22"
            },
            {
              "name": "textarea-1580731238278",
              "value": "Put your text here"
            }
          ],
          "created_at": "2020-02-06 18:25:59+05:00",
          "updated_at": "2020-02-06 18:25:59+05:00",
          "template": {
            "id": 1,
            "uuid": "cbca7dd8-7b94-459a-b690-e72b13a9a364",
            "name": "Blocked corporates form updated",
            "state": "active",
            "type": "Corporate",
            "data": [
              {
                "type": "header",
                "label": "Front ID",
                "access": false,
                "subtype": "h1"
              },
              {
                "name": "textarea-1580731238278",
                "type": "textarea",
                "label": "Comment",
                "access": false,
                "subtype": "textarea",
                "required": false,
                "className": "form-control",
                "maxlength": 250
              },
              {
                "name": "button-1580731067466",
                "type": "button",
                "label": "Save",
                "style": "success",
                "access": false,
                "subtype": "button",
                "className": "btn-success btn"
              },
              {
                "name": "button-1580731082192",
                "type": "button",
                "label": "Cancel",
                "style": "default",
                "access": false,
                "subtype": "button",
                "className": "btn-default btn"
              }
            ],
            "created_at": "2020-02-06 18:25:09+05:00",
            "updated_at": "2020-02-07 17:52:23+05:00"
          },
          "state": {
            "id": 1,
            "name": "created"
          }
        },
        {
          "id": 2,
          "uuid": "abf93692-0fca-4950-b107-90215b798371",
          "client_id": 2,
          "template_id": 1,
          "state_id": 1,
          "data": [
            {
              "name": "file-1580731039389",
              "value": "/path_to_saved_file.ext"
            },
            {
              "name": "date-1580731177543",
              "value": "2020.04.22"
            },
            {
              "name": "textarea-1580731238278",
              "value": "Put your text here"
            }
          ],
          "created_at": "2020-02-06 18:28:25+05:00",
          "updated_at": "2020-02-06 18:28:25+05:00",
          "template": {
            "id": 1,
            "uuid": "cbca7dd8-7b94-459a-b690-e72b13a9a364",
            "name": "Blocked corporates form updated",
            "state": "active",
            "type": "Corporate",
            "data": [
              {
                "type": "header",
                "label": "Front ID",
                "access": false,
                "subtype": "h1"
              },
              {
                "name": "textarea-1580731238278",
                "type": "textarea",
                "label": "Comment",
                "access": false,
                "subtype": "textarea",
                "required": false,
                "className": "form-control",
                "maxlength": 250
              },
              {
                "name": "button-1580731067466",
                "type": "button",
                "label": "Save",
                "style": "success",
                "access": false,
                "subtype": "button",
                "className": "btn-success btn"
              },
              {
                "name": "button-1580731082192",
                "type": "button",
                "label": "Cancel",
                "style": "default",
                "access": false,
                "subtype": "button",
                "className": "btn-default btn"
              }
            ],
            "created_at": "2020-02-06 18:25:09+05:00",
            "updated_at": "2020-02-07 17:52:23+05:00"
          },
          "state": {
            "id": 1,
            "name": "created"
          }
        }
      ],
      "pagination": {
        "page": 1,
        "limit": 2,
        "count": 12,
        "pages": 6
      }
    }
  },
  "headers": {
    "command": "getForms",
    "success": true
  }
}
```

## getForm

incoming message

```json
{
  "parameters":  {
    "uuid": "b96a9423-b7df-4a31-8bef-dc490238b30c"
  },
  "data": {},
  "headers": {
    "command": "getForm"
  }
}
```

outgoing message

```json
{
  "parameters": {
    "uuid": "b96a9423-b7df-4a31-8bef-dc490238b30c"
  },
  "data": {
    "form": {
      "id": 1,
      "uuid": "b96a9423-b7df-4a31-8bef-dc490238b30c",
      "client_id": 2,
      "template_id": 1,
      "state_id": 1,
      "data": [
        {
          "name": "file-1580731039389",
          "value": "/path_to_saved_file.ext"
        },
        {
          "name": "date-1580731177543",
          "value": "2020.04.22"
        },
        {
          "name": "textarea-1580731238278",
          "value": "Put your text here"
        }
      ],
      "created_at": "2020-02-06 18:25:59+05:00",
      "updated_at": "2020-02-06 18:25:59+05:00",
      "template": {
        "id": 1,
        "uuid": "cbca7dd8-7b94-459a-b690-e72b13a9a364",
        "name": "Blocked corporates form updated",
        "state": "active",
        "type": "Corporate",
        "data": [
          {
            "type": "header",
            "label": "Front ID",
            "access": false,
            "subtype": "h1"
          },
          {
            "name": "textarea-1580731238278",
            "type": "textarea",
            "label": "Comment",
            "access": false,
            "subtype": "textarea",
            "required": false,
            "className": "form-control",
            "maxlength": 250
          },
          {
            "name": "button-1580731067466",
            "type": "button",
            "label": "Save",
            "style": "success",
            "access": false,
            "subtype": "button",
            "className": "btn-success btn"
          },
          {
            "name": "button-1580731082192",
            "type": "button",
            "label": "Cancel",
            "style": "default",
            "access": false,
            "subtype": "button",
            "className": "btn-default btn"
          }
        ],
        "created_at": "2020-02-06 18:25:09+05:00",
        "updated_at": "2020-02-07 17:52:23+05:00"
      },
      "state": {
        "id": 1,
        "name": "created"
      }
    }
  },
  "headers": {
    "command": "getForm",
    "success": true
  }
}
```

## updateForm

incoming message

```json
{
  "parameters": {
    "uuid": "7557e178-72b4-43ef-a988-2fd2a3363569"
  },
  "data": {
    "form": {
      "data": [
        {
          "name": "file-1580731039389",
          "value": "/path_to_saved_file.ext"
        },
        {
          "name": "date-1580731177543",
          "value": "2020.04.22"
        },
        {
          "name": "textarea-1580731238278",
          "value": "Put your text here"
        }
      ],
      "state": "filled"
    }
  },
  "headers": {
    "command": "updateForm"
  }
}
```

outgoing message

```json
{
  "parameters": {
    "uuid": "bbd94562-b607-4a07-88e1-93063ba39538"
  },
  "data": {
    "form": {
      "data": [
        {
          "name": "file-1580731039389",
          "value": "/path_to_saved_file.ext"
        },
        {
          "name": "date-1580731177543",
          "value": "2020.04.22"
        },
        {
          "name": "textarea-1580731238278",
          "value": "Put your text here"
        }
      ],
      "state": "filled",
      "uuid": "bbd94562-b607-4a07-88e1-93063ba39538"
    }
  },
  "headers": {
    "command": "updateForm",
    "success": true
  }
}
```

## deleteForm

incoming message

```json
{
  "parameters":  {
    "uuid": "079b74cf-086a-4012-bf8a-8c33d202e65d"
  },
  "data": {},
  "headers": {
    "command": "deleteForm"
  }
}
```

outgoing message

```json
{
  "parameters":  {
    "uuid": "079b74cf-086a-4012-bf8a-8c33d202e65d"
  },
  "data": {},
  "headers": {
    "command": "deleteForm",
    "success": true
  }
}
```
