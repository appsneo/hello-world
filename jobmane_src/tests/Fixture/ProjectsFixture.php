<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProjectsFixture
 *
 */
class ProjectsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'プロジェクトID　(システム用)', 'autoIncrement' => true, 'precision' => null],
        'num' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '工事物件No', 'precision' => null, 'fixed' => null],
        'secondar' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '依頼名', 'precision' => null, 'fixed' => null],
        'project_name' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '協力会社名(２次業者名)', 'precision' => null, 'fixed' => null],
        'sub-title' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '工事名', 'precision' => null, 'fixed' => null],
        'money' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '作業種別', 'precision' => null, 'fixed' => null],
        'start' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '受注金額', 'precision' => null, 'fixed' => null],
        'end' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '開始日', 'precision' => null, 'fixed' => null],
        'address' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '完了日', 'precision' => null, 'fixed' => null],
        'summary' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '概要', 'precision' => null, 'fixed' => null],
        'charge' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '本体工事店建築担当者', 'precision' => null, 'fixed' => null],
        'workers' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '作業員指定', 'precision' => null, 'fixed' => null],
        'memo' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'メモ', 'precision' => null, 'fixed' => null],
        'select_file' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '図面書類', 'precision' => null, 'fixed' => null],
        'completino_check' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'プロジェクト完了チェック', 'precision' => null, 'fixed' => null],
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
            'num' => 'Lorem ipsum dolor ',
            'secondar' => 'Lorem ipsum dolor ',
            'project_name' => 'Lorem ipsum dolor ',
            'sub-title' => 'Lorem ipsum dolor ',
            'money' => 'Lorem ipsum dolor ',
            'start' => 'Lorem ipsum dolor ',
            'end' => 'Lorem ipsum dolor ',
            'address' => 'Lorem ipsum dolor ',
            'summary' => 'Lorem ipsum dolor ',
            'charge' => 'Lorem ipsum dolor ',
            'workers' => 'Lorem ipsum dolor ',
            'memo' => 'Lorem ipsum dolor ',
            'select_file' => 'Lorem ipsum dolor ',
            'completino_check' => 'Lorem ipsum dolor ',
            'created_user' => 'Lorem ipsum dolor ',
            'modified_user' => 'Lorem ipsum dolor ',
            'created' => '2016-07-25 15:08:45',
            'modified' => '2016-07-25 15:08:45'
        ],
    ];
}
