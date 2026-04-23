<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines — pt_BR
    |--------------------------------------------------------------------------
    |
    | As mensagens de validação padrão do Laravel traduzidas para português
    | brasileiro. Inclui as mensagens específicas para a regra de senha.
    |
    */

    'accepted'             => 'O campo :attribute deve ser aceito.',
    'active_url'           => 'O campo :attribute não contém um URL válido.',
    'after'                => 'O campo :attribute deve ser uma data posterior a :date.',
    'after_or_equal'       => 'O campo :attribute deve ser uma data igual ou posterior a :date.',
    'alpha'                => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash'           => 'O campo :attribute deve conter apenas letras, números, hífens e sublinhados.',
    'alpha_num'            => 'O campo :attribute deve conter apenas letras e números.',
    'array'                => 'O campo :attribute deve ser um array.',
    'before'               => 'O campo :attribute deve ser uma data anterior a :date.',
    'before_or_equal'      => 'O campo :attribute deve ser uma data igual ou anterior a :date.',
    'between'              => [
        'array'   => 'O campo :attribute deve conter entre :min e :max itens.',
        'file'    => 'O campo :attribute deve ter entre :min e :max kilobytes.',
        'numeric' => 'O campo :attribute deve estar entre :min e :max.',
        'string'  => 'O campo :attribute deve ter entre :min e :max caracteres.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação de :attribute não coincide.',
    'current_password'     => 'A senha atual está incorreta.',
    'date'                 => 'O campo :attribute não contém uma data válida.',
    'date_equals'          => 'O campo :attribute deve ser uma data igual a :date.',
    'date_format'          => 'O campo :attribute não corresponde ao formato :format.',
    'different'            => 'Os campos :attribute e :other devem ser diferentes.',
    'digits'               => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between'       => 'O campo :attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => 'O campo :attribute tem dimensões de imagem inválidas.',
    'distinct'             => 'O campo :attribute possui um valor duplicado.',
    'email'                => 'O campo :attribute deve conter um endereço de e-mail válido.',
    'ends_with'            => 'O campo :attribute deve terminar com um dos seguintes valores: :values.',
    'exists'               => 'O valor selecionado para :attribute é inválido.',
    'file'                 => 'O campo :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute deve ter um valor.',
    'gt'                   => [
        'array'   => 'O campo :attribute deve ter mais de :value itens.',
        'file'    => 'O campo :attribute deve ter mais de :value kilobytes.',
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'string'  => 'O campo :attribute deve ter mais de :value caracteres.',
    ],
    'gte'                  => [
        'array'   => 'O campo :attribute deve ter :value itens ou mais.',
        'file'    => 'O campo :attribute deve ter :value kilobytes ou mais.',
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'string'  => 'O campo :attribute deve ter :value caracteres ou mais.',
    ],
    'image'                => 'O campo :attribute deve ser uma imagem.',
    'in'                   => 'O valor selecionado para :attribute é inválido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O campo :attribute deve ser um número inteiro.',
    'ip'                   => 'O campo :attribute deve conter um endereço IP válido.',
    'ipv4'                 => 'O campo :attribute deve conter um endereço IPv4 válido.',
    'ipv6'                 => 'O campo :attribute deve conter um endereço IPv6 válido.',
    'json'                 => 'O campo :attribute deve conter uma string JSON válida.',
    'lt'                   => [
        'array'   => 'O campo :attribute deve ter menos de :value itens.',
        'file'    => 'O campo :attribute deve ter menos de :value kilobytes.',
        'numeric' => 'O campo :attribute deve ser menor que :value.',
        'string'  => 'O campo :attribute deve ter menos de :value caracteres.',
    ],
    'lte'                  => [
        'array'   => 'O campo :attribute deve ter :value itens ou menos.',
        'file'    => 'O campo :attribute deve ter :value kilobytes ou menos.',
        'numeric' => 'O campo :attribute deve ser menor ou igual a :value.',
        'string'  => 'O campo :attribute deve ter :value caracteres ou menos.',
    ],
    'max'                  => [
        'array'   => 'O campo :attribute não deve ter mais que :max itens.',
        'file'    => 'O campo :attribute não deve ter mais que :max kilobytes.',
        'numeric' => 'O campo :attribute não deve ser maior que :max.',
        'string'  => 'O campo :attribute não deve ter mais que :max caracteres.',
    ],
    'mimes'                => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'array'   => 'O campo :attribute deve ter pelo menos :min itens.',
        'file'    => 'O campo :attribute deve ter pelo menos :min kilobytes.',
        'numeric' => 'O campo :attribute deve ser no mínimo :min.',
        'string'  => 'O campo :attribute deve ter pelo menos :min caracteres.',
    ],
    'multiple_of'          => 'O campo :attribute deve ser um múltiplo de :value.',
    'not_in'               => 'O valor selecionado para :attribute é inválido.',
    'not_regex'            => 'O formato do campo :attribute é inválido.',
    'numeric'              => 'O campo :attribute deve ser um número.',
    'password'             => [
        'letters'       => 'A :attribute deve conter pelo menos uma letra.',
        'mixed'         => 'A :attribute deve conter pelo menos uma letra maiúscula e uma minúscula.',
        'numbers'       => 'A :attribute deve conter pelo menos um número.',
        'symbols'       => 'A :attribute deve conter pelo menos um caractere especial (ex: !@#$%).',
        'uncompromised' => 'Esta :attribute foi encontrada em vazamentos de dados. Por favor, escolha uma senha diferente.',
    ],
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O formato do campo :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O campo :attribute é obrigatório a menos que :other esteja em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values estão presentes.',
    'same'                 => 'Os campos :attribute e :other devem ser iguais.',
    'size'                 => [
        'array'   => 'O campo :attribute deve conter :size itens.',
        'file'    => 'O campo :attribute deve ter :size kilobytes.',
        'numeric' => 'O campo :attribute deve ser :size.',
        'string'  => 'O campo :attribute deve ter :size caracteres.',
    ],
    'starts_with'          => 'O campo :attribute deve começar com um dos seguintes valores: :values.',
    'string'               => 'O campo :attribute deve ser uma string.',
    'timezone'             => 'O campo :attribute deve ser um fuso horário válido.',
    'unique'               => 'Este :attribute já está em uso.',
    'uploaded'             => 'Falha no upload do :attribute.',
    'url'                  => 'O formato do campo :attribute é inválido.',
    'uuid'                 => 'O campo :attribute deve ser um UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Atributos Customizados
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'name'                  => 'nome',
        'email'                 => 'e-mail',
        'password'              => 'senha',
        'password_confirmation' => 'confirmação de senha',
        'current_password'      => 'senha atual',
    ],

];
