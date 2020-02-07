# Changelog

Form engine microservice is used for CRUD operations with form templates and form data.
Serves requests from back-office and front-end.

## [Unreleased]

### Planned
- Nothing

## [1.0] - 2020-02-07

### Added

- getTemplateList() - Get template list with pagination
- getTemplate() - Get template by uuid
- createTemplate() - Add new form template into DB
- updateTemplate() - Update template by uuid
- deleteTemplate() - Delete template from DB
- getFormList() - Get form list optionally considering client id
- getForm() - Get form by uuid
- createForm() - Create a form based on a template and save it into DB
- updateForm() - Update form by uuid
- deleteForm() - Delete form from DB


[unreleased]: https://gitlab.com/kubia/forms/-/tags/1.0
[1.0]: https://gitlab.com/kubia/forms/-/tags/1.0
