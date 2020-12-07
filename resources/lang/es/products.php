<?php

return [
    'titles' => [
        'index' => 'Gestión de productos',
        'create' => 'Creación de producto',
        'update' => 'Actualización de producto',
        'import' => 'Importar producto',
        'export' => 'Exportar producto',
        'report' => 'Reporte de productos'
    ],
    'sentences' => [
        'control_panel' => 'Gestione los productos de TecFever',
    ],
    'messages' => [
        'created' => 'Se creó un producto con éxito',
        'import' => 'La importación de :count productos comenzó con éxito',
        'export' => 'La exportación de productos comenzó con éxito'
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
            'required' => 'Sin trampas, elige una de las 3 categorías'
        ],
        'image' => [
            'image' => 'Verifica que lo que estás subiendo es una imagen'
        ],
        'price' => [
            'required' => 'Incluso si es barato, ponle un precio',
            'digits_between' => 'El precio mínimo es de 4 dígitos y el máximo de 9'
        ],
        'stock' => [
            'required' => 'Elige una cantidad de existencias',
            'digits_between' => 'Esa cantidad excede nuestros límites'
        ],
        'import_file' => [
            'required' => 'No se encontró ningún archivo para importar',
            'file' => 'No se cargó un archivo válido',
            'mimes' => 'El archivo no tiene una extensión válida'
        ],
        'image_path' => [
            'string' => 'Ruta de imagen incorrecta'
        ]
    ],
    'reports_messages' => [
        'intro' => 'Aquí puede generar un informe basado en la información recopilada de todos los productos TecFever hasta la fecha.',
        'most_viewed' => 'Entre todos los productos se ha detectado que el más visto es <strong>:most_viewed</strong> con <strong>:views</strong> vistas.'
    ]
];
