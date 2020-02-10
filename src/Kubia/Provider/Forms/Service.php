<?php

namespace Kubia\Provider\Forms;

use Kubia\Provider\Provider;
use Kubia\Provider\Exception\BusinessException;
use \Exception;

class Service extends Provider
{
    use Paginated;

    const LIMIT = 50;

    public $availableMethods = [
        'getTemplates',
        'getTemplate',
        'createTemplate',
        'updateTemplate',
        'deleteTemplate',

        'getForms',
        'getForm',
        'createForm',
        'updateForm',
        'deleteForm'
    ];

    public function getAvailableMethods()
    {
        return array_merge(parent::getAvailableMethods(), $this->availableMethods);
    }

    /**
     * Add new form template into DB
     *
     * @param object $parameters
     * @param object $data
     * @param object $headers
     * @return object
     * @throws Exception
     */
    public function createTemplate(object $parameters, object $data, object $headers): object
    {
        $this->checkParameters(['template'], $data);
        $this->checkParameters(['name', 'state', 'data'], $data->template);

        // Save template into DB
        $template = Template::create([
            'name' => $data->template->name,
            'state' => $data->template->state,
            'type' => $data->template->type,
            'data' => json_encode($data->template->data)
        ]);

        $data->template->uuid = $template->uuid;

        return $data;
    }

    /**
     * Get template list with pagination
     *
     * @param object $parameters
     * @param object $data
     * @param object $headers
     * @return object
     */
    public function getTemplates(object $parameters, object $data, object $headers): object
    {
        // Get templates from DB considering client id
        $templates = new Template();

        if(property_exists($data, 'user') && property_exists($data->user, 'id'))
            $templates->whereClientId($data->user->id);

        $data->templates = $this->getPaginated($templates, $parameters);

        return $data;
    }

    /**
     * Get template by uuid
     *
     * @param object $parameters
     * @param object $data
     * @param object $headers
     * @return object
     * @throws Exception
     */
    public function getTemplate(object $parameters, object $data, object $headers): object
    {
        $data->template = [];

        $this->checkParameters(['uuid'], $parameters);

        // Get template from DB
        $data->template = Template::whereUuid($parameters->uuid)->first();

        return $data;
    }

    /**
     * Update template by uuid
     *
     * @param object $parameters
     * @param object $data
     * @param object $headers
     * @return object
     * @throws Exception
     */
    public function updateTemplate(object $parameters, object $data, object $headers): object
    {
        $this->checkParameters(['template'], $data);
        $this->checkParameters(['name', 'state', 'data'], $data->template);
        $this->checkParameters(['uuid'], $parameters);

        // Save form in to DB
        $template = Template::whereUuid($parameters->uuid)->first();
        $template->name = $data->template->name;
        $template->state = $data->template->state;
        $template->type = $data->template->type;
        $template->data = json_encode($data->template->data);
        $template->save();

        $data->template->uuid = $template->uuid;

        return $data;
    }

    /**
     * Delete template from DB
     *
     * @param object $parameters
     * @param object $data
     * @param object $headers
     * @return object
     * @throws Exception
     */
    public function deleteTemplate(object $parameters, object $data, object $headers): object
    {
        $this->checkParameters(['uuid'], $parameters);

        // Get template from DB
        $template = Template::whereUuid($parameters->uuid)->first();

        if(!$template)
            throw new BusinessException('Template not found');

        // Delete template
        $template->delete();

        return $data;
    }

    /**
     * Create form based on a template and save it into DB
     *
     * @param object $parameters
     * @param object $data
     * @param object $headers
     * @return object
     * @throws Exception
     */
    public function createForm(object $parameters, object $data, object $headers): object
    {
        $this->checkParameters(['user', 'form'], $data);
        $this->checkParameters(['id'], $data->user);
        $this->checkParameters(['data'], $data->form);

        // @todo:form validation

        // Get template from DB
        $template = Template::whereUuid($parameters->uuid)->first();
        $state = State::whereName('created')->first();

        if(!$template)
            throw new BusinessException('Template not found');

        // Save form into DB
        $form = Form::create([
            'template_id' => $template->id,
            'client_id' => $data->user->id,
            'state_id' => $state->id,
            'data' => json_encode($data->form->data)
        ]);

        $data->form->state = $state->name;
        $data->form->uuid = $form->uuid;

        return $data;
    }

    /**
     * Get form list optionally considering client id
     *
     * @param object $parameters
     * @param object $data
     * @param object $headers
     * @return object
     */
    public function getForms(object $parameters, object $data, object $headers): object
    {
        // Get forms from DB considering client id
        $forms = new Form();

        if(property_exists($data, 'user') && property_exists($data->user, 'id'))
            $forms->whereClientId($data->user->id);

        $data->forms = $this->getPaginated($forms->with('template', 'state'), $parameters);

        return $data;
    }

    /**
     * Get form by uuid
     *
     * @param object $parameters
     * @param object $data
     * @param object $headers
     * @return object
     * @throws Exception
     */
    public function getForm(object $parameters, object $data, object $headers): object
    {
        $this->checkParameters(['uuid'], $parameters);

        // Get form from DB
        $data->form = Form::whereUuid($parameters->uuid)->with('template', 'state')->first();

        return $data;
    }

    /**
     * Update form by uuid
     *
     * @param object $parameters
     * @param object $data
     * @param object $headers
     * @return object
     * @throws Exception
     */
    public function updateForm(object $parameters, object $data, object $headers): object
    {
        $this->checkParameters(['form'], $data);
        $this->checkParameters(['state', 'data'], $data->form);
        $this->checkParameters(['uuid'], $parameters);

        $state = State::whereName($data->form->state)->first();
        if(!$state)
            throw BusinessException('Incorrect state name');

        // Save form in to DB
        $form = Form::whereUuid($parameters->uuid)->first();
        $form->state_id = $state->id;
        $form->data = json_encode($data->form->data);
        $form->save();

        $data->form->uuid = $form->uuid;

        return $data;
    }

    /**
     * Delete form from DB
     *
     * @param object $parameters
     * @param object $data
     * @param object $headers
     * @return object
     * @throws BusinessException
     */
    public function deleteForm(object $parameters, object $data, object $headers): object
    {
        $this->checkParameters(['uuid'], $parameters);

        // Get form from DB
        $form = Form::whereUuid($parameters->uuid)->first();

        if(!$form)
            throw new BusinessException('Form not found');

        // Delete form
        $form->delete();

        return $data;
    }

}
