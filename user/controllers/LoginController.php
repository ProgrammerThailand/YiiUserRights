<?php

class LoginController extends Controller {

    public $defaultAction = 'login';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', 
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('oauthadmin'),
                'users'=>UserModule::getAdmins(),
            ),
            array('deny',  // deny all users
                                'actions'=>array('oauthadmin'),
                'users'=>array('*'),
            ),
        );
    }
    
    public function actions() {
        return array(
            'oauth' => array(
                'class' => 'ext.hoauth.HOAuthAction',
            ),
            'oauthadmin' => array(
                'class' => 'ext.hoauth.HOAuthAdminAction',
            ),
        );
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        if (Yii::app()->user->isGuest) {
            $model = new UserLogin;
            // collect user input data
            if (isset($_POST['UserLogin'])) {
                $model->attributes = $_POST['UserLogin'];
                // validate user input and redirect to previous page if valid
                if ($model->validate()) {
                    $this->lastViset();
                    if (strpos(Yii::app()->user->returnUrl, '/index.php') !== false)
                        $this->redirect(Yii::app()->controller->module->returnUrl);
                    else
                        $this->redirect(Yii::app()->user->returnUrl);
                }
            }
            // display the login form
            $this->render('/user/login', array('model' => $model));
        }
        else
            $this->redirect(Yii::app()->controller->module->returnUrl);
    }

    private function lastViset() {
        $lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
        $lastVisit->lastvisit = time();
        $lastVisit->save();
    }

}