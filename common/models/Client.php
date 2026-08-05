<?php

declare(strict_types=1);

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Client model
 *
 * @property int $id
 * @property string $firstname
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
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    // public static function findByUsername(string $username): User|null
    // {
    //     return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    // }

    /**
     * {@inheritdoc}
     */
    public function getId(): int
    {
        return $this->getPrimaryKey();
    }
 
    public static function statusList(): array
    {
        return [
            self::STATUS_ACTIVE => self::STATUS_ACTIVE_LABEL,
            self::STATUS_INACTIVE => self::STATUS_INACTIVE_LABEL,
        ];
    }

    public function getStatusLabel(): string
    {
        return self::statusList()[$this->status] ?? 'Unknown';
    }

}
