<?php

return [
    'defaults'      => [
        'wrapper_class'       => 'form-group',
        'wrapper_error_class' => 'has-error',
        'label_class'         => 'control-label',
        'field_class'         => 'form-control',
        'field_error_class'   => '',
        'help_block_class'    => 'help-block',
        'error_class'         => 'text-danger',
        'required_class'      => 'required'

        // Override a class from a field.
        //'text'                => [
        //    'wrapper_class'   => 'form-field-text',
        //    'label_class'     => 'form-field-text-label',
        //    'field_class'     => 'form-field-text-field',
        //]
        //'radio'               => [
        //    'choice_options'  => [
        //        'wrapper'     => ['class' => 'form-radio'],
        //        'label'       => ['class' => 'form-radio-label'],
        //        'field'       => ['class' => 'form-radio-field'],
        //],
    ],
    // Templates
    'form'          => 'form',
    'text'          => 'text',
    'textarea'      => 'textarea',
    'select'        => 'select',
    'radio'        => 'radio',
    'checkbox'        => 'checkbox',
    'button'        => 'button',

    // Remove the laravel-form-builder:: prefix above when using template_prefix
    'template_prefix'   => config('administration.admin_prefix') . '::components.',

    'default_namespace' => '',

    'custom_fields' => [
        'file' => \Charlotte\Administration\Forms\Fields\FileType::class,
        'switch' => \Charlotte\Administration\Forms\Fields\SwitchType::class,
        'group' => \Charlotte\Administration\Forms\Fields\GroupType::class,
        'multiple' => \Charlotte\Administration\Forms\Fields\MultipleType::class,
        'email' => \Charlotte\Administration\Forms\Fields\EmailType::class,
        'password' => \Charlotte\Administration\Forms\Fields\PasswordType::class,
        'date' => \Charlotte\Administration\Forms\Fields\DateType::class,
        'time' => \Charlotte\Administration\Forms\Fields\TimeType::class,
        'color' => \Charlotte\Administration\Forms\Fields\ColorType::class,
        'editor' => \Charlotte\Administration\Forms\Fields\EditorType::class,
        'radio' => \Charlotte\Administration\Forms\Fields\RadioType::class,
        'select' => \Charlotte\Administration\Forms\Fields\CustomSelectType::class,
        'map' => \Charlotte\Administration\Forms\Fields\MapType::class,
        'button' => \Charlotte\Administration\Forms\Fields\CustomButtonType::class,
        'box' => \Charlotte\Administration\Forms\Fields\BoxType::class,

    ]
];
