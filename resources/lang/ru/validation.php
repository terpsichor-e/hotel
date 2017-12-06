<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':Attribute должен быть принят.',
    'active_url'           => ':Attribute не является валидноы.',
    'after'                => ':Attribute должна быть позже :date.',
    'after_or_equal'       => ':Attribute должна быть не ранее :date.',
    'alpha'                => ':Attribute может содержать только буквы.',
    'alpha_dash'           => ':Attribute может содержать только буквы, цифры, подчёркивания и дефисы.',
    'alpha_num'            => ':Attribute может содержать только буквы, и цифры.',
    'array'                => ':Attribute должен быть массивом.',
    'before'               => ':Attribute должен быть раньше :date.',
    'before_or_equal'      => ':Attribute должен быть не позже :date.',
    'between'              => [
        'numeric' => ':Attribute должен быть в диапазоне от :min до :max.',
        'file'    => ':Attribute должен весить от :min до :max КБ.',
        'string'  => ':Attribute должен содержать от :min до :max символов.',
        'array'   => ':Attribute должен содержать от :min до :max элементов.',
    ],
    'boolean'              => ':Attribute должен быть да или нет.',
    'confirmed'            => ':Attribute подтверждение не совпадает.',
    'date'                 => ':Attribute не является датой.',
    'date_format'          => ':Attribute не является датой.',
    'different'            => ':Attribute и :Other должны быть разные.',
    'digits'               => ':Attribute must be :digits digits.',
    'digits_between'       => ':Attribute must be between :min and :max digits.',
    'dimensions'           => ':Attribute has invalid image dimensions.',
    'distinct'             => ':Attribute field has a duplicate value.',
    'email'                => ':Attribute должен быть правильным E-Mail адресом.',
    'exists'               => 'Выбранный :attribute некорректен.',
    'file'                 => ':Attribute должен быть файлом.',
    'filled'               => ':Attribute должен содержать значение.',
    'image'                => ':Attribute должен быть картинкой.',
    'in'                   => 'Выбранный :attribute некорректен.',
    'in_array'             => ':Attribute не содержится в :Other.',
    'integer'              => ':Attribute должен быть числом.',
    'ip'                   => ':Attribute должен быть IP адресом.',
    'ipv4'                 => ':Attribute должен быть IPv4 адресом.',
    'ipv6'                 => ':Attribute должен быть IPv6 адресом.',
    'json'                 => ':Attribute должен быть в JSON формате.',
    'max'                  => [
        'numeric' => ':Attribute не может быть больше :max.',
        'file'    => ':Attribute не может весить больше :max КБ.',
        'string'  => ':Attribute не может быть длиннее :max символов.',
        'array'   => ':Attribute не может содержать более :max элементов.',
    ],
    'mimes'                => ':Attribute должен быть файлом типа: :values.',
    'mimetypes'            => ':Attribute должен быть файлом типа: :values.',
    'min'                  => [
        'numeric' => ':Attribute не может быть меньше :min.',
        'file'    => ':Attribute не может весить меньше :min КБ.',
        'string'  => ':Attribute не может быть короче :min символов.',
        'array'   => ':Attribute не может содержать меньше :min элементов.',
    ],
    'not_in'               => 'Выборанный :attribute некорректен.',
    'numeric'              => ':Attribute должен быть числом.',
    'present'              => ':Attribute должен присутствовать.',
    'regex'                => ':Attribute формат некорректен.',
    'required'             => 'Поле обязательно.',
    'required_if'          => 'Поле :attribute обязательно, когда :other равен :value.',
    'required_unless'      => 'Поле :attribute обязательно, если :other не равен :values.',
    'required_with'        => 'Поле :attribute обязательно, когда одно из :values задано.',
    'required_with_all'    => 'Поле :attribute обязательно, когда все :values заданы.',
    'required_without'     => 'Поле :attribute обязательно, когда одно из :values не заданно.',
    'required_without_all' => 'Поле :attribute обязательно, когда все :values не заданы.',
    'same'                 => 'Поле :Attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => ':Attribute должен быть размером :size.',
        'file'    => ':Attribute должен весить :size КБ.',
        'string'  => ':Attribute должен содержать :size символов.',
        'array'   => ':Attribute должен содержать :size элементов.',
    ],
    'string'               => ':Attribute должно быть строкой.',
    'timezone'             => ':Attribute должно быть временной зоной.',
    'unique'               => ':Attribute уже занят.',
    'uploaded'             => ':Attribute не удалось загрузить.',
    'url'                  => ':Attribute формат не корректен.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
