<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Users001Fixture
 *
 */
class Users001Fixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'users001';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'ユーザID', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '氏名', 'precision' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'パスワード 暗号化', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'メールアドレス', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'アカウント状態', 'precision' => null, 'fixed' => null],
        'blood_type' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '血液型', 'precision' => null, 'fixed' => null],
        'medical_checked_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '最新健康診断日', 'precision' => null],
        'joined_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '入社日', 'precision' => null],
        'leaving_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '退社日', 'precision' => null],
        'birth_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '生年月日', 'precision' => null],
        'emergency' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '緊急連絡先', 'precision' => null, 'fixed' => null],
        'capbilities' => ['type' => 'string', 'length' => 240, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '所有資格', 'precision' => null, 'fixed' => null],
        'safety' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '安全講習受講履歴', 'precision' => null, 'fixed' => null],
        'created_user' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'レコード更新者', 'precision' => null, 'fixed' => null],
        'modified_user' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'レコード作成者', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'レコード作成時刻', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'レコード更新時刻', 'precision' => null],
        'avatar' => ['type' => 'binary', 'length' => 16777215, 'null' => true, 'default' => null, 'comment' => '顔写真 (avatar)', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'name' => 'Lorem ipsum dolor ',
            'password' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor ',
            'status' => 'Lorem ipsum dolor ',
            'blood_type' => 'Lorem ipsum dolor ',
            'medical_checked_date' => '2016-07-21',
            'joined_date' => '2016-07-21',
            'leaving_date' => '2016-07-21',
            'birth_date' => '2016-07-21',
            'emergency' => 'Lorem ipsum dolor ',
            'capbilities' => 'Lorem ipsum dolor sit amet',
            'safety' => 'Lorem ipsum dolor ',
            'created_user' => 'Lorem ipsum dolor ',
            'modified_user' => 'Lorem ipsum dolor ',
            'created' => '2016-07-21 14:33:52',
            'modified' => '2016-07-21 14:33:52',
            'avatar' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
