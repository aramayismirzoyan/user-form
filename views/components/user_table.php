<table class="table table-responsive-md">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Имя</th>
        <th scope="col">Email</th>
        <th scope="col">Возраст</th>
    </tr>
    </thead>
    <tbody>
    <?php if(empty($params['users'])): ?>
        <tr>
            <td colspan="4" class="text-center">Пока нет пользователей</td>
        </tr>
    <?php endif; ?>

    <?php foreach ($params['users'] as $user): ?>
    <tr>
        <th scope="row"><?=$user['id']?></th>
        <td><?=$user['name']?></td>
        <td><?=$user['email']?></td>
        <td><?=$user['age']?></td>
    </tr>
    <?php endforeach; ?>

    </tbody>
</table>