<h2>View All Routes</h2>



<a href="/navigations/add" class="btn btn-sm btn-outline-secondary my-5">Add navigation</a>

<table class="table mb-5">
    <thead>
    <th>Name</th>
    <th>Link</th>
    <th>Position</th>
    <th>Icon</th>
    <th>Edit</th>
    <th>Delete</th>
    </thead>
    <tbody>
    <?php foreach($sidebar as $navigation):?>
        <tr>

            <td><?= $navigation->name ?></td>
            <td>
                <a href="<?= URLROOT . $navigation->link ?>"><?= $navigation->link ?></a>
            </td>
            <td><?= $navigation->location ?></td>

            <td>
                 <i class="<?= $navigation->icon ?>"></i>
            </td>

            <td>
                <a class="btn btn-sm btn-outline-warning" href="/navigations/<?= $navigation->id ?>/edit">edit</a>
            </td>
            <td>
                <form action="/navigations/<?= $navigation->id ?>/delete" method="POST">
                    <button type="submit" class="btn btn-sm btn-outline-danger">delete</button>
                </form>
            </td>

        </tr>
    <?php endforeach;?>
    </tbody>
</table>