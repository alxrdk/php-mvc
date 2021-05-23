<div class="container">
    <div class="row">
        <div class="col">

            <?php if ($authorized) { ?>
            <div class="d-flex flex-row bd-highlight mb-3">
                <div class="p-2 bd-highlight"><h1 class="d-lg-inline-flex">Admin Tasks</h1></div>
                <div class="p-2 bd-highlight"><a href="/logout" class="btn btn-primary btn-sm d-inline-flex" role="button" aria-pressed="true">Logout</a></div>
            </div>
            <?php } else { ?>
            <div class="d-flex flex-row bd-highlight mb-3">
                <div class="p-2 bd-highlight"><h1 class="d-lg-inline-flex">Tasks</h1></div>
                <div class="p-2 bd-highlight"><a href="/login" class="btn btn-primary btn-sm d-inline-flex" role="button" aria-pressed="true">Login</a></div>
            </div>
            <?php } ?>
            <?php echo $msg->display() ?>
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        <a href="/tasks?order=username&asc=<?php echo ($order=='username')?intval(!$asc):1 ?>">User Name</a>
                        <?php if ($order=='username') { ?><i class="bi bi-sort-<?php echo $asc?'up':'down' ?>"></i><?php } ?>
                    </th>
                    <th scope="col">
                        <a href="/tasks?order=email&asc=<?php echo ($order=='email')?intval(!$asc):1 ?>">Email</a>
                        <?php if ($order=='email') { ?><i class="bi bi-sort-<?php echo $asc?'up':'down' ?>"></i><?php } ?>
                    </th>
                    <th scope="col">Description</th>
                    <?php if ($authorized) { ?>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <?php } ?>
                    <th scope="col">
                        <a href="/tasks?order=complited&asc=<?php echo ($order=='complited')?intval(!$asc):1 ?>">Complited</a>
                        <?php if ($order=='complited') { ?><i class="bi bi-sort-<?php echo $asc?'up':'down' ?>"></i><?php } ?>
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($tasks as $task) {
            ?>
                <tr>
                    <td scope="row"><?php echo htmlspecialchars($task->username) ?></td>
                    <td><?php echo htmlspecialchars($task->email) ?></td>
                    <td><?php echo htmlspecialchars($task->description) ?></td>
                    <?php if ($authorized) { ?>
                    <td><a href="/tasks/edit?id=<?php echo $task->id ?>&p=<?php echo $page ?>&order=<?php echo $order ?>&asc=<?php echo intval($asc) ?>">Edit</a></td>
                    <td><a href="/tasks/delete?id=<?php echo $task->id ?>&p=<?php echo $page ?>&order=<?php echo $order ?>&asc=<?php echo intval($asc) ?>">Delete</a></td>
                    <?php } ?>
                    <td>
                        <?php if ($authorized) { ?>
                        <a href="/tasks/complite?id=<?php echo $task->id ?>&complited=<?php echo $task->complited?0:1 ?>&p=<?php echo $page ?>&order=<?php echo $order ?>&asc=<?php echo intval($asc) ?>"><?php echo $task->complited?'Yes':'No' ?></a>
                        <?php } else { ?>
                        <?php echo $task->complited?'Yes':'No' ?>
                        <?php } ?>
                    </td>
                </tr>

            <?php
            }
            ?>
            </tbody>
            </table>
            <?php self::render('Pages', ['paginator' => $paginator, 'order' => $order, 'asc' => $asc, 'page' => $page]) ?>
        </div>
    </div>
</div>
<br/>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h2>Add task</h2>
            <form action='/add?p=<?php echo $page ?>&order=<?php echo $order ?>&asc=<?php echo intval($asc) ?>' method="POST">
            <div class="mb-3">
                <label for="userName" class="form-label">User Name</label>
                <input type="username" name="username" value="<?php echo @htmlspecialchars($username) ?>" class="form-control" id="userName">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" name="email" value="<?php echo @htmlspecialchars($email) ?>" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="3" name="description" class="form-control" id="description"><?php echo @htmlspecialchars($description) ?></textarea>
            </div>
            <?php if (!empty($errors)) foreach($errors as $error) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error ?>
            </div>
            <?php } ?>
            <input type="submit" value="Add"  class="btn btn-primary">
            </form>
        </div>
    </div>
</div>