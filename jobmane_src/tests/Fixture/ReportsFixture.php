<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReportsFixture
 *
 */
class ReportsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '日報ID　(システム用)', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'ユーザID', 'precision' => null, 'autoIncrement' => null],
        'company_name' => ['type' => 'string', 'length' => 120, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '会社名', 'precision' => null, 'fixed' => null],
        'client' => ['type' => 'string', 'length' => 120, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '依頼先', 'precision' => null, 'fixed' => null],
        'project_name' => ['type' => 'string', 'length' => 120, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'プロジェクト名', 'precision' => null, 'fixed' => null],
        'start_time' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '退場時間', 'precision' => null],
        'end_time' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '有給休暇', 'precision' => null],
        'pay_vacation' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '休日出勤', 'precision' => null, 'autoIncrement' => null],
        'holiday_work' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '他の仕事', 'precision' => null, 'autoIncrement' => null],
        'other_work' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '入社日', 'precision' => null, 'autoIncrement' => null],
        'materials' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '使用部材', 'precision' => null, 'fixed' => null],
        'amount' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '数量', 'precision' => null, 'fixed' => null],
        'allowance' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '手当等', 'precision' => null, 'fixed' => null],
        'memo' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '備考', 'precision' => null, 'fixed' => null],
        'remeining_work' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '残工事', 'precision' => null, 'fixed' => null],
        'created_user' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'レコード更新者', 'precision' => null, 'fixed' => null],
        'modified_user' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'レコード作成者', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'レコード作成時刻', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'レコード更新時刻', 'precision' => null],
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
            'user_id' => 1,
            'company_name' => 'Lorem ipsum dolor sit amet',
            'client' => 'Lorem ipsum dolor sit amet',
            'project_name' => 'Lorem ipsum dolor sit amet',
            'start_time' => '06:00:56',
            'end_time' => '06:00:56',
            'pay_vacation' => 1,
            'holiday_work' => 1,
            'other_work' => 1,
            'materials' => 'Lorem ipsum dolor ',
            'amount' => 'Lorem ipsum dolor ',
            'allowance' => 'Lorem ipsum dolor sit amet',
            'memo' => 'Lorem ipsum dolor sit amet',
            'remeining_work' => 'Lorem ipsum dolor sit amet',
            'created_user' => 'Lorem ipsum dolor ',
            'modified_user' => 'Lorem ipsum dolor ',
            'created' => '2016-07-27 06:00:56',
            'modified' => '2016-07-27 06:00:56'
        ],
    ];
}
