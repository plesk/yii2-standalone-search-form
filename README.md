Plesk extension for Yii2 framework to make standalone search forms
============================

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

- Add the following lines to your `composer.json` file:

    ```js
    "repositories": [
        {
            "type": "vcs",
            "url":  "ssh://git@git.plesk.ru:7999/id/yii2-standalone-search-form.git"
        }
    ]
    ```

- Run `composer require "plesk/yii2-standalone-search-form:^1.0.0"`


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

```php
class SearchForm extends Widget
{
    /**
     * @var \yii\base\Model
     */
    public $model;
    
    /**
     * @var string
     */
    public $collapseCaption = 'Filter';
    
    /**
     * @var bool
     */
    public $openCollapse = false;
    
    /**
     * @var array ['class' => 'standalone-search-form-collapse']
     * @see Collapse
     */
    public $collapseOptions = [];
    
    /**
     * @var array ['class' => 'standalone-search-form-collapse']
     * @see Collapse
     */
    public $collapseOptionsDefault = ['class' => 'standalone-search-form-collapse'];
    
    /**
     * <code>
     * [
     *      [
     *          'type' => 'widget|input|textarea|checkbox|radio|checkboxList|dropDownList|listBox|radioList|fileInput|hiddenInput|passwordInput|fileInput|staticControl',
     *          'attribute' => 'attr1',
     *          'width' => 'normal|long|full-wide',
     *          'range' => false|true
     *          'options' => [
     *              'widgetClassName',
     *              ['widgetConfig']
     *          ]
     *      ],
     *      ...
     * ]
     * </code>
     *
     * type: widget
     * <code>
     * 'options' => [
     *     'widgetClassName',
     *     ['widgetConfig']
     * ]
     * </code>
     *
     * type: input|textarea|checkbox|radio|checkboxList|dropDownList|listBox|radioList|fileInput|hiddenInput|passwordInput|fileInput|staticControl  <br>
     * see \yii\widgets\ActiveField  <br>
     * see \yii\bootstrap\ActiveField
     *
     * @see \yii\widgets\ActiveField
     * @see \yii\bootstrap\ActiveField
     *
     * @var array
     */
    public $fields = [];
    
    /**
     * <code>
     * [
     *      [
     *          'type' => 'widget|submitButton|resetButton|button|...',
     *          'options' => [
     *              'Submit', // content
     *              [], // options
     *          ]
     *      ],
     *      ...
     * ]
     * </code>
     *
     * type: widget
     * <code>
     * 'options' => [
     *     'widgetClassName',
     *     ['widgetConfig']
     * ]
     * </code>
     *
     * type: input|textarea|checkbox|radio|checkboxList|dropDownList|listBox|radioList|fileInput|hiddenInput|passwordInput|fileInput|staticControl  <br>
     * see \yii\widgets\ActiveField  <br>
     * see \yii\bootstrap\ActiveField
     *
     * @see \yii\helpers\Html
     * @see \yii\bootstrap\ActiveField
     *
     * @var array
     */
    public $buttons = [
        [
            'type' => 'submitButton',
            'options' => [
                'Search',
                ['class' => 'btn btn-primary'],
            ]
        ]
    ];
    
    /**
     * @var array
     * @see ActiveForm
     */
    public $formOptions = [
        'action' => [''],
        'method' => 'get',
        'options' => [
            'data-pjax' => true,
            'class' => 'standalone-search-form',
        ],
        'layout' => 'horizontal',
    ];
    
    /**
     * @var array ['id' => 'standalone-search-form-pjax', 'timeout' => 30000]
     * @see Pjax
     */
    public $formPjaxOptions = [];
    
    /**
     * @var array ['id' => 'standalone-search-form-pjax', 'timeout' => 30000]
     * @see Pjax
     */
    public $formPjaxOptionsDefault = [];
    
    /**
     * @var string
     */
    public $labelHorizontalCssClasses = 'col-xs-12 col-sm-2 col-md-2 col-lg-2';
    
    
    /**
     * @var string
     */
    public $fieldHorizontalCssClasses = 'col-xs-12 col-sm-3 col-md-2 col-lg-2';
    /**
     * @var string
     */
    public $fieldTemplate = <<<'TEMPLATE'
        {label}
        <div class="{cssClasses}">
            <div>{input}</div>
            <div>{error}</div>
        </div>
    TEMPLATE;
    /**
     * @var array
     */
    public $fieldOptions = [];
    
    
    /**
     * @var string
     */
    public $fieldLongHorizontalCssClasses = 'col-xs-12 col-sm-4 col-md-3 col-lg-3';
    /**
     * @var string
     */
    public $fieldLongTemplate = <<<'TEMPLATE'
        {label}
        <div class="{cssClasses}">
            <div>{input}</div>
            <div>{error}</div>
        </div>
    TEMPLATE;
    /**
     * @var array
     */
    public $fieldLongOptions = [];
    
    
    /**
     * @var string
     */
    public $fieldFullWideHorizontalCssClasses = 'col-xs-12 col-sm-8 col-md-6 col-lg-6';
    public $fieldFullWideTemplate = <<<'TEMPLATE'
        {label}
        <div class='{cssClasses}'>
            <div>{input}</div>
            <div>{error}</div>
        </div>
    TEMPLATE;
    /**
     * @var array
     */
    public $fieldFullWideOptions = [];
    
    
    /**
     * @var string
     */
    public $buttonsColumnHorizontalCssClasses = 'col-xs-12 col-sm-10 col-md-10 col-lg-10';
    
    
    /**
     * @var array ['id' => 'plesk-pjax-search-result', 'timeout' => 30000]
     * @see Pjax
     */
    public $resultAreaPjaxOptions = [];
    
    /**
     * @var array ['timeout' => 1000]
     * @see Pjax
     */
    public $resultAreaPjaxOptionsDefault = [
        'timeout' => 1000,
    ];
    
    
    /**
     * @var ActiveForm
     */
    public $form;
}
```


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