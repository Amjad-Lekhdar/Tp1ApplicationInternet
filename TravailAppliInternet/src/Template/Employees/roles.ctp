<h1>
    
    <?= $this->Text->toList(h($roles), 'or') ?>
</h1>

<section>
<?php foreach ($employees as $employee): ?>
    <article>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link(
            $employee->First_Name,
            ['controller' => 'Articles', 'action' => 'view', $employee->slug]
        ) ?></h4>
        <span><?= h($employee->created) ?></span>
    </article>
<?php endforeach; ?>
</section>
