<?php

namespace backend\modules\products\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProdSearch represents the model behind the search form about `common\models\Product`.
 */
class ProdSearch extends Product
{
    public $q;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'product_name', 'product_detail', 'product_image', 'create_at', 'tbl_productcol', 'product_unit','q'], 'safe'],
            [['product_cost', 'product_price', 'product_price_pro', 'product_num_all', 'product_num', 'create_by', 'update_by', 'product_type_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>50,
            ],
            'sort'=> ['defaultOrder' => ['product_id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'product_cost' => $this->product_cost,
            'product_price' => $this->product_price,
            'product_price_pro' => $this->product_price_pro,
            'product_num_all' => $this->product_num_all,
            'product_num' => $this->product_num,
            'create_by' => $this->create_by,
            'create_at' => $this->create_at,
            'update_by' => $this->update_by,
            'tbl_productcol' => $this->tbl_productcol,
            'product_type_id' => $this->product_type_id,
        ]);

        $query->orFilterWhere(['like', 'product_id', $this->q])
            ->orFilterWhere(['like', 'product_name', $this->q])
            ->orFilterWhere(['like', 'product_detail', $this->q])
            ->orFilterWhere(['like', 'product_image', $this->q])
            ->orFilterWhere(['like', 'product_unit', $this->q]);

        return $dataProvider;
    }
}
