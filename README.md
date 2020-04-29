Plesk extension for Yii2 framework to make standalone search forms
============================

This extension provides an ability to create a form that will be submitted and validated via PJAX. After submitting the form, the page fragment set in the form settings will be updated via PJAX. Such approach provides an ability to create ajax forms with validation without the need to implement Yii2 forms AJAX validation and Yii2 client validation. The form is adaptive.   
This extension uses yiisoft/yii2-bootstrap4 extension.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/):

```composer require "plesk/yii2-standalone-search-form:^2.0.0"```


Configuration
------------

```php
[
    'components' => [
        'pjax' => [
            'class' => 'plesk\yii2pjax\Component',
        ],
    ],
]
```

API
------------

Examples:

```php
use plesk\standalonesearchform\SearchForm;

echo SearchForm::widget([
    'model' => $searchModel,
    'fields' => [
        [
            'type' => 'widget',
            'attribute' => 'project_id',
            'width' => 'full-wide',
            'options' => [
                Chosen::className(),
                [
                    'items' => ArrayHelper::map($projects, 'id', 'name'),
                ]
            ]
        ],
        [
            'type' => 'checkbox',
            'attribute' => 'showCasesCount',
            'width' => 'full-wide',
            'options' => [[], false]
        ],
    ],
    'resultAreaPjaxOptions' => ['id' => 'result-area-pjax-grid', 'timeout' => 1000],
]);
```

```php
use plesk\standalonesearchform\SearchForm;

echo SearchForm::widget([
    'model' => $searchModel,
    'collapse' => true,
    'fields' => [
        [
            'type' => 'widget',
            'attribute' => 'project_id',
            'width' => 'full-wide',
            'options' => [
                Chosen::className(),
                [
                    'items' => ArrayHelper::map($projects, 'id', 'name'),
                ]
            ]
        ],
        [
            'type' => 'widget',
            'attribute' => 'dateCreated',
            'width' => 'long',
            'range' => true,
            'options' => [
                DateTimePicker::className(),
            ]
        ],
    ],
    'resultAreaPjaxOptions' => ['id' => 'plesk-pjax-search-result', 'timeout' => 30000],
    'buttons' => [
        [
            'type' => 'submitButton',
            'options' => [
                'Search it!',
                ['class' => 'btn btn-primary'],
            ]
        ],
        [
            'type' => 'widget',
            'options' => [
                \app\components\widgets\clearButton\Widget::class,
                [
                    'content' => 'Clear it!',
                    'buttonOptions' => ['class' => 'btn btn-danger'],
                ],
            ]
        ]
    ],
]);
```
See [SearchForm](SearchForm.php) class for details

To handle pjax errors you should setup your handler before calling this widget.
```html
<head>
    <?php
        $this->registerJs(
            '$(document).on(\'pjax:error\', function(event, xhr, textStatus, error, options) {
                pleskMessageBox.options.title = error;
                pleskMessageBox.alert(xhr.responseText);
            });'
        );
    ?>
</head>

```

Exceptions

    - plesk\standalonesearchform\exceptions\Exception

        All exceptions thrown by the extension, extend this exception.