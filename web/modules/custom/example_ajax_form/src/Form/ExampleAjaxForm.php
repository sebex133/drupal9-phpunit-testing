<?php

namespace Drupal\example_ajax_form\Form;

use Drupal;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\AppendCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Ajax\RemoveCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\TrustedRedirectResponse;
use Drupal\Core\Url;
use Drupal\user\Entity\User;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ExampleAjaxForm.
 */
class ExampleAjaxForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'example_ajax_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, $ajaxParams = [], $params = []) {
        //form theme
        $form['#theme'] = 'exampleajaxform';

        //build form
        $form['#prefix'] = '<div id="wrap-form">';
        $form['#suffix'] = '</div>';

        $form['text_example'] = [
            '#type' => 'textfield',
            '#size' => '60',
            '#placeholder' => "Type 'trigerror' to generate erorr",
        ];

        $form['submit_form_button'] = [
            '#type' => 'submit',
            '#value' => 'subval',
            '#name' => 'subname',
            '#label' => 'sublabel',
        ];

        return $form;
    }

    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        parent::validateForm($form, $form_state);

        if($form_state->getValue('text_example') == 'trigerror'){
            $form_state->setErrorByName('text_example','error for text example');
        }

        //handle AJAX form submit and get errors
        $errors = [];
        $errors = $form_state->getErrors();

        if(\Drupal::request()->isXmlHttpRequest() && !empty($errors)){
            $response = new JsonResponse([
                'errors' => $errors,
            ]);
            $response->send();
        }
    }

    /**
     * Submitions forms.
     * @param array $form
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *
     * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        //handle AJAX form submit
        if(\Drupal::request()->isXmlHttpRequest()){
            $response = new JsonResponse([
                'values' => $form_state->getValues(),
            ]);
            $form_state->setResponse($response);
        }else{
            \Drupal::messenger()->addMessage('Form submitted normally with value == ' . $form_state->getValue('text_example'));
        }
    }
}
