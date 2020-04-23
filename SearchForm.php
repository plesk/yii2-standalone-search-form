<?php
// Copyright 2017. Plesk International GmbH.

namespace plesk\standalonesearchform;

use Yii;
use yii\base\Widget;
use yii\bootstrap\Collapse;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\InputWidget;
use yii\widgets\Pjax;
use plesk\standalonesearchform\Exceptions\Exception;


/**
 * <code>
 * /**
 *  * var \yii\base\Model
 * public $model;
 *
 * /**
 * @var string
 * public $collapseCaption = 'Filter';
 *
 * /**
 * @var bool
 * public $openCollapse = false;
 *
 * /**
 *  * <code>
 *  * [
 *  *      [
 *  *          'type' => 'textInput|input|textarea|checkbox|radio|checkboxList|dropDownList|listBox|radioList|fileInput|hiddenInput|passwordInput|fileInput|staticControl|widget|callable',
 *  *          'attribute' => 'attr1',
 *  *          'width' => 'normal|long|full-wide',
 *  *          'range' => false|true
 *  *          'options' => [
 *  *              'widgetClassName',
 *  *              ['widgetConfig']
 *  *          ]
 *  *      ],
 *  *      ...
 *  * ]
 *  * </code>
 *  *
 *  * type: textInput|input|textarea|checkbox|radio|checkboxList|dropDownList|listBox|radioList|fileInput|hiddenInput|passwordInput|fileInput|staticControl  <br>
 *  * see \yii\widgets\ActiveField  <br>
 *  * see \yii\bootstrap\ActiveField
 *  *
 *  * type: widget
 *  * <code>
 *  * 'options' => [
 *  *     'widgetClassName',
 *  *     ['widgetConfig']
 *  * ]
 *  * </code>
 *  *
 *  * type: callable
 *  * <code>
 *  * 'options' => [
 *  *     function(\plesk\standalonesearchform\SearchForm $searchForm, array $field) { return '...'; },
 *  * ]
 *  * </code>
 *  *
 *  * var array
 * public $fields = [];
 *
 * /**
 *  * <code>
 *  * [
 *  *      [
 *  *          'type' => 'submitButton|resetButton|button|...|widget',
 *  *          'options' => [
 *  *              'Submit', // content
 *  *              [], // options
 *  *          ]
 *  *      ],
 *  *      ...
 *  * ]
 *  * </code>
 *  *
 *  * type: submitButton|resetButton|button <br>
 *  * see \yii\helpers\BaseHtml
 *  *
 *  * type: widget
 *  * <code>
 *  * 'options' => [
 *  *     'widgetClassName',
 *  *     ['widgetConfig']
 *  * ]
 *  * </code>
 *  *
 *  * var array
 * public $buttons = [
 *     [
 *         'type' => 'submitButton',
 *         'options' => [
 *             'Search',
 *             ['class' => 'btn btn-primary'],
 *         ]
 *     ]
 * ];
 *
 * /**
 *  * var array
 * see ActiveForm
 * public $formOptions = [
 *     'action' => [''],
 *     'method' => 'get',
 *     'options' => ['data-pjax' => true],
 *     'layout' => 'horizontal',
 * ];
 *
 * /**
 *  * var array ['id' => 'pjax-search-result', 'timeout' => 30000]
 * see Pjax
 * public $formPjaxOptions;
 *
 * /**
 *  * var array ['id' => 'standalone-pjax-search-form', 'timeout' => 30000]
 * see Pjax
 * public $formPjaxOptionsDefault = [
 *     'id' => 'standalone-pjax-search-form',
 * ];
 *
 * /**
 *  * var string
 * public $labelHorizontalCssClasses = 'col-xs-12 col-sm-2 col-md-2 col-lg-2';
 *
 *
 * /**
 *  * var string
 * public $fieldHorizontalCssClasses = 'col-xs-12 col-sm-3 col-md-2 col-lg-2';
 * /**
 *  * var string
 * public $fieldTemplate = <<<'TEMPLATE'
 *         {label}
 *         <div class="{cssClasses}">
 *             <div>{input}</div>
 *             <div>{error}</div>
 *         </div>
 * TEMPLATE;
 * /**
 *  * var array
 * public $fieldOptions;
 *
 *
 * /**
 *  * var string
 * public $fieldLongHorizontalCssClasses = 'col-xs-12 col-sm-4 col-md-3 col-lg-3';
 * /**
 *  * var string
 * public $fieldLongTemplate = <<<'TEMPLATE'
 *         {label}
 *         <div class="{cssClasses}">
 *             <div>{input}</div>
 *             <div>{error}</div>
 *         </div>
 * TEMPLATE;
 * /**
 *  * var array
 * public $fieldLongOptions;
 *
 *
 * /**
 *  * var string
 * public $fieldFullWideHorizontalCssClasses = 'col-xs-12 col-sm-8 col-md-6 col-lg-6';
 * public $fieldFullWideTemplate = <<<'TEMPLATE'
 *         {label}
 *         <div class='{cssClasses}'>
 *             <div>{input}</div>
 *             <div>{error}</div>
 *         </div>
 * TEMPLATE;
 * /**
 *  * var array
 * public $fieldFullWideOptions;
 *
 *
 * /**
 *  * var string
 * public $buttonsColumnHorizontalCssClasses = 'col-xs-12 col-sm-10 col-md-10 col-lg-10';
 *
 *
 * /**
 *  * var array ['id' => 'plesk-pjax-search-result', 'timeout' => 30000]
 * see Pjax
 * public $resultAreaPjaxOptions;
 *
 * /**
 *  * var array ['timeout' => 1000]
 * see Pjax
 * public $resultAreaPjaxOptionsDefault = [
 *     'timeout' => 1000,
 * ];
 * </code>
 *
 * /**
 *  * var ActiveForm
 * public $form;
 *
 *
 *
 * Examples:
 *
 * <code>
 * echo SearchForm::widget([
 *     'model' => $searchModel,
 *     'fields' => [
 *         [
 *             'type' => 'widget',
 *             'attribute' => 'project_id',
 *             'width' => 'full-wide',
 *             'options' => [
 *                 Chosen::className(),
 *                 [
 *                     'items' => ArrayHelper::map($projects, 'id', 'name'),
 *                 ]
 *             ]
 *         ],
 *         [
 *             'type' => 'widget',
 *             'attribute' => 'dateCreated',
 *             'width' => 'long',
 *             'range' => true,
 *             'options' => [
 *                 DateTimePicker::className(),
 *             ]
 *         ],
 *     ],
 *     'resultAreaPjaxOptions' => ['id' => 'plesk-pjax-search-result', 'timeout' => 30000],
 *     'buttons' => [
 *         [
 *             'type' => 'submitButton',
 *             'options' => [
 *                 'Search it!',
 *                 ['class' => 'btn btn-primary'],
 *             ]
 *         ],
 *         [
 *             'type' => 'widget',
 *             'options' => [
 *                 \app\components\widgets\clearButton\Widget::class,
 *                 [
 *                     'content' => 'Clear it!',
 *                     'buttonOptions' => ['class' => 'btn btn-danger'],
 *                 ],
 *             ]
 *         ]
 *     ],
 * ]);
 * </code>
 *
 *
 * @see \yii\widgets\ActiveField
 * @see \yii\bootstrap\ActiveField
 *
 * @see \yii\helpers\Html
 * @see \yii\helpers\BaseHtml
 *
 * @see ActiveForm
 * @see Pjax
 *
 * @package app\components\widgets\standaloneSearchForm
 */
