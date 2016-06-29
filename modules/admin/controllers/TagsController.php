<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\helpers\Util;
use app\components\BaseController;
use app\models\Tag;
use app\modules\admin\models\search\TagSearch;

class TagsController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'operations' => ['post'],
                    'autocomplete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'operations' => [
                'class' => 'app\modules\admin\controllers\common\OperationsAction',
                'modelName' => 'app\models\Tag',
                'operations' => [
                    'delete' => [],
                ]
            ],
            'delete' => [
                'class' => 'app\modules\admin\controllers\common\DeleteAction',
                'modelName' => 'app\models\Tag',
            ],
        ];
    }

    public function actionIndex()
    {
        $tagSearch = new TagSearch();
        $dataProvider = $tagSearch->search(Yii::$app->request->get());

        return $this->render('index', [
            'tagSearch' => $tagSearch,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEdit($id = null)
    {
        $model = new Tag();

        if ($id) {
            $model = $this->loadModel($model, $id);
        }

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app.messages', 'Saved successfully'));
                if (Yii::$app->request->isAjax) {
                    return $this->response(['redirect' => Url::toRoute(['edit', 'id' => $model->id])]);
                }
            } else {
                if (Yii::$app->request->isAjax) {
                    return $this->response(Util::collectModelErrors($model));
                }
            }
        }

        return $this->render('edit', ['model' => $model]);
    }

    public function actionAutocomplete()
    {
        $result = [];
        if (($term = Yii::$app->request->post('term')) !== null) {
            $data = Tag::find()
                ->like($term, 'title')
                ->asArray()
                ->limit(10)
                ->all();

            foreach ($data as $item) {
                $result[] = [
                    'text' => $item['title'],
                    'id' => $item['title']
                ];
            }
        }
        return $this->response($result);
    }
}
