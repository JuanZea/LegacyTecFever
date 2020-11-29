<?php

return [
    'titles' => [
        'index' => 'Gestión de productos',
        'create' => 'Creación de producto',
        'update' => 'Actualización de producto',
        'import' => 'Importar producto',
        'export' => 'Exportar producto'
    ],
    'messages' => [
        'import' => ':count productos se han importado con éxito',
        'export' => 'Los productos se han exportado con éxito'
    ],
    'error_messages' => [
        'name' => [
            'required' => 'Su producto necesita un nombre',
            'min' => 'El nombre debe tener al menos 3 letras',
            'max' => 'No superes los 80 caracteres y mantén la calma'
        ],
        'description' => [
            'required' => 'La descripción es muy importante, no la olvides',
            'min' => 'Esfuérzate y obtén mínimo 10 caracteres',
            'max' => 'No me cuentes tu vida, máximo 1000 caracteres para la descripción'
        ],
        'category' => [
            'in' => 'Sin trampas, elige una de las 3 categorías'
        ],
        'image' => [
            'image' => 'Verifica que lo que estás subiendo es una imagen'
        ],
        'price' => [
            'required' => 'Incluso si es barato, ponle un precio',
            'digits_between' => 'El precio mínimo es de 4 dígitos y el máximo de 9'
        ],
        'stock' => [
            'required' => 'Elige una cantidad de existencias'
        ],
        'import_file' => [
            'required' => 'No se encontró ningún archivo para importar',
            'file' => 'No se cargó un archivo válido',
            'mimes' => 'El archivo no tiene una extensión válida'
        ]
    ]
];
