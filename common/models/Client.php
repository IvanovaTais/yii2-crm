<?php

declare(strict_types=1);

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use common\models\ClientOrder;

/**
 * Client model
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone
 * @property string|null $birth_date
 * @property string|null $notes
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Client extends ActiveRecord
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    public const STATUS_ACTIVE_LABEL = 'Active';
    public const STATUS_INACTIVE_LABEL = 'Inactive';

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%client}}';
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
            [['first_name', 'last_name', 'email'], 'required'],

            [['notes'], 'string'],

            [['birth_date'], 'date', 'format' => 'php:Y-m-d'],

            [['first_name', 'last_name'], 'string', 'max' => 255],

            [['phone'], 'string', 'max' => 30],

            [['email'], 'email'],

            [['email'], 'unique'],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'first_name' => 'Client First Name',
            'last_name' => 'Client Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'birth_date' => 'Birthday Date',
            'notes' => 'Notes',
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
     * Returns the full name of the client.
     *
     * @return string
     */
    public function getFullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * {@inheritdoc}
     */
    public function fields(): array
    {
        $fields = parent::fields();

        unset($fields['created_at']);
        unset($fields['updated_at']);

        $fields['full_name'] = function() {
            return $this->fullName;
        };
        return $fields;
    }
 
    /**
     * Returns a list of status labels.
     *
     * @return array
     */
    public static function statusList(): array
    {
        return [
            self::STATUS_ACTIVE => self::STATUS_ACTIVE_LABEL,
            self::STATUS_INACTIVE => self::STATUS_INACTIVE_LABEL,
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
     * Returns the client's orders.
     *
     * @return ActiveQuery
     */
    public function getOrders(): ActiveQuery
    {
        return $this->hasMany(ClientOrder::class, ['client_id' => 'id']);
    }

}
