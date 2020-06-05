<h2>View All Routes</h2>

<a href="/routes/add" class="btn btn-sm btn-outline-secondary my-5">Add route</a>

<table class="table mb-5">
    <thead>
    <th>Link</th>
    <th>Request Type</th>
    <th>Name</th>
    <th>Controller</th>
    <th>Method</th>
    <th>Edit</th>
    <th>Delete</th>
    </thead>
    <tbody>
    <?php foreach($routes as $route):?>
        <tr>
            <td>
                <?= $route->link ?>
<!--                <a href="--><?//= URLROOT . $route->link ?><!--">--><?//= $route->link ?><!--</a>-->

            </td>
            <td><?= $route->type ?></td>
            <td><?= $route->name ?></td>
            <td><?= $route->controller ?></td>
            <td><?= $route->method ?></td>
            <td>
                <a class="btn btn-sm btn-outline-warning" href="/routes/<?= $route->id ?>/edit">edit</a>
            </td>
            <td>
                <form action="/routes/<?= $route->id ?>/delete" method="POST">
                    <button type="submit" class="btn btn-sm btn-outline-danger">delete</button>
                </form>
            </td>

        </tr>
    <?php endforeach;?>
    </tbody>
</table>