class SearchForm extends Widget
{
    /**
     * @var \yii\base\Model
     */
    public $model;

    /**
     * @var bool
     */
    public $collapse = true;

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
     *          'type' => 'textInput|input|textarea|checkbox|radio|checkboxList|dropDownList|listBox|radioList|fileInput|hiddenInput|passwordInput|fileInput|staticControl|widget|callable',
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
     * type: textInput|input|textarea|checkbox|radio|checkboxList|dropDownList|listBox|radioList|fileInput|hiddenInput|passwordInput|fileInput|staticControl  <br>
     * see \yii\widgets\ActiveField  <br>
     * see \yii\bootstrap\ActiveField
     *
     * type: widget
     * <code>
     * 'options' => [
     *     'widgetClassName',
     *     ['widgetConfig']
     * ]
     * </code>
     *
     * type: callable
     * <code>
     *  'options' => [
     *      function(\plesk\standalonesearchform\SearchForm $searchForm, array $field) { return '...'; },
     *  ]
     * </code>
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
     * type: submitButton|resetButton|button <br>
     * see \yii\helpers\BaseHtml
     *
     * type: widget
     * <code>
     * 'options' => [
     *     'widgetClassName',
     *     ['widgetConfig']
     * ]
     * </code>
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
    public $formOptions = [];
    /**
     * @var array
     * @see ActiveForm
     */
    public $formOptionsDefault = [
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
            <div>{hint}</div>
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
            <div>{hint}</div>
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
            <div>{hint}</div>
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



    public function init()
    {
        if (!$this->model) {
            throw new Exception('The model must be set.');
        }
        if (!$this->resultAreaPjaxOptions) {
            throw new Exception('The PJAX options for the result area must be set.');
        }
        if (empty($this->resultAreaPjaxOptions['id'])) {
            throw new Exception('The ID of the result area must be set.');
        }
        $this->resultAreaPjaxOptions = array_merge(
            $this->resultAreaPjaxOptionsDefault,
            $this->resultAreaPjaxOptions
        );

        $this->formPjaxOptions = array_merge(
            [
                'id' => 'standalone-search-form-pjax-' . $this->id,
            ],
            $this->formPjaxOptionsDefault,
            $this->formPjaxOptions
        );
        if (empty($this->formPjaxOptions['id'])) {
            throw new Exception('The ID of search form must be set.');
        }

        $this->formOptions = array_merge_recursive(
            $this->formOptionsDefault,
            $this->formOptions
        );

        $this->collapseOptions = array_merge(
            $this->collapseOptionsDefault,
            $this->collapseOptions
        );


        $this->fieldTemplate = str_replace(
            '{cssClasses}',
            $this->fieldHorizontalCssClasses,
            $this->fieldTemplate
        );

        $this->fieldLongTemplate = str_replace(
            '{cssClasses}',
            $this->fieldLongHorizontalCssClasses,
            $this->fieldLongTemplate
        );

        $this->fieldFullWideTemplate = str_replace(
            '{cssClasses}',
            $this->fieldFullWideHorizontalCssClasses,
            $this->fieldFullWideTemplate
        );


        $this->fieldOptions = array_merge(
            [
                'options' => [
                    'class' => 'row form-group',
                ],
                'horizontalCssClasses' => [
                    'label' => $this->labelHorizontalCssClasses,
                ],
                'template' => $this->fieldTemplate,
            ],
            $this->fieldOptions
        );

        $this->fieldLongOptions = array_merge(
            [
                'options' => [
                    'class' => 'row form-group',
                ],
                'horizontalCssClasses' => [
                    'label' => $this->labelHorizontalCssClasses,
                ],
                'template' => $this->fieldLongTemplate,
            ],
            $this->fieldLongOptions
        );

        $this->fieldFullWideOptions = array_merge(
            [
                'options' => [
                    'class' => 'row form-group',
                ],
                'horizontalCssClasses' => [
                    'label' => $this->labelHorizontalCssClasses,
                ],
                'template' => $this->fieldFullWideTemplate,
            ],
            $this->fieldFullWideOptions
        );

        ob_start();
    }

    public function run()
    {
        $additionalContent = ob_get_clean();
        $content =
            $this->render('index') .
            Html::encode($additionalContent);

        return $this->collapse ?
            Collapse::widget([
                'items' => [
                    array_filter([
                        'label' => $this->collapseCaption,
                        'content' => $content,
                        'contentOptions' => $this->openCollapse ? ['class' => 'in'] : false,
                    ]),
                ],
                'options' => $this->collapseOptions,
            ]) :
            $content;
    }

    /**
     * @param array $field
     * <code>
     *      [
     *          'type' => 'textInput|input|textarea|checkbox|radio|checkboxList|dropDownList|listBox|radioList|fileInput|hiddenInput|passwordInput|fileInput|staticControl|widget|callable',
     *          'attribute' => 'attr1',
     *          'width' => 'normal|long|full-wide',
     *          'range' => false|true
     *          'options' => [
     *              'widgetClassName',
     *              ['widgetConfig']
     *          ]
     *      ]
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
     * type: callable
     * <code>
     *  'options' => [
     *      function(\plesk\standalonesearchform\SearchForm $searchForm, array $field) { return '...'; },
     *  ]
     * </code>
     *
     * type: textInput|input|textarea|checkbox|radio|checkboxList|dropDownList|listBox|radioList|fileInput|hiddenInput|passwordInput|fileInput|staticControl  <br>
     * see \yii\widgets\ActiveField  <br>
     * see \yii\bootstrap\ActiveField
     *
     * @throws Exception
     *
     * @return string
     *
     * @see \yii\widgets\ActiveField
     * @see \yii\bootstrap\ActiveField
     */
    public function renderField($field)
    {
        if ($field['type'] == 'callable') {
            return $this->renderCallableField($field);
        } else {
            return $this->renderActiveField($field);
        }
    }

    /**
     * @param array $field
     * <code>
     *      [
     *          'type' => 'callable',
     *          'options' => [
     *              function(\plesk\standalonesearchform\SearchForm $searchForm, array $field) { return '...'; },
     *          ]
     *      ]
     * </code>
     *
     * @throws Exception
     *
     * @return string
     *
     * @see \yii\widgets\ActiveField
     * @see \yii\bootstrap\ActiveField
     */
    protected function renderCallableField($field)
    {
        return call_user_func(
            $field['options'][0],
            $this,
            $field
        );
    }

    /**
     * @param array $field
     * <code>
     *      [
     *          'type' => 'widget|textInput|input|textarea|checkbox|radio|checkboxList|dropDownList|listBox|radioList|fileInput|hiddenInput|passwordInput|fileInput|staticControl',
     *          'attribute' => 'attr1',
     *          'width' => 'normal|long|full-wide',
     *          'range' => false|true
     *          'options' => [
     *              'widgetClassName',
     *              ['widgetConfig']
     *          ]
     *      ]
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
     * type: textInput|input|textarea|checkbox|radio|checkboxList|dropDownList|listBox|radioList|fileInput|hiddenInput|passwordInput|fileInput|staticControl  <br>
     * see \yii\widgets\ActiveField  <br>
     * see \yii\bootstrap\ActiveField
     *
     * @throws Exception
     *
     * @return string
     *
     * @see \yii\widgets\ActiveField
     * @see \yii\bootstrap\ActiveField
     */
    protected function renderActiveField($field)
    {
        if (!isset($field['width'])) {
            $field['width'] = 'normal';
        }
        if (!isset($field['options'])) {
            $field['options'] = [];
        }
        if (!isset($field['range'])) {
            $field['range'] = false;
        }
        return $field['range'] ?
            $this->renderRangeField($field) :
            $this->renderSingleField($field);
    }

    /**
     * @param array $field
     * <code>
     *      [
     *          'type' => 'textInput|input|textarea|checkbox|radio|checkboxList|dropDownList|listBox|radioList|fileInput|hiddenInput|passwordInput|fileInput|staticControl',
     *          'attribute' => 'attr1',
     *          'width' => 'normal|long|full-wide',
     *          'range' => false|true
     *          'options' => [
     *              'text', // type
     *              ['id' => 'sss'] // options
     *          ]
     *      ]
     * </code>
     *
     * @throws Exception
     *
     * @return string
     *
     * @see \yii\widgets\ActiveField
     * @see \yii\bootstrap\ActiveField
     */
    public function renderSingleField($field)
    {
        $inputId = Html::getInputId($this->model, $field['attribute']) . '_standalone';
        switch ($field['width']) {
            case 'normal':
                $fieldOptions = $this->fieldOptions;
                break;
            case 'long':
                $fieldOptions = $this->fieldLongOptions;
                break;
            case 'full-wide':
                $fieldOptions = $this->fieldFullWideOptions;
                break;
            default:
                throw new Exception("Unknown field width '{$field['width']}'.");
        }

        $activeField = $this->form->field(
            $this->model,
            $field['attribute'],
            array_merge($fieldOptions, ['selectors' => ['input' => $inputId]])
        );

        if ($field['type'] != 'widget') {

            $optionsIndex = in_array(
                $field['type'],
                ['textInput', 'textarea', 'checkbox', 'radio', 'fileInput', 'hiddenInput', 'passwordInput', 'fileInput', 'staticControl']
            ) ? 0 : 1;

            if (!isset($field['options'][$optionsIndex])) {
                $field['options'][$optionsIndex] = [];
            }
            $field['options'][$optionsIndex] = array_merge(
                ['id' => $inputId],
                $field['options'][$optionsIndex]
            );

        } else {
            if (!isset($field['options'][1]['options'])) {
                $field['options'][1]['options'] = [];
            }
            $field['options'][1]['options'] = array_merge(
                ['id' => $inputId],
                $field['options'][1]['options']
            );
        }

        $activeField = call_user_func_array(
            [
                $activeField,
                $field['type']
            ],
            $field['options']
        );

        return $activeField;
    }

    /**
     * @param array $field
     * <code>
     *      [
     *          'type' => 'widget',
     *          'attribute' => 'attr1',
     *          'width' => 'normal|long|full-wide',
     *          'range' => false|true
     *          'options' => [
     *              'widgetClassName',
     *              ['widgetConfig']
     *          ]
     *      ]
     * </code>
     *
     * @throws Exception
     *
     * @return string
     *
     * @see \yii\widgets\ActiveField
     * @see \yii\bootstrap\ActiveField
     */
    public function renderRangeField($field)
    {
        switch ($field['width']) {
            case 'normal':
                $horizontalCssClasses = $this->fieldHorizontalCssClasses;
                break;
            case 'long':
                $horizontalCssClasses = $this->fieldLongHorizontalCssClasses;
                break;
            case 'full-wide':
                $horizontalCssClasses = $this->fieldFullWideHorizontalCssClasses;
                break;
            default:
                throw new Exception("Unknown field width '{$field['width']}'.");
        }

        if (!isset($field['options'][1])) {
            $field['options'][1] = [];
        }
        if ($field['type'] === 'widget' &&
            is_subclass_of($field['options'][0], InputWidget::class)
        ) {
            if (!isset($field['options'][1]['options'])) {
                $field['options'][1]['options'] = [];
            }
        }

        $inputFrom = $this->form->field(
            $this->model,
            "{$field['attribute']}From",
            [
                'template' => '{input}',
                'options' => [
                    'tag' => null,
                    'placeholder' => $this->model->getAttributeLabel("{$field['attribute']}From"),
                ],
            ]
        );
        if ($field['type'] === 'widget' &&
            is_subclass_of($field['options'][0], InputWidget::class)
        ) {
            $field['options'][1]['options'] = array_merge(
                $field['options'][1]['options'],
                [
                    'placeholder' => $this->model->getAttributeLabel("{$field['attribute']}From"),
                ]
            );
        }
        $inputFrom = call_user_func_array(
            [
                $inputFrom,
                $field['type']
            ],
            $field['options']
        );


        $inputTo = $this->form->field(
            $this->model,
            "{$field['attribute']}To",
            [
                'template' => '{input}',
                'options' => [
                    'tag' => null,
                    'placeholder' => $this->model->getAttributeLabel("{$field['attribute']}To"),
                ],
            ]
        );
        if ($field['type'] === 'widget' &&
            is_subclass_of($field['options'][0], InputWidget::class)
        ) {
            $field['options'][1]['options'] = array_merge(
                $field['options'][1]['options'],
                [
                    'placeholder' => $this->model->getAttributeLabel("{$field['attribute']}To"),
                ]
            );
        }
        $inputTo = call_user_func_array(
            [
                $inputTo,
                $field['type']
            ],
            $field['options']
        );


        return $this->render('_search_range', [
            'model' => $this->model,
            'attributeName' => $field['attribute'],
            'form' => $this->form,
            'inputFrom' => $inputFrom,
            'inputTo' => $inputTo,
            'labelHorizontalCssClasses' => $this->labelHorizontalCssClasses,
            'fieldHorizontalCssClasses' => $horizontalCssClasses,
        ]);
    }

    /**
     * @return string
     */
    public function renderButtons()
    {
        $result = '';

        /**
         * @var array $button
         * <code>
         * [
         *     'type' => 'widget|submitButton|resetButton|button|...',
         *     'options' => [
         *         'Submit', // content
         *         [], // options
         *     ]
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
         */
        foreach ($this->buttons as $button) {
            if ($button['type'] !== 'widget') {
                $result .= call_user_func_array(
                    [
                        Html::class,
                        $button['type']
                    ],
                    $button['options']
                ) . "\n";

            } else {
                if (!isset($button['options'][1])) {
                    $button['options'][1] = [];
                }
                $result .= call_user_func(
                    [
                        $button['options'][0],
                        'widget'
                    ],
                    $button['options'][1]
                ) . "\n";
            }
        }

        return $result;
    }
}