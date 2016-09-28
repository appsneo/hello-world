<div class="paginator">
  <ul class="pagination pagenation">
  <?php
    if($this->Paginator->params()['pageCount'] >= 2):
      echo $this->Paginator->prev($title='＜　前へ', $options=['img' => '/img/common/c_back.png',
                                                              'id' => 'a_pre']);
    endif;
    echo $this->Paginator->numbers([ 'modulus' => 3, 'first' => 1, 'last' => 1 ]);
    if($this->Paginator->params()['pageCount'] >= 2):
      echo $this->Paginator->next('次へ　＞');
    endif;
  ?>
  </ul>
</div>
<?php $this->log($this->Paginator->params(), 'debug'); ?>
