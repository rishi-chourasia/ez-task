<ul class="pagination">
    <?php
        echo $this->Paginator->prev('< ' . __('Previous'), array('tag' => 'li', 'class'=>'page-item', ' class'=>'page-link'), null, array('class' => 'disabled page-item', 'tag' => 'li', 'disabledTag' => 'a', ' class' =>'page-link'));
        echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'class'=>'page-item',  'currentClass' => 'disabled page-link', ' class'=>'page-link'));
        echo $this->Paginator->next(__('Next') . ' >', array('tag' => 'li', 'class'=>'page-item', ' class'=>'page-link'), null, array('class' => 'disabled page-item', 'tag' => 'li', 'disabledTag' => 'a', 'currentClass'=>'page-link', ' class' =>'page-link'));
    ?>
</ul>