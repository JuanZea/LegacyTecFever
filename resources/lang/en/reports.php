<?php
return [
    'title' => [
        'index' => 'Reports Management',
    ],
    'sentences' => [
        'control_panel' => 'Gestione los reportes de TecFever',
    ],
    'message' => [
        'generate' => 'Manage TecFever reports'
    ],
    'pdf' => [
        'intro' => 'From the collection of important data about TecFever products such as their views, their purchases, their stocks, etc. The following report has been generated with relevant data for the company.',
        'most_viewed' => [
            'title' => 'The most viewed ones',
            'winner' => 'The winner is: <strong> :winner </strong> with <strong> :views </strong> views.',
            'content' => 'From the most viewed to the least viewed, the top 5 is shown in the following table:'
        ],
        'best_seller' => [
            'title' => 'The best sellers',
            'winner' => 'The winner is: <strong> :winner </strong> with <strong> :sales </strong> sales.',
            'content' => 'Again descending from the best seller, the following table of the top 5 is shown:'
        ],
        'most_stock' => [
            'title' => 'Those with the largest stock',
            'winner' => 'The winner is: <strong> :winner </strong> with <strong> :stock </strong> stocks.',
            'content' => 'And to finish the report, the top 5 of those with the largest stocks are delivered:'
        ]
    ]
];
