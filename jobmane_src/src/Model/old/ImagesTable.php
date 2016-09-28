<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Images Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Image get($primaryKey, $options = [])
 * @method \App\Model\Entity\Image newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Image[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Image|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Image patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Image[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Image findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ImagesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('images');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('image');

        $validator
            ->allowEmpty('created_user');

        $validator
            ->allowEmpty('modified_user');

        return $validator;
    }


    public function beforeSave($event, $entity, $options)
    {
      \Cake\Log\Log::debug($entity);

      if (isset($entity->photo['error']) && $entity->photo['error'] === UPLOAD_ERR_OK) {
//        debug('photo beforeSave OK !!');
        \Cake\Log\Log::debug('phone beforeSave OK !!');
        \Cake\Log\Log::debug($entity);
        \Cake\Log\Log::debug($entity->photo);
        //        debug($entity);
//        debug($entity->photo);

        $entity->image = $this->_buildPhoto($entity->photo);
      } else {
        debug('photo beforeSave NG ??');
        \Cake\Log\Log::debug('photo beforeSave NG ???');
        \Cake\Log\Log::debug($entity);
        \Cake\Log\Log::debug($entity->photo);
        unset($entity->photo);
      }
    }


  /**
   * Returns a rules checker object that will be used for validating
   * application integrity.
   *
   * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
   * @return \Cake\ORM\RulesChecker
   */
  public function buildRules(RulesChecker $rules)
  {
    $rules->add($rules->existsIn(['user_id'], 'Users'));

    $ret = file_get_contents($photo['tmp_name']);
    //      $ret = file_get_contents('/img/default_avatar0.png');
    if($ret === false) {
      throw new RuntimeException('Can not get phone image.');
    } else {
      list($width, $height, $type, $attr) = getimagesize($photo['tmp_name']);
    //      debug($width);
    //      debug($height);
    //      debug($type);
    //      debug($attr);

      $mime = image_type_to_mime_type($type);

    //      debug($mime);
    //      debug(IMAGETYPE_GIF);     // 1
    //      debug(IMAGETYPE_JPEG);    // 2
    //      debug(IMAGETYPE_PNG);     // 3

      if($type == IMAGETYPE_GIF) {
    //          debug("gif");
        $image = imagecreatefromgif($photo['tmp_name']);
      }
      if($type == IMAGETYPE_JPEG) {
    //          debug("jpeg");
        $image = imagecreatefromjpeg($photo['tmp_name']);
      }
      if($type == IMAGETYPE_PNG) {
    //          debug("png");
        $image = imagecreatefrompng($photo['tmp_name']);
      }

      $startX = 0;
      $startY = 0;
      $widthNew = 0;
      if($height >= $width) {
        $startX = 0;
        $startY = ($height - $width) / 2;
        $heightNew = $height - $width;
        if($width > 640) {
          $widthNew = 640;
        } else {
          $widthNew = $width;
        }
        $canvas = imagecreatetruecolor($widthNew, $widthNew);
        imagecopyresampled($canvas, $image, 0,0,
                    $startX,    // コピー元の x座標
                    $startY,    // コピー元の y座標
                    $widthNew,     // 背景画像の幅
                    $widthNew,     // 背景画像の高さ
                    $width,     // コピー元の 幅
                    $width      // コピー元の 高さ
        );

        imagejpeg($canvas, "/tmp/aaaa.jpg");

        $ret = file_get_contents( "/tmp/aaaa.jpg");

    //        return $cache;
      }
      if($height < $width) {
        $startY = 0;
        $startX = ($width - $height) / 2;
    //          $widthNew = $width - $height;
        if($width > 640) {
          $widthNew = 640;
        } else {
          $widthNew = $height;
        }
        $canvas = imagecreatetruecolor($widthNew, $widthNew);
        imagecopyresampled($canvas, $image, 0,0,
                    $startX,    // コピー元の x座標
                    $startY,    // コピー元の y座標
                    $widthNew,     // 背景画像の幅
                    $widthNew,     // 背景画像の高さ
                    $height,     // コピー元の 幅
                    $height      // コピー元の 高さ
        );

        imagejpeg($canvas, "/tmp/aaaa.jpg");

        $ret = file_get_contents( "/tmp/aaaa.jpg");

    //        return $cache;
      }
    }

    return $ret;
  }
}
