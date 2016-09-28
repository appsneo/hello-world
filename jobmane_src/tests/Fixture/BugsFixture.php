<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BugsFixture
 *
 */
class BugsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'BUG ID　(システム用)', 'autoIncrement' => true, 'precision' => null],
        'wr_user_id' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => 'BUG 報告者', 'precision' => null, 'fixed' => null],
        'up_user_id' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => 'BUG 修正者', 'precision' => null, 'fixed' => null],
        'wr_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '記入時刻', 'precision' => null],
        'up_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '改修時刻', 'precision' => null],
        'wr_note' => ['type' => 'string', 'length' => 1200, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '現象等', 'precision' => null, 'fixed' => null],
        'up_note' => ['type' => 'string', 'length' => 1200, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '改修内容', 'precision' => null, 'fixed' => null],
        'type' => ['type' => 'string', 'length' => 120, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '不具合箇所の分類', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'string', 'length' => 120, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '状況 完了、未対応', 'precision' => null, 'fixed' => null],
        'created_user' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => 'レコード更新者', 'precision' => null, 'fixed' => null],
        'modified_user' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => 'レコード作成者', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'レコード作成時刻', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'レコード更新時刻', 'precision' => null],
        'image' => ['type' => 'binary', 'length' => 16777215, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
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
            'wr_user_id' => 'Lorem ipsum dolor ',
            'up_user_id' => 'Lorem ipsum dolor ',
            'wr_date' => '2016-09-02 22:02:33',
            'up_date' => '2016-09-02 22:02:33',
            'wr_note' => 'Lorem ipsum dolor sit amet',
            'up_note' => 'Lorem ipsum dolor sit amet',
            'type' => 'Lorem ipsum dolor sit amet',
            'status' => 'Lorem ipsum dolor sit amet',
            'created_user' => 'Lorem ipsum dolor ',
            'modified_user' => 'Lorem ipsum dolor ',
            'created' => '2016-09-02 22:02:33',
            'modified' => '2016-09-02 22:02:33',
            'image' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
