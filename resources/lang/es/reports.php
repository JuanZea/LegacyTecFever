<?php
return [
    'title' => 'Reporte :name de TecFever',
    'message' => [
        'generate' => 'El reporte comenzó su generación correctamente'
    ],
    'pdf' => [
        'intro' => 'A partir de la recogida de datos importantes sobre los productos de TecFever como sus visualizaciones, sus compras, sus existencias, etc. Se ha generado el siguiente reporte con datos relevantes para la empresa.',
        'most_viewed' => [
            'title' => 'Los más vistos',
            'winner' => 'El ganador es: <strong> :winner </strong> con <strong> :views </strong> visualizaciones.',
            'content' => 'Desde el más visto hasta el menos visto el top 5 se muestra en la siguiente tabla:'
        ],
        'best_seller' => [
            'title' => 'Los más vendidos',
            'winner' => 'El ganador es: <strong> :winner </strong> con <strong> :sales </strong> ventas.',
            'content' => 'De nuevo descendiendo desde el "best seller", se muestra la siguiente tabla del top 5:'
        ],
        'most_stock' => [
            'title' => 'Aquellos con mayor "stock"',
            'winner' => 'El ganador es: <strong> :winner </strong> con <strong> :stock </strong> existencias.',
            'content' => 'Y para finalizar el reporte se entrega el top 5 de aquellos con mayores existencias:'
        ]
    ]
];
