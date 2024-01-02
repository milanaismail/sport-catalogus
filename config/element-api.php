<?php

use craft\elements\Entry;
use craft\elements\Asset;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        '/api/products' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'products'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function(Entry $entry) {
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'category' => $entry->productCategory,
                        'price' => $entry->productPrice,
                        'productImage' => str_replace("https", "http", $entry->productImage->one()->getUrl('mobilePreview')),
                    ];
                },
            ];
        },
        '/api/products/<entryId:\d+>' => function($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function(Entry $entry) {
                  return [
                    'id' => $entry->id,
                    'title' => $entry->title,
                    'category' => $entry->productCategory,
                    'price' => $entry->productPrice,
                    'productImage' => str_replace("https", "http", $entry->productImage->one()->getUrl('productImage')),
                  ];
              },
            ];
        },
    ]
];