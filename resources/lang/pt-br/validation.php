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

    'accepted'             => 'O campo :attribute deve ser aceito.',
    'active_url'           => 'O campo :attribute não é uma URL válida.',
    'after'                => 'O campo :attribute deve ser uma data posterior à :date.',
    'alpha'                => 'O campo :attribute pode conter somente letras.',
    'alpha_dash'           => 'O campo :attribute pode conter somente letras, números, e traços.',
    'alpha_num'            => 'O campo :attribute pode conter somente letras e números.',
    'array'                => 'O campo :attribute deve ser um array.',
    'before'               => 'O campo :attribute deve ser uma data anterior à :date.',
    'between'              => [
        'numeric' => 'O campo :attribute deve estar entre :min and :max.',
        'file'    => 'O campo :attribute deve ter entre :min and :max kilobytes.',
        'string'  => 'O campo :attribute deve ter entre :min and :max caracteres.',
        'array'   => 'O campo :attribute deve ter entre :min and :max items.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação de :attribute não corresponde.',
    'date'                 => 'O campo :attribute não é uma data válida.',
    'date_format'          => 'O campo :attribute não corresponde ao formato :format.',
    'different'            => 'O campo :attribute e :other devem ser diferentes.',
    'digits'               => 'O campo :attribute deve ter :digits digitos.',
    'digits_between'       => 'O campo :attribute deve estar entre :min e :max digitos.',
    'dimensions'           => 'O campo :attribute tem dimensões de imagem inválidas.',
    'distinct'             => 'O campo :attribute tem um valor duplicado.',

    'email'                => 'O campo :attribute deve ser um endereço de e-mail válido.',
    'exists'               => 'O valor selecionado para :attribute é inválido.',
    'file'                 => 'O campo :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute é obrigatório.',
    'image'                => 'O campo :attribute deve ser uma imagem.',
    'in'                   => 'O valor selecionado para o campo :attribute é inválido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O campo :attribute deve ser um inteiro.',
    'ip'                   => 'O campo :attribute deve ser um endereço de IP válido.',
    'json'                 => 'O campo :attribute deve ser uma string JSON válida.',
    'max'                  => [
        'numeric' => 'O campo :attribute não pode ser maior que :max.',
        'file'    => 'O campo :attribute não pode ser maior que :max kilobytes.',
        'string'  => 'O campo :attribute não pode ser maior que :max caracteres.',
        'array'   => 'O campo :attribute não pode ter mais que :max items.',
    ],
    'mimes'                => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O campo :attribute deve ter pelo menos :min.',
        'file'    => 'O campo :attribute deve ter pelo menos :min kilobytes.',
        'string'  => 'O campo :attribute deve ter pelo menos :min caracteres.',
        'array'   => 'O campo :attribute deve ter pelo menos :min item(s).',
    ],
    'not_in'               => 'O valor selecionado para :attribute é inválido.',
    'numeric'              => 'O campo :attribute deve ser um número.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O formato do campo :attribute é invalido.',
    'required'             => 'O campo :attribute é obrigatório.',

    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O campo :attribute é obrigatório a menos que :other esteja em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values está(ão) presente(s).',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum(a) valor de :values está presente.',
    'same'                 => 'O campo :attribute e :other devem corresponder.',
    'size'                 => [
        'numeric' => 'O campo :attribute deve ter :size.',
        'file'    => 'O campo :attribute deve ter :size kilobytes.',
        'string'  => 'O campo :attribute deve ter :size caracteres.',
        'array'   => 'O campo :attribute deve ter :size items.',
    ],
    'string'               => 'O campo :attribute deve ser uma string.',
    'timezone'             => 'O campo :attribute deve ser uma zona de tempo válida.',
    'unique'               => 'O :attribute já está em uso.',
    'uploaded'             => 'O campo :attribute faliu no upload.',
    'url'                  => 'O formato de :attribute é inválido.',

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

    'attributes' => [
        'name' => 'nome',
        'email' => 'e-mail',
        'message' => 'mensagem',
        'description' => 'descrição',
        'categories' => 'categorias',
        'password' => 'senha',
        'password_confirmation' => 'confirmação da senha',
        'title' => 'título',
        'content' => 'conteúdo',
        'disk' => 'disco',
        'files' => 'arquivos',
    ],

];
