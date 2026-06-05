<?php require dirname(__DIR__, 2) . '/header.php' ?>
<?php require dirname(__DIR__) . '/navbar.php' ?>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?= $user->getLastname() ?></td>
                <td><?= $user->getFirstname() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td>
                    <div class="flex">
                        <a href="/app/accounts/<?= $user->getUuid() ?>">Show</a>
                    </div>
                </td>
            </tr>
            <?php endforeach;  ?>
        </tbody>
    </table>
</div>
<?php require dirname(__DIR__, 2) . '/footer.php' ?>