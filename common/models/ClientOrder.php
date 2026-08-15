<?php

declare(strict_types=1);

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use common\models\Client;

/**
 * ClientOrder model
 *
 * @property int $id
 * @property int $client_id
 * @property string $order_date
 * @property float $total_amount
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class ClientOrder extends ActiveRecord
{
    public const STATUS_CANCELLED = 0;
    public const STATUS_NEW = 1;
    public const STATUS_PAID = 2;
    public const STATUS_COMPLETED = 3;

    public const STATUS_CANCELLED_LABEL = 'Cancelled';
    public const STATUS_NEW_LABEL = 'New';
    public const STATUS_PAID_LABEL = 'Paid';
    public const STATUS_COMPLETED_LABEL = 'Completed';

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%client_order}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['client_id', 'total_amount', 'order_date'], 'required'],

            ['client_id', 'integer'],
            [
                'client_id',
                'exist',
                'targetClass' => Client::class,
                'targetAttribute' => 'id',
            ],

            [['total_amount'], 'number', 'min' => 0],

            [['order_date'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],

            ['status', 'default', 'value' => self::STATUS_NEW],
            ['status', 'in', 'range' => array_keys(self::statusList())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'order_date' => 'Order Date',
            'total_amount' => 'Total Amount',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): int
    {
        return $this->getPrimaryKey();
    }
 
    /**
     * Returns status list with status labels.
     *
     * @return array
     */
    public static function statusList(): array
    {
        return [
            self::STATUS_CANCELLED => self::STATUS_CANCELLED_LABEL,
            self::STATUS_NEW => self::STATUS_NEW_LABEL,
            self::STATUS_PAID => self::STATUS_PAID_LABEL,
            self::STATUS_COMPLETED => self::STATUS_COMPLETED_LABEL,
        ];
    }

    /**
     * Returns the label for the current status.
     *
     * @return string
     */
    public function getStatusLabel(): string
    {
        return self::statusList()[$this->status] ?? 'Unknown';
    }

    /**
     * Returns the client associated with this order.
     *
     * @return ActiveQuery
     */
    public function getClient(): ActiveQuery
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

}
