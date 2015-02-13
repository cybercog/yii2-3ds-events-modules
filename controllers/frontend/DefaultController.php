<?php

namespace yii3ds\events\controllers\frontend;

use yii3ds\events\models\frontend\Event;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\HttpException;

/**
 * Default controller.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        if (!isset($behaviors['access']['class'])) {
            $behaviors['access']['class'] = AccessControl::className();
        }

        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['index', 'view'],
            'roles' => ['viewEvents']
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
                'view' => ['get']
            ]
        ];

        return $behaviors;
    }

    /**
     * Event list page.
     */
    function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Event::find()->published(),
            'pagination' => [
                'pageSize' => $this->module->recordsPerPage
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Event page.
     *
     * @param integer $id Event ID
     * @param string $alias Event alias
     *
     * @return mixed
     *
     * @throws \yii\web\HttpException 404 if event was not found
     */
    public function actionView($id, $alias)
    {
        if (($model = Event::findOne(['id' => $id, 'alias' => $alias])) !== null) {
            $this->counter($model);

            return $this->render('view', [
                'model' => $model
            ]);
        } else {
            throw new HttpException(404);
        }
    }

    /**
     * Update event views counter.
     *
     * @param Event $model Model
     */
    protected function counter($model)
    {
        $cookieName = 'events-views';
        $shouldCount = false;
        $views = Yii::$app->request->cookies->getValue($cookieName);

        if ($views !== null) {
            if (is_array($views)) {
                if (!in_array($model->id, $views)) {
                    $views[] = $model->id;
                    $shouldCount = true;
                }
            } else {
                $views = [$model->id];
                $shouldCount = true;
            }
        } else {
            $views = [$model->id];
            $shouldCount = true;
        }

        if ($shouldCount === true) {
            if ($model->updateViews()) {
                Yii::$app->response->cookies->add(new Cookie([
                    'name' => $cookieName,
                    'value' => $views,
                    'expire' => time() + 86400 * 365
                ]));
            }
        }
    }
}
