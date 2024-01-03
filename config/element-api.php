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
                    // Get category details
                    $category = $entry->productCategory->one();
                    $categoryId = $category ? $category->id : null;
                    $categoryTitle = $category ? $category->title : null;

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'categoryId' => $categoryId,
                        'categoryTitle' => $categoryTitle,
                        'price' => $entry->productPrice,
                        'productImage' => str_replace("https", "http", $entry->productImage->one()->getUrl('mobilepreview')),
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