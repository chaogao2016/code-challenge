<?php

namespace app\models;

use app\models\Supplier;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SupplierQuery represents the model behind the search form of `app\models\Supplier`.
 */
class SupplierQuery extends Supplier
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'string'],
            [['name', 'code', 't_status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Supplier::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $this->dealWhere($query, $this->id, $this->name, $this->code, $this->t_status);

        return $dataProvider;
    }

    public function export($params)
    {
        $query = Supplier::find();

        $id = $params['SupplierQuery']['id'] ?? "";
        $name = $params['SupplierQuery']['name'] ?? "";
        $code = $params['SupplierQuery']['code'] ?? "";
        $t_status = $params['SupplierQuery']['t_status'] ?? "";

        $this->dealWhere($query, $id, $name, $code, $t_status);
        $isCheckAll = $params['isCheckAll'] ?? 0;
        if (!$isCheckAll) {
            $query->andFilterWhere($this->parseSelectIdsWhere($params['selectIds'] ?? []));
        }

        return $query->all();
    }

    private function dealWhere(&$query, $id, $name, $code, $t_status) {
        // grid filtering conditions
        $query->andFilterWhere($this->parseIdWhere($id));

        $query->andFilterWhere(['like', 'name', $name])
            ->andFilterWhere(['like', 'code', $code]);

        if ($this->t_status != "all") {
            $query->andFilterWhere(['=', 't_status', $t_status]);
        }
    }

    private function parseSelectIdsWhere($selectIds) {
        if (empty($selectIds)) {
            return [];
        }

        return ['in', "id", $selectIds];
    }

    private function parseIdWhere($idValue) {
        if (empty($idValue)) {
            return [];
        }

        $cleanIdValue = trim($idValue);
        if (is_numeric($cleanIdValue)) {
            return ['=', "id", $cleanIdValue];
        }

        $firstChar = substr($cleanIdValue, 0 , 1);
        $secondChar = substr($cleanIdValue, 1 , 1);

        $twiceOperator = $firstChar . $secondChar;
        if (in_array($twiceOperator, ['>=', '<='])) {
            $searchId = substr($cleanIdValue, 2);;
            $where = [$twiceOperator, "id", $searchId];
        } elseif (in_array($firstChar, ['>', '<', '='])) {
            $searchId = substr($cleanIdValue, 1);
            $where = [$firstChar, "id", $searchId];
        } else {
            $where = [];
        }

        return $where;
    }

}
