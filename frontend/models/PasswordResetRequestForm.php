<?php
namespace frontend\models;

use common\models\UserModel;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\UserModel',
                'filter' => ['status' => UserModel::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = UserModel::findOne([
            'status' => UserModel::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            if (!UserModel::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                return \Yii::$app->mailer->compose(['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \yii::t('common','My space') . ' robot']) //发送者邮箱
                    ->setTo($this->email)                                             //接收者邮箱
                    //->setSubject('Password reset for ' . \Yii::$app->name)
                    ->setSubject('Password reset for ' . \yii::t('common','My space')) //邮件标题    
                    //->setHtmlBody("<br>-------此邮件来自白衣少侠中文网！www.yii2mk.com>-------") //邮件内容，发布可以带html标签的文本
                    ->send();
            }
        }

        return false;
    }
}
