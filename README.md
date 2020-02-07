# Forms Engine

Form engine microservice is used for CRUD operations with form templates and form data.
Serves requests from back-office and front-end.

# Available commands
- **getTemplateList** - Get template list with pagination
- **getTemplate** - Get template by uuid
- **createTemplate** - Add new form template into DB
- **updateTemplate** - Update template by uuid
- **deleteTemplate** - Delete template from DB
- **getFormList** - Get form list optionally considering client id
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
    "form": {
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
    "form": {
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
    }
  },
  "headers": {
    "command": "createTemplate",
    "success": true
  }
}
```

## getTemplateList

incoming message

```json
{
  "parameters":  {
    "page": 1,
    "limit": 2
  },
  "data": {},
  "headers": {
    "command": "getTemplateList"
  }
}
```

outgoing message

```json
{
  "parameters": {
    "page": 1,
    "limit": 2,
    "count": 2,
    "pages": 1
  },
  "data": {
    "form": {
      "templates": [
        {
          "id": 1,
          "uuid": "cbca7dd8-7b94-459a-b690-e72b13a9a364",
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
          ]
        },
        {
          "id": 2,
          "uuid": "b88c33d6-40de-40a5-af0f-3ccbda3dae03",
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
          ]
        }
      ]
    }
  },
  "headers": {
    "command": "getTemplateList",
    "success": true
  }
}
```

## getTemplate

incoming message

```json
{
  "parameters":  {
    "uuid": "c44b1d83-6b6d-4721-a7a9-723be37e88c4"
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
    "uuid": "cbca7dd8-7b94-459a-b690-e72b13a9a364"
  },
  "data": {
    "form": {
      "templates": [
        {
          "id": 1,
          "uuid": "cbca7dd8-7b94-459a-b690-e72b13a9a364",
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
          ]
        }
      ]
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
    "uuid": "cbca7dd8-7b94-459a-b690-e72b13a9a364"
  },
  "data": {
    "form": {
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
    "form": {
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
      },
      "templates": [
        {
          "id": 1,
          "uuid": "cbca7dd8-7b94-459a-b690-e72b13a9a364",
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
      ]
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
    }
  },
  "headers": {
    "command": "createForm",
    "success": true
  }
}
```

## getFormList

incoming message

```json
{
  "parameters":  {
    "page": 1,
    "limit": 10
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
    "command": "getFormList"
  }
}
```

outgoing message

```json
{
  "parameters": {
    "page": 1,
    "limit": 10,
    "count": 2,
    "pages": 1
  },
  "data": {
    "user": {
      "id": 1,
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
      "forms": [
        {
          "id": 6,
          "uuid": "bbd94562-b607-4a07-88e1-93063ba39538",
          "state": "created",
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
        },
        {
          "id": 7,
          "uuid": "9b1f60f1-a07d-4925-b26a-86900dd7666f",
          "state": "created",
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
      ]
    }
  },
  "headers": {
    "command": "getFormList",
    "success": true
  }
}
```

## getForm

incoming message

```json
{
  "parameters":  {
    "uuid": "bbd94562-b607-4a07-88e1-93063ba39538"
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
    "uuid": "bbd94562-b607-4a07-88e1-93063ba39538"
  },
  "data": {
    "form": {
      "forms": [
        {
          "id": 6,
          "uuid": "bbd94562-b607-4a07-88e1-93063ba39538",
          "state": "created",
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
      ]
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
    "uuid": "bbd94562-b607-4a07-88e1-93063ba39538"
  },
  "data": {
    "form": {
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
         "uuid": "7557e178-72b4-43ef-a988-2fd2a3363569"
      }
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
      },
      "forms": [
        {
          "id": 6,
          "uuid": "bbd94562-b607-4a07-88e1-93063ba39538",
          "state": "filled",
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
      ]
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
    "success": "true"
  }
}
```
