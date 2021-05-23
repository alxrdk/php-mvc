<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h1>Edit task #<?php echo $task->id ?></h1>
            <form action='/tasks/edit?p=<?php echo $page ?>&order=<?php echo $order ?>&asc=<?php echo intval($asc) ?>' method="POST">
            <input type="hidden" name="id" value="<?php echo $task->id ?>">
            <input type="hidden" name="referer" value="<?php echo $task->id ?>">
            <div class="mb-3">
                <label for="userName" class="form-label">User Name</label>
                <input type="username" name="username" value="<?php echo htmlspecialchars($posted?$username:$task->username) ?>" class="form-control" id="userName">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($posted?$email:$task->email) ?>" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea rows="3" name="description" class="form-control" id="description"><?php echo htmlspecialchars($posted?$description:$task->description) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Complited</label>
                <input type="checkbox" name="complited" <?php echo $posted&&$complited||$task->complited?'checked="checked"':'' ?> class="form-check-input" id="userName">
            </div>
            <?php if (!empty($errors)) foreach($errors as $error) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error ?>
            </div>
            <?php } ?>
            <input type="submit" value="Save"  class="btn btn-primary">
            </form>
        </div>
    </div>
</div>