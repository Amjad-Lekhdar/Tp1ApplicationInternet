<h1>
    Articles tagged with
    <?= $this->Text->toList(h($statut), 'or') ?>
</h1>

<section>
<?php foreach ($users as $user): ?>
    <article>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link(
            $user->title,
            ['controller' => 'Users', 'action' => 'view', $user->id]
        ) ?></h4>
        <span><?= h($user->created) ?></span>
    </article>
<?php endforeach; ?>
</section>
