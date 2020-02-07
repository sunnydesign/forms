<?php

namespace Kubia\Provider\Forms;

use Kubia\Provider\Provider;
use Kubia\Provider\Exception\BusinessException;
use \Exception;

class Service extends Provider
{
    const LIMIT = 50;

    public $availableMethods = [
        'getTemplateList',
        'getTemplate',
        'createTemplate',
        'updateTemplate',
        'deleteTemplate',

        'getFormList',
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
        $this->checkParameters(['form'], $data);
        $this->checkParameters(['template'], $data->form);
        $this->checkParameters(['name', 'state', 'data'], $data->form->template);

        $incoming_template = $data->form->template;

        // Save template into DB
        $template = Template::create([
            'name' => $incoming_template->name,
            'state' => $incoming_template->state,
            'type' => $incoming_template->type,
            'data' => json_encode($incoming_template->data)
        ]);

        $data->form->template->uuid = $template->uuid;

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
    public function getTemplateList(object $parameters, object $data, object $headers): object
    {
        $data->form = (object)[];

        // Set limit and offset
        $page = $parameters->page ?? 1;
        $limit = $parameters->limit ?? self::LIMIT;
        $offset = $limit * ($page - 1);

        // Get templates from DB
        $templates = Template::take($limit)->skip($offset)->get();

        // If found forms
        if(!empty($templates)) {
            foreach($templates as $template) {
                $templates_list[] = [
                    'id' => $template->id,
                    'uuid' => $template->uuid,
                    'name' => $template->name,
                    'state' => $template->state,
                    'type' => $template->type,
                    'data' => json_decode($template->data)
                ];
            }
        }

        $data->form->templates = $templates_list ?? [];

        // Count and pages
        $count = $templates->count();
        $parameters->page = $page;
        $parameters->limit = $limit;
        $parameters->count = $count;
        $parameters->pages = ceil($count / $limit);

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
        $data->form = (object)[];
        $data->form->templates = [];

        $this->checkParameters(['uuid'], $parameters);

        // Get template from DB
        $template = Template::whereUuid($parameters->uuid)->first();

        // If found form
        if(!empty($template)) {
            $data->form->templates[] = [
                'id' => $template->id,
                'uuid' => $template->uuid,
                'name' => $template->name,
                'state' => $template->state,
                'type' => $template->type,
                'data' => json_decode($template->data)
            ];
        }

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
        $this->checkParameters(['form'], $data);
        $this->checkParameters(['template'], $data->form);
        $this->checkParameters(['name', 'state', 'data'], $data->form->template);
        $this->checkParameters(['uuid'], $parameters);

        $incoming_template = $data->form->template;

        // Save form in to DB
        $template = Template::whereUuid($parameters->uuid)->first();
        $template->name = $incoming_template->name;
        $template->state = $incoming_template->state;
        $template->type = $incoming_template->type;
        $template->data = json_encode($incoming_template->data);
        $template->save();

        $data->form->templates[] = [
            'id' => $template->id,
            'uuid' => $template->uuid,
            'name' => $template->name,
            'state' => $template->state,
            'type' => $template->type,
            'data' => json_decode($template->data)
        ];

        //$data->form->template->uuid = $template->uuid;

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
        $this->checkParameters(['form'], $data->form);
        $this->checkParameters(['data'], $data->form->form);

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
            'data' => json_encode($data->form->form->data)
        ]);

        $data->form->form->state = $state->name;
        $data->form->form->uuid = $form->uuid;

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
    public function getFormList(object $parameters, object $data, object $headers): object
    {
        $data->form = (object)[];

        // Set limit and offset
        $page = $parameters->page ?? 1;
        $limit = $parameters->limit ?? self::LIMIT;
        $offset = $limit * ($page - 1);

        // Get forms from DB considering client id
        if(property_exists($data, 'user') && property_exists($data->user, 'id'))
            $forms = Form::whereClientId($data->user->id)->take($limit)->skip($offset)->get();
        else
            $forms = Form::take($limit)->skip($offset)->get();

        // If found forms
        if(!empty($forms)) {
            foreach($forms as $form) {
                $forms_list[] = [
                    'id' => $form->id,
                    'uuid' => $form->uuid,
                    'state' => $form->state->name,
                    'data' => json_decode($form->data)
                ];
            }
        }

        $data->form->forms = $forms_list ?? [];

        // Count and pages
        $count = $forms->count();
        $parameters->page = $page;
        $parameters->limit = $limit;
        $parameters->count = $count;
        $parameters->pages = ceil($count / $limit);

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
        $data->form = (object)[];
        $data->form->forms = [];

        $this->checkParameters(['uuid'], $parameters);

        // Get form from DB
        $form = Form::whereUuid($parameters->uuid)->first();

        // If found form
        if(!empty($form)) {
            $data->form->forms[] = [
                'id' => $form->id,
                'uuid' => $form->uuid,
                'state' => $form->state->name,
                'data' => json_decode($form->data)
            ];
        }

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
        $this->checkParameters(['form'], $data->form);
        $this->checkParameters(['state', 'data'], $data->form->form);
        $this->checkParameters(['uuid'], $parameters);

        $incoming_form = $data->form->form;

        $state = State::whereName($incoming_form->state)->first();
        if(!$state)
            throw BusinessException('Incorrect state name');

        // Save form in to DB
        $form = Form::whereUuid($parameters->uuid)->first();
        $form->state_id = $state->id;
        $form->data = json_encode($incoming_form->data);
        $form->save();

        $data->form->forms[] = [
            'id' => $form->id,
            'uuid' => $form->uuid,
            'state' => $form->state->name,
            'data' => json_decode($form->data)
        ];

        //$data->form->form->uuid = $form->uuid;

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
