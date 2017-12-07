<?php

namespace rsiripong\juidatepicker;

use yii\helpers\Html,
    yii\widgets\InputWidget,
    yii\base\InvalidParamException,
    yii\web\JsExpression,
    yii\helpers\Json,
    Yii;


class JuiDatePicker extends InputWidget
{

    public $options = ['class' => 'form-control'];

    public $dateFormat = 'yyyy-MM-dd';

    public $altDateFormat = 'dd/MM/yyyy';

    public $numberOfMonths = 1;

    public $showButtonPanel = false;

    public $clientOptions = [
        'showOn' => 'button',
        'buttonText'=>'<span class="glyphicon glyphicon-calendar"></span>',
        'changeMonth'=> true,
         'changeYear'=> true,
        'yearRange' =>"c-65:c+5",
     
       
    ];
    
    public $ignoreReadonly = false;
    
    public $disableAlt = false;
	public $disableClear = false;

    public function init()
    {
        if (is_null($this->dateFormat)) {
            $this->dateFormat = Yii::$app->getFormatter()->dateFormat;
            if (is_null($this->dateFormat)) {
                $this->dateFormat = 'medium';
            }
        }
        if (is_null($this->altDateFormat)) {
            $this->altDateFormat = $this->dateFormat;
        }
        parent::init();
    }

    public function run()
    {
        $inputId = $this->options['id'];
        $altInputId = $inputId . '-alt';
        $hasModel = $this->hasModel();
        if (array_key_exists('value', $this->options)) {
            $value = $this->options['value'];
        } elseif ($hasModel) {
            $value = Html::getAttributeValue($this->model, $this->attribute);
        } else {
            $value = $this->value;
        }
        $altOptions = [
            'id' => $altInputId,
            'name' => $altInputId,
        ];
        
        $altOptions['rel']  = $inputId;
        if (!is_null($value) && ($value !== '')) {
            $formatter = Yii::$app->getFormatter();
            try {
                $this->options['value'] = $formatter->asDate($value, $this->dateFormat);
                
                //$altOptions['value'] = $formatter->asDate($value, $this->altDateFormat);
                $altOptions['value'] = $formatter->asDate($value, "dd/MM/").
                        ($formatter->asDate($value, "yyyy")+543);
                
            } catch (InvalidParamException $e) {
                // ignore exception and keep original value if it is not a valid date
            }
        }
        if ($hasModel) {
            
            //$output = Html::activeTextInput($this->model, $this->attribute, $this->options)
            //    .((!$this->disableAlt) ? Html::activeHiddenInput($this->model, $this->attribute, $altOptions) : null);
            $altOptions['class'] = 'form-control dalternate';
            $output = "<div class=\"date input-group\">";
            $output .= ((!$this->disableAlt) ? Html::activeTextInput($this->model, $this->attribute, $altOptions) : null);
            
            $output.= "<span class='input-group-btn' >";
			
			if(!$this->disableClear){
			$output.= "<button type='button' class='btn-secondary btn ht-remove' ref='".$inputId."' >".
                    "<span class=\"glyphicon glyphicon-remove\"></span></button>";
					}
			$output.= "</span>";
            $output .= Html::activeHiddenInput($this->model, $this->attribute, $this->options);
            $output .= "</div>";
            
        } else {
            $altOptions['class'] = 'form-control dalternate';
             $output = "<div class=\"date input-group\">";
            $output .= ((!$this->disableAlt) ?Html::textInput($altInputId, $this->value, $altOptions) : null);
            $output.= "<span class='input-group-btn' >";
			if(!$this->disableClear){
			$output.= "<button type='button' class='btn-secondary btn ht-remove' ref='".$inputId."' >".
                    "<span class=\"glyphicon glyphicon-remove\"></span></button>";
					}
			$output.= "</span>";
            $output .= Html::hiddenInput($this->name, $this->value, $this->options);
             $output .= "</div>";
        }
        $this->clientOptions = array_merge([
            'numberOfMonths' => $this->numberOfMonths,
            'showButtonPanel' => $this->showButtonPanel
        ], $this->clientOptions, [
            'dateFormat' => FormatConverter::convertDatePhpOrIcuToJui($this->dateFormat),
            'altFormat' => FormatConverter::convertDatePhpOrIcuToJui($this->altDateFormat),
            'altField' => '#' . $altInputId
        ]);
        if (!$this->ignoreReadonly && array_key_exists('readonly', $this->options) && $this->options['readonly']) {
            $this->clientOptions['beforeShow'] = new JsExpression('function (input, inst) { return false; }');
        }
        if ($this->disableAlt) {
            foreach ($this->clientOptions as $keyCO => $valueCO) {
                if (strrpos($keyCO, 'alt') !== false) {
                    unset($this->clientOptions[$keyCO]);
                }
            }
        }
        $js = 'jQuery(\'#' . $inputId . '\').datepicker(' . Json::htmlEncode($this->clientOptions) . ');';
        //$js .= 'jQuery(\'.ht-remove[ref="' . $inputId . '"]\').click(function(){'
         //       . 'var ref=jQuery(this).attr("ref");'
         //       . 'jQuery("#"+ref).val(\'\');jQuery("#"+ref+"-alt").val(\'\');'
         //       . '});';
        //$js .= 'jQuery(\'#' . $inputId . '-alt\').blur(function(){'
        //        . 'jQuery(this).datefilterchange();'
        //        . '})';
        $js .= 'jQuery(\'#' . $inputId . '\').datefilterchange();';
        if (Yii::$app->getRequest()->getIsAjax()) {
            $output .= Html::script($js);
        } else {
            $view = $this->getView();
            
            //JuiDatePickerAsset::register($view)->js[]= 'js/jquery-ui.mod.js';
            JuiDatePickerAsset::register($view)->js[]= 'js/juidatepicker.js';
             JuiDatePickerAsset::register($view)->js[]= 'js/datefilterchange.js';
            JuiDatePickerLanguageAsset::register($view);
            $view->registerJs($js);
            
        }
        return $output;
    }
}
