<div class="col_12 pagination-container">
    <ul class="button-bar">
        <?php 
           echo $this->Paginator->prev('Previous', ['tag' => 'li'], null, array('class' => 'prev disabled')); 
           echo $this->Paginator->numbers(['tag' => 'li', 'currentTag' => 'a']);
           echo $this->Paginator->next('Next', ['tag' => 'li'], null, array('class' => 'prev disabled')); 
         ?>
    </ul>
</div>